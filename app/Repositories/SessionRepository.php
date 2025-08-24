<?php

namespace App\Repositories;

use App\Models\LawyerPoint;
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


}
