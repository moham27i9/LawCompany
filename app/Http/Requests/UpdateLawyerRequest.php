<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLawyerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [   
            'license_number' => 'sometimes|string',
        'experience_years' => 'sometimes|integer',
        'type' => 'sometimes|string',
        'specialization' => 'sometimes|string',
        'salary' => 'sometimes|numeric',
        'certificate' => 'sometimes|string',
        ];
    }
}
