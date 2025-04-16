<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications()
        {
            return response()->json([
                'notifications' => auth()->user()->notifications
            ]);
        }

}
