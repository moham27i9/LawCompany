<?php

namespace App\Services;

use App\Repositories\RolePermissionRepository;

class RolePermissionService
{
    protected $repo;

    public function __construct(RolePermissionRepository $repo)
    {
        $this->repo = $repo;
    }

     public function all()
    {
        return $this->repo->all();
    }

     public function getById($id)
    {
        return $this->repo->getById($id);
    }
     public function destroy($id)
    {
        return $this->repo->destroy($id);
    }
    public function assignPermissions($roleId,$permissionId)
    {
        return $this->repo->syncPermissions($roleId, $permissionId);
    }

    public function getPermissions($roleId)
    {
        return $this->repo->getPermissions($roleId);
    }

    public function create(array $data)
    {
        return $this->repo->create($data); 
    }
}
