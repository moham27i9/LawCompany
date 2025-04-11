<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
        public function rules(): array
        {
            return [
                'email' => ['required', 'email', 'exists:users,email'],
                'token' => ['required'],
                'password' => ['required', 'confirmed', 'min:8'],
            ];
        }
}
