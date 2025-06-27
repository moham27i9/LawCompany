<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatViewController extends Controller
{
    public function chatPage(User $user)
    {
        // لا تسمح للشخص بمحادثة نفسه
        if (Auth::id() === $user->id) {
            abort(403);
        }

        return view('chat', [
            'receiver' => $user
        ]);
    }
}

