<?php

namespace App\Repositories;

use App\Models\Lawyer;
use App\Models\LawyerPoint;
use App\Models\SalaryAdjustment;
use App\Models\Session;
use App\Models\Sessionss;
use Cache;

class SessionRepository
{
    public function all()
    {
        return Cache::remember('sessions_all', now()->addMinutes(10), function () {
        return Sessionss::with(['issue', 'lawyer','sessionType'])->get();
    });



    }

    public function getById($id)
    {
        return Sessionss::with(['issue', 'lawyer','sessionType'])->findOrFail($id);
    }

    public function getByIssueId($id)
    {
        return Sessionss::with(['issue', 'lawyer','sessionType'])->where('issue_id',$id)->get();
    }

    public function create(array $data)
    {
         Cache::forget('sessions_all');
        return Sessionss::create($data);
    }

    public function update($id, array $data)
    {

        $session = Sessionss::findOrFail($id);
        $session->update($data);
        $session->save();
         // ✅ إذا outcome = closed → احسب النقاط
        if (isset($data['out_come']) && $data['out_come'] === 'closed') {
           $payment = $this->calculateSessionPayment($session->id);
            $this->calculateSessionPayment($session->lawyer->id,$payment['amount']);
        }
        Cache::forget('sessions_all');
        return $session;
    }

    public function delete($id)
    {
        $session = Sessionss::findOrFail($id);
        Cache::forget('sessions_all');
        return $session->delete();
    }

    public function sessionsThisMonth()
    {
        return Cache::remember('sessions_this_month', now()->addMinutes(30), function () {
            return Sessionss::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
        });
    }

    public function sumPointsByIssue($issueId)
    {

        $sessionIds = Sessionss::where('issue_id', $issueId)->pluck('id');

        return \App\Models\LawyerPoint::whereIn('session_id', $sessionIds)->sum('points');
    }



    public function getSessionsForLawyerReport($lawyerId, $from, $to)
    {
        return Sessionss::with(['issue', 'appointments'])
            ->where('lawyer_id', $lawyerId)
            ->whereBetween('created_at', [$from, $to])
            ->get();
    }

    public function markAttendance($sessionId)
    {
        $session = Sessionss::with('sessionType')->findOrFail($sessionId);

        // تسجيل الحضور
        $session->is_attend = true;
        $session->save();

        // نقاط حضور الجلسة
        LawyerPoint::updateOrCreate([
            'lawyer_id' => $session->lawyer_id,
            'session_id' => $session->id,
            'source' => 'attendance',
        ], [
            'points' => 5,
            'note' => 'نقاط لحضور الجلسة',
        ]);

        // نقاط حسب نوع الجلسة
        $typePoints = $session->sessionType->points ?? 0;

        if ($typePoints > 0) {
            LawyerPoint::updateOrCreate([
                'lawyer_id' => $session->lawyer_id,
                'session_id' => $session->id,
                'source' => 'type',
            ], [
                'points' => $typePoints,
                'reason' => 'نقاط حسب نوع الجلسة',
            ]);
        }

        return $session;
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
        'lawyer_id' => $session->lawyer->id,
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
