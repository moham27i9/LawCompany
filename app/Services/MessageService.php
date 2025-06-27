<?php

namespace App\Services;

use App\Repositories\MessageRepository;
use App\Events\NewMessage;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    protected $repo;

    public function __construct(MessageRepository $repo)
    {
        $this->repo = $repo;
    }

    public function send(array $data)
    {
        $data['sender_id'] = Auth::id();
        $message = $this->repo->create($data);
        broadcast(new NewMessage($message))->toOthers();
        return $message;
    }

    public function getConversationWith($userId)
    {
        return $this->repo->getConversation(Auth::id(), $userId);
    }
}
