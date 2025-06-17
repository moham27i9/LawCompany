<?php

namespace App\Policies;

use App\Models\User;
use App\Models\permission;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{

    public function viewAny(User $user): bool
    {

        if( $user->role->name === 'admin')
        return true;
        return false;
    }

   public function viewUserPermissions(User $authUser, User $targetUser): bool
{

    if ($authUser->role->name === 'admin') {
        return true;
    }
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
    public function update(User $user, permission $permission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, permission $permission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, permission $permission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, permission $permission): bool
    {
        return false;
    }
}
