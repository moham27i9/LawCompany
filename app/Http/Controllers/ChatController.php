<?php

namespace App\Http\Controllers  ;

use App\Http\Controllers\Controller;
use App\Models\FcmToken;
use App\Models\Message;
use App\Models\User;
use App\Models\UserFcmToken;
use App\Services\FcmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct(private FcmService $fcm) {}

    // إرسال رسالة
 public function send(Request $request)
{
    $data = $request->validate([
        'sender_id'   => 'required|exists:users,id',
        'receiver_id' => 'required|exists:users,id',
        'message'     => 'required|string',
    ]);

    $message = Message::create($data);
        $tokens = FcmToken::where('user_id', $data['receiver_id'])
                    ->pluck('fcm_token')
                    ->filter()
                    ->toArray();


                Log::info($tokens);

    $senderName = User::find($data['sender_id'])?->name ?? 'New message';

    foreach ($tokens as $token) {
        $this->fcm->send(
            toToken: $token,
            title: $senderName,
            body: $data['message'],
            data: [
                'type' => 'chat',
                'sender_id' => (string)$data['sender_id'],
                'receiver_id' => (string)$data['receiver_id'],
                'message_id' => (string)$message->id,
            ]
        );
    }

    return response()->json(['success' => true, 'message' => $message]);
}


    // جلب محادثة بين مستخدمين
    public function conversation(Request $request, $userA, $userB)
    {
        $messages = Message::where(function ($q) use ($userA, $userB) {
                $q->where('sender_id', $userA)->where('receiver_id', $userB);
            })->orWhere(function ($q) use ($userA, $userB) {
                $q->where('sender_id', $userB)->where('receiver_id', $userA);
            })
            ->orderBy('created_at')
            ->get();

        return response()->json(['data' => $messages]);
    }
}
