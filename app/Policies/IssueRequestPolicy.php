<?php

namespace App\Policies;

use App\Models\IssueRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IssueRequestPolicy
{
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
    public function view(User $user, IssueRequest $issueRequest): bool
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
    public function update(User $user, IssueRequest $issueRequest)
    {
        return $user->id === $issueRequest->user_id;
    }
    

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IssueRequest $issueRequest): bool
    {
        return $user->id === $issueRequest->user_id || $user->role_id ===1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IssueRequest $issueRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IssueRequest $issueRequest): bool
    {
        return false;
    }
}
