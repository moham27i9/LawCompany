<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HirringRequestNotification extends Notification
{
    protected $jopTitle;

    public function __construct($jopTitle)
    {
        $this->jopTitle = $jopTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'تم نشر  فرصة توظيف جديدة',
            'message' => '  المسمى الوظيفي : ' . $this->jopTitle,
        ];
    }

}
