<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository
{
    public function getAll()
    {
        return Permission::all();
    }

    public function create(array $data,$id)
    {
        return Permission::create([
            'name'=>$data['name'],
            'app_route_id'=>$id
        ]);
    }

    public function delete($id)
    {
        return Permission::findOrFail($id)->delete();
    }
}
