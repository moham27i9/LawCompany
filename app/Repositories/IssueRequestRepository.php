<?php

namespace App\Repositories;

use App\Models\IssueRequest;


class IssueRequestRepository
{

    public function getAll()
    {
        return IssueRequest::with('user','user.profile')->get();
    }

    public function getById($id)
    {

        return IssueRequest::with('user','user.profile')->findOrFail($id);
    }

      public function getByUser($userId)
    {
        return IssueRequest::where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return IssueRequest::create($data);
    }

    public function update($id, array $data)
    {
          try{

              $issueRequest = IssueRequest::where('status', 'pending')->where('is_locked', false)->findOrFail($id);
              $issueRequest->update($data);
              $issueRequest->save();
              return $issueRequest;
            }
               catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return null;
    }
    }

     public function updateClientRequest($id, $userId, array $data)
    {
        $request = IssueRequest::where('id', $id)
            ->where('user_id', $userId)
            ->where('status', 'pending')
             ->where('is_locked', false) // لا يسمح بالتعديل إذا كان مغلقًا
            ->firstOrFail();

        $request->update($data);
        return $request;
    }

    public function delete($id)
    {
        return IssueRequest::destroy($id);
    }
}
