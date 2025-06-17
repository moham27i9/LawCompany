<?php

namespace App\Policies;

use App\Models\FurloughRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FurloughRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        
        if( $user->role->name === 'admin')
        return true;
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FurloughRequest $furloughRequest): bool
    {
        return $user->id === $furloughRequest->covet_by_id || $user->role_id ===1;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if( $user->lawyer)
         return true;
       else if( $user->employee)
         return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FurloughRequest $furloughRequest): bool
    {
        
        return $user->id === $furloughRequest->covet_by_id ;
    }

    public function updateStatus(User $user, FurloughRequest $furloughRequest): bool
    {  
        return  $user->role->name === 'admin' ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FurloughRequest $furloughRequest): bool
    {
        return $user->id === $furloughRequest->covet_by_id || $user->role_id ===1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FurloughRequest $furloughRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FurloughRequest $furloughRequest): bool
    {
        return false;
    }
}
