<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionRepository
{
      public function all()
    {
        return Role::with(['users.role:id,name','users.profile'])->get();
    }

      public function getById($id)
    {
        return Role::findOrFail($id);
    }

      public function destroy($id)
    {
        $role = Role::findOrFail($id);
        return $role->delete();
    }

    public function syncPermissions($roleId,$permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
         return $permission->roles()->attach($roleId);
   
    }

    public function getPermissions($roleId)
    {
        return Role::with('permissions')->findOrFail($roleId);
    }
    public function create(array $data)
    {
        return Role::create($data);
    }
}
