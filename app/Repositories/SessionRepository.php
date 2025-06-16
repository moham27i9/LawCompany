<?php

namespace App\Repositories;

use App\Models\Session;
use App\Models\Sessionss;

class SessionRepository
{
    public function all()
    {
        return Sessionss::with(['issue', 'lawyer','sessionType'])->get();
           

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
        return Sessionss::create($data);
    }

    public function update($id, array $data)
    {

        $session = Sessionss::findOrFail($id);
        $session->update($data);
        $session->save();
        return $session;
    }

    public function delete($id)
    {
        $session = Sessionss::findOrFail($id);
        return $session->delete();
    }

    public function sumPointsByIssue($issueId)
{
    return Sessionss::with('sessionType')
        ->where('issue_id', $issueId)
        ->get()
        ->sum(function ($session) {
            return optional($session->sessionType)->points ?? 0;
        });
}


    public function getSessionsForLawyerReport($lawyerId, $from, $to)
    {
        return Sessionss::with(['issue', 'appointments'])
            ->where('lawyer_id', $lawyerId)
            ->whereBetween('created_at', [$from, $to])
            ->get();
    }
}
