<?php

namespace App\Repositories;

use App\Models\Session;
use App\Models\Sessionss;

class SessionRepository
{
    public function all()
    {
        return Sessionss::with(['issue', 'lawyer'])->get();
                // return Sessionss::with(['issue', 'lawyer', 'point', 'issueProgressReport', 'appointments', 'documents'])->get();

    }

    public function getById($id)
    {
        return Sessionss::with(['issue', 'lawyer'])->findOrFail($id);
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




}
