<?php
// app/Services/SessionTypeService.php

namespace App\Services;

use App\Repositories\SessionTypeRepository;

class SessionTypeService
{
    protected $repository;

    public function __construct(SessionTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->getAll();
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
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
