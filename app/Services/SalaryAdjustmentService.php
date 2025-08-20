<?php

namespace App\Services;

use App\Repositories\SalaryAdjustmentRepository;

class SalaryAdjustmentService
{
    protected $repository;

    public function __construct(SalaryAdjustmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data,$user_id)
    {
        return $this->repository->create($data,$user_id);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    { 
        return $this->repository->delete($id);
    }
}
