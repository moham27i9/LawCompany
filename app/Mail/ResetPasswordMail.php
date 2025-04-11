<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('إعادة تعيين كلمة المرور')
                    ->view('emails.reset-password');
    }
}
