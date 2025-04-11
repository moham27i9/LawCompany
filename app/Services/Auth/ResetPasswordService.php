<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class ResetPasswordService
{
    public function handle(array $data): void
    {
        $reset = DB::table('password_resets')
                    ->where('email', $data['email'])
                    ->where('token', $data['token'])
                    ->first();

        if (!$reset || Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
            throw ValidationException::withMessages(['token' => 'رمز إعادة التعيين غير صالح أو منتهي.']);
        }

        $user = User::where('email', $data['email'])->firstOrFail();

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        // حذف التوكن بعد الاستخدام
        DB::table('password_resets')->where('email', $data['email'])->delete();
    }
}
