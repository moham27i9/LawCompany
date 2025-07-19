<?php

namespace App\Repositories;

use App\Models\Issue;
use App\Models\Report;
use App\Models\Sessionss;
use App\Models\User;

class ReportRepository
{
    public function create(array $data)
    {
        return Report::create($data);
    }

    public function getAll()
    {
        return Report::with('employee')->get();
    }

    public function getById($id)
    {
        return Report::with('employee')->findOrFail($id);
    }

    public function delete($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return true;
    }

     public function getSessionsForLawyer(int $lawyerId, string $from, string $to)
    {
        $sessions= Sessionss::with(['issue','appointments'])
            ->where('lawyer_id', $lawyerId)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        return $sessions;
    }

    public function getSessionReportData($sessionId)
    {
        $session = Sessionss::with(['documents','issue', 'lawyer.user', 'sessionType', 'appointments'])
            ->findOrFail($sessionId);
        return [
            'lawyer_name' => $session->lawyer->user->name ?? 'غير معروف',
            'issue_name' => $session->issue->title ?? 'غير معروف',
            'outcome' => $session->outcome,
            'type' => $session->sessionType->type ?? 'غير محدد',
            'documents_count' => $session->documents->count(),
            'date' => optional($session->appointments->first())->date ?? $session->created_at,
            'session_id' => $session->id,
        ];
    }



    public function getIssueReportData($issueId)
{
    $issue = Issue::with(['user', 'lawyers.user', 'sessions.sessionType'])->findOrFail($issueId);

    return [
        'issue_title' => $issue->title,
        'owner_name' => $issue->user->name ?? 'غير معروف',
        'total_cost' => $issue->total_cost,
        'start_date' => $issue->start_date,
        'status' => $issue->status,
        'amount_paid' => $issue->amount_paid,
        'remaining' => $issue->total_cost - $issue->amount_paid,
        'lawyers' => $issue->lawyers->map(function ($lawyer) {
            return $lawyer->user->name ?? 'محامي';
        }),
        'sessions' => $issue->sessions->map(function ($session) {
            return [
                'session_number' => $session->id ,
                'lawyer_name' => $session->lawyer->user->name ,
                'type' => $session->sessionType->type ?? 'غير محدد',
                'outcome' => $session->outcome,
                'date' => $session->created_at->format('Y-m-d'),
            ];
        }),
    ];
}

public function getUserReportData($userId)
{
    $user = User::with([
        'profile',
        'issues.category',
        'consultationRequests.user',
        'complaints',
        'jobApplication.hiringRequest'
    ])->findOrFail($userId);

    return [
        'user' => $user,
        'profile' => $user->profile,
        'issues' => $user->issues,
        'consultations' => $user->consultationRequests,
        'complaints' => $user->complaints,
        'job_applications' => $user->jobApplication,

    ];
}
}
