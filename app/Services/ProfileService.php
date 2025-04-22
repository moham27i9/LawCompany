<?php

namespace App\Services;

use App\Repositories\ProfileRepository;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function create(array $data)
    {
        if(!auth()->user()->profile)
        return $this->profileRepository->create($data);
        return null;
    }

    public function showMyProfile()
    {
        $user_id = auth()->user()->id;
   
        $profile = $this->profileRepository->findByUserId($user_id);
          if($profile)
        return $profile;
        return null;
    }
   

        public function getUserProfile($id)
    {
        $profile = $this->profileRepository->findByUserId($id);
        if($profile)
        return $profile;
        return null;
    }

    public function updateCurrentUser(array $data)
    {
        return $this->profileRepository->updateByUserId(auth()->id(), $data);
    }

    public function deleteCurrentUser()
    {
        return $this->profileRepository->deleteByUserId(auth()->id());
    }

}
