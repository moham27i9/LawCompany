<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role->name === 'admin';
    }

    public function rules(): array
    {
        return [
            'name'            => 'sometimes|string|max:255',
            'address'         => 'sometimes|string|max:255',
            'foundation_date' => 'sometimes|date',
            'description'     => 'sometimes|string',
            'goals'           => 'sometimes|string',
            'vision'          => 'sometimes|string',
        ];
    }
}
