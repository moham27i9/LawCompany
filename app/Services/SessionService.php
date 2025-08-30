<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\Lawyer;
use App\Models\LawyerPoint;
use App\Models\SalaryAdjustment;
use App\Models\Sessionss;
use App\Repositories\SessionRepository;

class SessionService
{
    protected $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    public function all()
    {
        return $this->sessionRepository->all();
    }

    public function getById($id)
    {
        return $this->sessionRepository->getById($id);
    }

    public function getByIssueId($id)
    {
        return $this->sessionRepository->getByIssueId($id);
    }

    public function create(array $data, $issueId)
    {
        $data['issue_id'] = $issueId;
        return $this->sessionRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->sessionRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->sessionRepository->delete($id);
    }

    public function sessionsThisMonth()
    {
        return $this->sessionRepository->sessionsThisMonth();
    }



public function calculateLawyerShareForIssue($issueId, $lawyerId)
{
    $issue = Issue::findOrFail($issueId);
    $totalAmount = $issue->total_cost;
    $lawyerShare = $issue->lawyer_percentage;

    // المبلغ المخصص لكل المحامين
    $totalLawyerAmount = ($lawyerShare / 100) * $totalAmount;

    // إجمالي نقاط كل المحامين في هذه القضية
    $totalPoints = \App\Models\LawyerPoint::whereHas('session', function ($q) use ($issueId) {
        $q->where('issue_id', $issueId);
    })->sum('points');

    // نقاط المحامي المحدد في هذه القضية
    $lawyerPoints = \App\Models\LawyerPoint::where('lawyer_id', $lawyerId)
        ->whereHas('session', function ($q) use ($issueId) {
            $q->where('issue_id', $issueId);
        })->sum('points');

    // حساب النسبة والمبلغ
    $percentage = $totalPoints > 0 ? $lawyerPoints / $totalPoints : 0;
    $lawyerAmount = round($percentage * $totalLawyerAmount, 2);

    return [
        'lawyer_id' => $lawyerId,
        'issue_id' => $issueId,
        'lawyer_points' => $lawyerPoints,
        'total_points' => $totalPoints,
        'percentage' => round($percentage * 100, 2), // نسبة مئوية
        'amount' => $lawyerAmount,
        'lawyer_share_from_total' => $totalLawyerAmount,
    ];
}


