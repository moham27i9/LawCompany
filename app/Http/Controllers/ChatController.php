<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessage;

class ChatController extends Controller
{
    // عرض صفحة المحادثة مع مستخدم معيّن
    public function index($receiver_id)
    {
        $receiver = User::findOrFail($receiver_id);

        $messages = Message::where(function ($q) use ($receiver_id) {
            $q->where('sender_id', Auth::id())
              ->where('receiver_id', $receiver_id);
        })->orWhere(function ($q) use ($receiver_id) {
            $q->where('sender_id', $receiver_id)
              ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return view('chat', compact('receiver', 'messages'));
    }

    // إرسال رسالة جديدة
    public function send(Request $request)
    {
        \Log::info('📥 دالة send تم استدعاؤها');

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
      \Log::info('✅ الرسالة تم إنشاؤها', $message->toArray());

        broadcast(new NewMessage($message))->toOthers();

        return response()->json([
            'status' => 'success',
            'data' => $message,
        ]);
    }

    // جلب الرسائل مع مستخدم معيّن
    public function fetch($userId)
    {
        $messages = Message::where(function ($q) use ($userId) {
            $q->where('sender_id', auth()->user()->id)
              ->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->where('receiver_id', auth()->user()->id);
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }
}
