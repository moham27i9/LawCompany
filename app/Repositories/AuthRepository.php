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
        return User::with(['role:id,name','profile'])->get();
    }

    public function find($id)
    {
        return User::with('profile')->findOrFail($id);
    }


    public function findrole($id)
    {
        $user =User::findOrFail($id);
        return $user->role->name;
    }

    public function updateUserRole($userId, $roleId)
        {
            $user = User::findOrFail($userId);
            $user->role_id = $roleId;
            $user->save();
            return $user;
        }

         public function clientCount(): int
    {
        return User::where('role_id', 2)->count();
    }

}
