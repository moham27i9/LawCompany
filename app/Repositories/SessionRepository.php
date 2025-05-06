<?php

namespace App\Repositories;

use App\Models\Session;

class SessionRepository
{
    public function all()
    {
        return Session::with(['issue', 'lawyer', 'point', 'issueProgressReport', 'appointments', 'documents'])->get();
    }

    public function getById($id)
    {
        return Session::with(['issue', 'lawyer', 'point', 'issueProgressReport', 'appointments', 'documents'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Session::create($data);
    }

    public function update($id, array $data)
    {
        $session = Session::findOrFail($id);
        $session->update($data);
        return $session;
    }

    public function delete($id)
    {
        $session = Session::findOrFail($id);
        return $session->delete();
    }
}
