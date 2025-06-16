<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\Lawyer;
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
public function calculateSessionsPayment($issueId)
{
    $sessions = $this->sessionRepository->getByIssueId($issueId);
    $totalPoints = $this->sessionRepository->sumPointsByIssue($issueId);

    $issue = Issue::findOrFail($issueId);

    $totalAmount = $issue->total_cost; // مثال: 5000
    $lawyerShare = $issue->lawyer_percentage; // مثال: 40 (%)
    $lawyerAmount = ($lawyerShare / 100) * $totalAmount;

    $result = [];
    $totalCalculatedAmount = 0;

    foreach ($sessions as $session) {
        $percentage = $session->sessionType->points / $totalPoints;
        $sessionAmount = round($percentage * $lawyerAmount, 2);

        $totalCalculatedAmount += $sessionAmount;

        $result[] = [
            'session_id' => $session->id,
            'type' => $session->sessionType->type,
            'lawyer_name' => $session->lawyer->user->name,
            'points' => $session->sessionType->points,
            'percentage' => round($percentage * 100, 2),
            'amount' => $sessionAmount,
        ];
    }

    return [
        'sessions' => $result,
        'amount_total' => round($totalCalculatedAmount, 2),
        'lawyer_total_amount' => $lawyerAmount,
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

}
