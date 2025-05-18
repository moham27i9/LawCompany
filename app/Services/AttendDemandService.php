<?php
namespace App\Services;

use App\Repositories\AttendDemandRepository;

class AttendDemandService
{
    protected $repo;

    public function __construct(AttendDemandRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $data, $issueId)
    {
        $lawyerId = auth()->user()->lawyer->id;
         $data['issue_id']=$issueId;
         $data['lawyer_id']=$lawyerId;
        return $this->repo->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->repo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function getByIssue($issueId)
    {
        return $this->repo->getByIssue($issueId);
    }
}

