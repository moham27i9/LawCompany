<?php

namespace App\Services;

use App\Repositories\FurloughRequestRepository;

class FurloughRequestService
{
    protected $repository;

    public function __construct(FurloughRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
{
    $user = auth()->user();

    
    if ($user->role->name === 'lawyer') {
        $data['covet_by_id'] = $user->lawyer->id;
        $data['covet_by_type'] = \App\Models\Lawyer::class;
    } else {
        $data['covet_by_id'] = $user->employee->id;
        $data['covet_by_type'] = \App\Models\Employee::class;
    }

    return $this->repository->create($data);
}
        public function myFurlough()
    {
        return $this->repository->getAllMyFurlough();
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