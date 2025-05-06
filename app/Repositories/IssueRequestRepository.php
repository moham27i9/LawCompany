<?php

namespace App\Repositories;

use App\Models\IssueRequest;

class IssueRequestRepository
{
    public function getAll()
    {
        return IssueRequest::with('user')->get();
    }

    public function getById($id)
    {
        
        return IssueRequest::with('user')->findOrFail($id);
    }

    public function create(array $data)
    {
        return IssueRequest::create($data);
    }

    public function update($id, array $data)
    {
        $issueRequest = IssueRequest::findOrFail($id);
        $issueRequest->update($data);
        $issueRequest->save();
        return $issueRequest;
    }

    public function delete($id)
    {
        return IssueRequest::destroy($id);
    }
}
