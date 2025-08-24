<?php

namespace App\Repositories;

use App\Models\User;
use Cache;

class AuthRepository
{
    public function createUser(array $data)
    {
         Cache::forget('users_all');
        return User::create($data);
    }

public function getAll()
{
    return Cache::remember('users_all', now()->addMinutes(15), function () {
        return User::with(['role:id,name', 'profile'])->get();
    });
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
        return Cache::remember('user_count_all', now()->addMinutes(20), function () {
        return User::where('role_id', 2)->count();
    });
    }

}
