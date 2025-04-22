<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Models\User;

class ProfileRepository
{
    public function create(array $data)
    {
        $user_id = auth()->user()->id;
       
        return Profile::create([
           'phone'=> $data['phone'],
           'address'=> $data['address'],
           'age'=> $data['age'],
           'scientificLevel'=> $data['scientificLevel'],
           'user_id'=> $user_id,
        ]);
    }

        public function findByUserId($userId)
    {
        return Profile::with('user')->where('user_id', $userId)->first();
    }


    public function updateByUserId($userId, array $data)
    {
        $profile = Profile::where('user_id', $userId)->firstOrFail();
        $profile->update($data);
        return $profile;
    }

    public function deleteByUserId($userId)
    {
        $profile = Profile::where('user_id', $userId)->firstOrFail();
        $profile->delete();
        return true;
    }

}
