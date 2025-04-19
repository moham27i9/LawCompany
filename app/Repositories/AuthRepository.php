<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function getAll()
    {
        return User::with(['role:id,name'])->get();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function updateUserRole($userId, $roleId)
        {
            $user = User::findOrFail($userId);
            $user->role_id = $roleId;
            $user->save();
            return $user;
        }

}
