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
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $imageName = 'profile_images/user_' . auth()->id() . '.' . $image->extension();
            $image->storeAs('public/profile_images', $imageName);
        
            $data['image'] = 'storage/profile_images/' . $imageName;
        }
        
        return $this->profileRepository->create($data);
    }

        public function getByCurrentUser()
    {
        return $this->profileRepository->findByUserId(auth()->id());
    }

    public function updateCurrentUser(array $data)
    {
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $imageName = 'profile_images/user_' . auth()->id() . '.' . $image->extension();
            $image->storeAs('public/profile_images', $imageName);
        
            $data['image'] = 'storage/profile_images/' . $imageName;
        }
      
        return $this->profileRepository->updateByUserId(auth()->id(), $data);
    }

    public function deleteCurrentUser()
    {
        return $this->profileRepository->deleteByUserId(auth()->id());
    }

}
