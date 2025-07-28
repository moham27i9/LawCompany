<?php
namespace App\Services;

use App\Models\IssueProgressReport;
use App\Models\Sessionss;
use Auth;

class IssueProgressReportService
{
public function store(array $data): IssueProgressReport
{
    $session = Sessionss::findOrFail($data['session_id']);


    $currentUser = Auth::user();
    if (!$currentUser || !$session->lawyer || $session->lawyer->user_id !== $currentUser->id) {
        abort(403, 'ليس لديك صلاحية لإضافة تقرير لهذه الجلسة');
    }

    // تحقق من حضور الجلسة
    if ($session->is_attend == 0) {
        abort(403, 'لا يمكنك كتابة تقرير قبل حضور الجلسة');
    }

    // حساب الجلسات السابقة
    $issueId = $session->issue_id;
    $preCount = Sessionss::where('issue_id', $issueId)
        ->where('id', '<', $session->id)
        ->count();

    $data['pre_session_count'] = $preCount;

    return IssueProgressReport::create($data);
    }

    public function update(array $data, $id): IssueProgressReport
    {
        $report = IssueProgressReport::findOrFail($id);
        $session = $report->session;

        $currentUser = Auth::user();
        if (!$currentUser || !$session->lawyer || $session->lawyer->user_id !== $currentUser->id) {
            abort(403, 'ليس لديك صلاحية لتعديل هذا التقرير');
        }

        $report->update($data);
        return $report;
    }


    public function getAll()
    {
        return IssueProgressReport::with('session')->get();
    }

    public function getById($id)
    {
        return IssueProgressReport::with('session')->findOrFail($id);
    }

    public function delete($id): bool
    {
        $report = IssueProgressReport::findOrFail($id);
        $session = $report->session;

        $currentUser = Auth::user();
        if (!$currentUser || !$session->lawyer || $session->lawyer->user_id !== $currentUser->id) {
            abort(403, 'ليس لديك صلاحية لحذف هذا التقرير');
        }

        return $report->delete();
    }

}
