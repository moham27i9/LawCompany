<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeRoleNotification extends Notification
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => '  قام المدير بتغيير دورك  ',
            'message' => '   دورك الجديد هو  : ' .'('. $this->role .')'.' قم بإضافة معلوماتك   ',
        ];
    }

}
