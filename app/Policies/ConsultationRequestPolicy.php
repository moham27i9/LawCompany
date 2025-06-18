<?php

namespace App\Policies;

use App\Models\ConsultationRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConsultationRequestPolicy
{
      public function isAdmin(User $user, ConsultationRequest $consultationRequest)
    {
        return $user->role->name === 'admin'|| $user->lawyer;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ConsultationRequest $consultationRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ConsultationRequest $consultationRequest): bool
    {
       return $consultationRequest->user->id === $user->id;
    }

    public function updateStatus(User $user, ConsultationRequest $consultationRequest): bool
    {
      return  $user->role->name === 'admin' ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ConsultationRequest $consultationRequest): bool
    {
        if($user->role->name === 'admin')
        return true;
         return $consultationRequest->user->id === $user->id;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ConsultationRequest $consultationRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ConsultationRequest $consultationRequest): bool
    {
        return false;
    }
}
