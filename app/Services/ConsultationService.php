<?php

namespace App\Services;

use App\Repositories\ConsultationRepository;

class ConsultationService
{
    protected $repository;

    public function __construct(ConsultationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data,$cons_reqId)
    {
     
        
        $cons = $this->repository->create($data,$cons_reqId);
        if($cons)
        return $cons;
        return null;
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
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