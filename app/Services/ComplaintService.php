<?php 
namespace App\Services;

use App\Repositories\ComplaintRepository;

class ComplaintService
{

    protected $repository;
    public function __construct(ComplaintRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }
    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function myComplaints()
    {
        return $this->repository->myComplaints();
    }

    public function update($id,array $data)
    {
        return $this->repository->update($id,$data);
    }

    public function updateStatus($id,array $data)
    {
        return $this->repository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }


}