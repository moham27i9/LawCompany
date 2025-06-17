<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    protected $repo;

    public function __construct(PermissionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function create(array $data,$id)
    {

        return $this->repo->create($data,$id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

        public function getPermissionsByUserId($userId)
    {
        return $this->repo->getUserPermissions($userId);
    }
}
