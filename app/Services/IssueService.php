<?php

namespace App\Services;

use App\Repositories\IssueRepository;

class IssueService
{
    protected $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function create(array $data , $user_id)
    {
        return $this->issueRepository->create($data , $user_id);
    }

    public function getAll()
    {
        return $this->issueRepository->getAll();
    }

    public function getById($id)
    {
        return $this->issueRepository->getById($id);
    }
    public function update($id, array $data)
    {
        return $this->issueRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->issueRepository->delete($id);
    }



}
