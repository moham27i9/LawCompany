<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionRepository
{
    public function syncPermissions($roleId,$permissionId)
    {
        // return DB::table('role_permissions')->insert([
        //     'role_id'=> $roleId,
        //     'permission_id'=>$permissionId
        // ]);
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
