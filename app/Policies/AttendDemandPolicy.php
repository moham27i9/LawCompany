<?php

namespace App\Policies;

use App\Models\AttendDemand;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttendDemandPolicy
{

       public function before(User $user)
    {
        //if admin can do any thing
        if ($user->role === 'admin') {
            return true;
        }
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
    public function view(User $user, AttendDemand $attendDemand): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
  public function create(User $user, $issue): bool
{
    //  dd($user->role_id);
    if( $user->role_id === 1)
    return true;
    else if($issue->lawyers->contains('id', $user->lawyer->id))
    return true;

    return false;
}


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AttendDemand $attendDemand): bool
    {
        return $attendDemand->issue->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AttendDemand $attendDemand): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AttendDemand $attendDemand): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AttendDemand $attendDemand): bool
    {
        return false;
    }
}
