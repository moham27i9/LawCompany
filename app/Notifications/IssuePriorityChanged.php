<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

    class IssuePriorityChanged extends Notification implements ShouldQueue
    {
        use Queueable;
    
        protected $issue;
        protected $newPriority;
    
        public function __construct($issue, $newPriority)
        {
            $this->issue = $issue;
            $this->newPriority = $newPriority;
        }
    
        public function via($notifiable)
        {
            return ['database'];
        }
    
        public function toDatabase($notifiable)
        {
            return [
                'title' => 'تم تغيير أولوية القضية',
                'body' => 'تم تغيير أولوية القضية رقم ' . $this->issue->issue_number . ' إلى: ' . $this->newPriority,
                'url' => '/issues/' . $this->issue->id,
            ];
        }
    }
    