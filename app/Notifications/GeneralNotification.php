<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $body;
    protected $url;
    public function __construct($title,$body,$url)
    {
        $this->title = $title;
        $this->body = $body;
        $this->url = $url;
    }

    public function via($notifiable)
    {
          return ['database', 'fcm'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'url' => $this->url,
        ];
    }

public function toFcm($notifiable)
{
    // نفترض أن عندك علاقة في موديل User -> fcmTokens()
    $tokens = $notifiable->fcmTokens()->pluck('token')->toArray();

    return [
        'tokens' => $tokens,
        'notification' => [
            'title' => $this->title,
            'body' => $this->body,
        ],
        'data' => [
            'body' => $this->body,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        ]
    ];
}

}
