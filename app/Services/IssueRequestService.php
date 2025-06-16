<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\GeneralNotification;
use App\Repositories\IssueRequestRepository;

class IssueRequestService
{
    protected $repository;

    public function __construct(IssueRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->getAll();
    }

    public function get($id)
    {
        return $this->repository->getById($id);
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->user()->id; // المستخدم الحالي
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function updateOnlyAdmin($id, array $data)
    {
        
        $issueRequest = $this->repository->update($id, $data);
        $user = User::findOrFail($issueRequest->user_id);
        $user->notify(new GeneralNotification($data['status'], $data['admin_note']  , '/issue-requests/'.$issueRequest->id));
        return  $issueRequest;
    }

    public function listClientRequests($userId)
    {
        return $this->repository->getByUser($userId);
    }

    public function updateClientRequest($id, $userId, array $data)
    {
        return $this->repository->updateClientRequest($id, $userId, $data);
    }

    public function lockRequest($id)
    {
        $request = $this->repository->getById($id);
         if (!$request) {
        throw new \Exception("Request not found");
          }
        $request->update(['is_locked' => true]);
      
        return $request;
    }

    public function unlockRequest($id)
    {
        $request = $this->repository->getById($id);
         if (!$request) {
        throw new \Exception("Request not found");
    }
        $request->update(['is_locked' => false]);

        return $request;
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