  public function generateLawyerReport($lawyerId, $data)
    {
        $sessions = $this->sessionRepository->getSessionsForLawyerReport($lawyerId, $data['from'], $data['to']);
        $lawyer = Lawyer::with('user')->findOrFail($lawyerId);

        $report = [
            'intro' => "للجلسات خلال الفترة من  {$data['from']} إلى {$data['to']} ويمكن إعتماده كتقرير رسمي {$lawyer->user->name}  هذا التقرير يعكس حضور المحامي ",
            'license_number' => $lawyer->license_number,
            'report_date' => now()->toDateString(),
            'stats' => [
                'total_sessions' => $sessions->count(),
                'attended_sessions' => $sessions->where('is_attend', true)->count(),
                'judged_sessions' => $sessions->where('outcome', 'judged')->count(),
            ],
            'sessions' => $sessions->map(function ($session, $index) {
                return [
                    'number' => $index + 1,
                    'issue_number' => $session->issue->issue_number ?? 'غير معروف',
                    'court_name' => $session->issue->court_name ?? 'غير معروف',
                    'session_date' => optional($session->appointments->first())->date ?? 'غير محدد',
                    'type' => $session->type,
                    'outcome' => $session->outcome,
                    'is_attend' => $session->is_attend ? 'نعم' : 'لا',
                    'notes' => $session->notes ?? 'لا يوجد',
                ];
            })->toArray()
        ];

        return $report;
    }

public function markAttendance($sessionId)
{
    $session = Sessionss::findOrFail($sessionId);
    $lawyerId = auth()->user()->lawyer->id;

    if ($session->lawyer_id !== $lawyerId) {
        abort(403, 'غير مسموح لك تسجيل الحضور لهذه الجلسة');
    }

    return $this->sessionRepository->markAttendance($sessionId);
}


public function calculateLawyerTotalPoints($lawyerId)
{
    // 🔹 اجلب كل الجلسات اللي شارك فيها المحامي
    $sessions = Sessionss::whereHas('lawyers', function ($q) use ($lawyerId) {
        $q->where('lawyer_id', $lawyerId);
    })->get();

    $result = [];
    $grandTotalAmount = 0;
    $grandTotalPoints = 0;

    foreach ($sessions as $session) {
        $issue = $session->issue;

        // إجمالي المبلغ للقضية
        $totalAmount = $issue->total_cost; 
        $lawyerShare = $issue->lawyer_percentage; 
        $lawyerAmount = ($lawyerShare / 100) * $totalAmount;

        // إجمالي النقاط لكل الجلسات في القضية
        $totalPoints = LawyerPoint::whereIn('session_id', $issue->sessions->pluck('id'))
            ->sum('points');

        // نقاط هذا المحامي في هذه الجلسة
        $lawyerPoints = LawyerPoint::where('session_id', $session->id)
            ->where('lawyer_id', $lawyerId)
            ->sum('points');

        // النسبة والتوزيع
        $percentage = $lawyerPoints / max(1, $totalPoints);
        $sessionAmount = round($percentage * $lawyerAmount, 2);

        // تراكم النقاط والمبالغ
        $grandTotalPoints += $lawyerPoints;
        $grandTotalAmount += $sessionAmount;

        $result[] = [
            'issue_id'     => $issue->id,
            'session_id'   => $session->id,
            'lawyer_name'  => $session->lawyer->user->name ?? '',
            'points'       => $lawyerPoints,
            'percentage'   => round($percentage * 100, 2),
            'amount'       => $sessionAmount,
        ];
    }

    return [
        'lawyer_id'        => $lawyerId,
        'lawyer_name'      => Lawyer::with('user')->find($lawyerId)->user->name ?? '',
        'sessions_details' => $result,
        'total_points'     => $grandTotalPoints,
        'total_amount'     => $grandTotalAmount,
    ];
}


public function calculateSessionPayment($sessionId)
{
    $session = Sessionss::with('lawyer.user')->findOrFail($sessionId);

    // ✅ تأكد إن الجلسة مغلقة
    if ($session->out_come !== 'closed') {
        throw new \Exception("لا يمكن حساب النقاط لجلسة غير مغلقة.");
    }

    // ✅ تحقق إذا كان تم حسابها مسبقاً
    $exists =SalaryAdjustment::where('employable_type', Lawyer::class)
        ->where('employable_id', $session->lawyer_id)
        ->where('reason', 'session_'.$session->id) // معرف فريد للجلسة
        ->exists();

    if ($exists) {
        return [
            'message' => 'تمت معالجة هذه الجلسة مسبقاً',
            'session_id' => $session->id,
        ];
    }

    // ✅ جمع النقاط الخاصة بالمحامي لهذه الجلسة
    $points = LawyerPoint::where('session_id', $session->id)
                ->where('lawyer_id', $session->lawyer_id)
                ->sum('points');

    if ($points <= 0) {
        return [
            'message' => 'لا توجد نقاط مسجلة لهذه الجلسة',
            'session_id' => $session->id,
        ];
    }

    // ✅ قيمة النقطة (من config أو ثابت)
    $pointValue = config('lawyers.point_value', 50); 
    $amount = $points * $pointValue;

    // ✅ إنشاء سجل في salary_adjustments
    $adjustment = SalaryAdjustment::create([
        'employable_id'   => $session->lawyer_id,
        'employable_type' => Lawyer::class,
        'type'            => 'allowance',
        'reason'          => 'session_'.$session->id,
        'amount'          => $amount,
        'processed'       => true,
        'effective_date'  => now(),
    ]);

    return [
        'message' => 'تمت إضافة النقاط للراتب بنجاح',
        'session_id' => $session->id,
        'lawyer' => $session->lawyer->user->name,
        'points' => $points,
        'amount' => $amount,
        'adjustment_id' => $adjustment->id
    ];
}


    public function addLawyerPointsAdjustment($lawyerId, $amount, $effectiveDate = null)
{
    $lawyer = Lawyer::findOrFail($lawyerId);

    return SalaryAdjustment::create([
        'employable_id'   => $lawyer->id,
        'employable_type' => Lawyer::class,
        'type'            => 'allowance',
        'reason'          => 'مكافأة عن النقاط المكتسبة في الجلسات',
        'amount'          => $amount,
        'processed'       => false,
        'effective_date'  => $effectiveDate ?? now()->toDateString(),
    ]);
}

}
