<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use App\Traits\ApiResponseTrait;

class ProfileController extends Controller
{
    use ApiResponseTrait;

    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function store(CreateProfileRequest $request)
    {
        $profile = $this->profileService->create($request->validated());
        if($profile)
        return $this->successResponse($profile,'Profile created successfully');
        return $this->errorResponse('can\'t create profile!', 422, null);
    }

        public function show($id)
    {
        $profile = $this->profileService->getUserProfile($id);
        if($profile)
        return $this->successResponse($profile, 'profile retrieved successfully');
        return $this->errorResponse('this user havn\'t profile yet!', 422, null);
    }

        public function showMyProfile()
    {
        $profile = $this->profileService->showMyProfile();
        if($profile)
        return $this->successResponse($profile, 'your profile retrieved successfully');
        return $this->errorResponse('you havn\'t profile yet!', 422, null);
    }

    public function update(UpdateProfileRequest $request)
    {

        $profile = $this->profileService->updateCurrentUser($request->validated());
        return $this->successResponse($profile, 'Profile updated successfully');
        return $this->errorResponse('no updates yet!', 422, null);
    }

    public function destroy()
    {
        $this->profileService->deleteCurrentUser();
        return $this->successResponse(null, 'Profile deleted successfully ');
    }

}
