<?php

namespace App\Services;

use App\Models\User;
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
        if(!auth()->user()->profile){

            if (isset($data['image'])) {
                $image = $data['image'];
                $imageName = 'user_' . auth()->user()->id . '.' . $image->extension();
                
                // تخزين داخل disk = public
                $image->storeAs('profile_images', $imageName, 'public');
            
                // حفظ المسار في قاعدة البيانات
                $data['image'] = 'storage/profile_images/' . $imageName;
            }
            
            
            return $this->profileRepository->create($data);
        }
        return null;
    }

  public function showMyProfile()
{
    $user = auth()->user();
    $profile = $this->profileRepository->findByUserId($user->id);

    if (!$profile) {
        return null;
    }

    return [
        'address' => $profile['address'],
        'phone' => $profile->phone,
        'scientificLevel' => $profile->scientificLevel,
        'age' => $profile->age,
        'image' => $profile->image ? asset($profile->image) : null,
        'user_id' => $profile->user_id,
        'role' => [
            'id' => $user->role->id,
            'name' => $user->role->name
        ],
    ];
}

   

    public function getUserProfile($id)
{
    $profile = $this->profileRepository->findByUserId($id);
    $user=User::find($id);
    if (!$profile) {
        return null;
    }

    return [
        'address' => $profile['address'],
        'phone' => $profile->phone,
        'scientificLevel' => $profile->scientificLevel,
        'age' => $profile->age,
        'image' => $profile->image ? asset($profile->image) : null,
        'user_id' => $profile->user_id,
        'role' => [
            'id' => $user->role->id,
            'name' => $user->role->name
        ],
    ];
}


    public function updateCurrentUser(array $data)
    {
        $id = auth()->user()->id;
        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = 'user_' . $id . '.' . $image->extension();
            
            // تخزين داخل disk = public
            $image->storeAs('profile_images', $imageName, 'public');
        
            // حفظ المسار في قاعدة البيانات
            $data['image'] = 'storage/profile_images/' . $imageName;
        }
        
        
        return $this->profileRepository->updateByUserId(auth()->user()->id, $data);
    }

    public function deleteCurrentUser()
    {
        return $this->profileRepository->deleteByUserId(auth()->id());
    }

}
