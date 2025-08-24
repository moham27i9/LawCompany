<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\User;
use Cache;

class PermissionRepository
{
    public function getAll()
    {
            return Cache::remember('permissions_all', now()->addMinutes(60), function () {
            return Permission::all();
    });
    }

    public function create(array $data,$id)
    {
        Cache::forget('permissions_all');
        return Permission::create([
            'name'=>$data['name'],
            'app_route_id'=>$id
        ]);
    }

    public function delete($id)
    {
        Cache::forget('permissions_all');
        return Permission::findOrFail($id)->delete();
    }

     public function update( array $data, $id)
    {

        $permission = Permission::findOrFail($id);
        $permission->update($data);
        $permission->save();
        Cache::forget('permissions_all');
        return $permission;
    }
        public function getUserPermissions($userId)
    {
        $user = User::with('role.permissions')->findOrFail($userId);

        return $user->role?->permissions ?? collect(); // return empty collection if no role
    }
}
