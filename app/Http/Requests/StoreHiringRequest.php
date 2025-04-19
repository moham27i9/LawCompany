<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHiringRequest extends FormRequest
{
    public function authorize()
    {
        return true; // نحن نتحكم في الـ role من middleware
    }

    public function rules()
    {
        return [
            'jopTitle' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
}

