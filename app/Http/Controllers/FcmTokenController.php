<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FcmToken;
use App\Models\UserFcmToken;
use Illuminate\Http\Request;

class FcmTokenController extends Controller
{
    // للبساطة، نأخذ user_id من الطلب. لاحقاً اربطه بـ auth()->id()
    public function store(Request $request)
    {
        $data = $request->validate([
            'fcm_token' => 'required|string',
            'device_type' => 'nullable|string'
        ]);

        FcmToken::updateOrCreate(
            ['user_id' => $data['user_id']], // إذا كان المستخدم لديه توكن مسبقًا يحدث
        ['fcm_token' => $data['token']]
        );

        return response()->json(['success' => true]);
    }
}
