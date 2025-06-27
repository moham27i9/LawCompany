<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function create(array $data)
    {
        return Message::create($data);
    }

    public function getConversation($authId, $otherId)
    {
        return Message::where(function ($q) use ($authId, $otherId) {
                $q->where('sender_id', $authId)->where('receiver_id', $otherId);
            })
            ->orWhere(function ($q) use ($authId, $otherId) {
                $q->where('sender_id', $otherId)->where('receiver_id', $authId);
            })
            ->orderBy('created_at')
            ->get();
    }
}
