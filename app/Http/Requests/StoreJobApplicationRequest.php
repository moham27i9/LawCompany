<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StoreJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
 
            'cv' => 'required|string',
        ];
    }
}

