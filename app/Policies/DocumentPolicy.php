<?php
// app/Policies/DocumentPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Document;

class DocumentPolicy
{
    public function before(User $user)
    {
        //if admin can do any thing
        if ($user->role === 'admin') {
            return true;
        }
    }

    public function update(User $user, Document $document): bool
    {
        return $this->isAssignedLawyer($user, $document);
    }

    public function delete(User $user, Document $document): bool
    {
        return $this->isAssignedLawyer($user, $document);
    }

    public function create(User $user, $session): bool
    {
        return $session->lawyer_id === $user->lawyer->id;
    }

    protected function isAssignedLawyer(User $user, Document $document): bool
    {
        return $document->session->lawyer_id === $user->id;
    }
}
