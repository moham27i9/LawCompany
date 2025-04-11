<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Log;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ForgotPasswordService
{
    public function handle(array $data): void
    {
        $token = Str::random(64);

        // حذف التوكنات القديمة
        DB::table('password_resets')->where('email', $data['email'])->delete();

        // إنشاء توكن جديد
        DB::table('password_resets')->insert([
            'email' => $data['email'],
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

            // تسجيل التوكن في الـ logs
    Log::info("تم إنشاء توكن إعادة تعيين كلمة المرور للـ email: {$data['email']}. التوكن هو: {$token}");
        Mail::to($data['email'])->send(new ResetPasswordMail());
    }
}
