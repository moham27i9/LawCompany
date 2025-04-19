<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLawyerRequest extends FormRequest
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
            'license_number' => 'required|string|unique:lawyers,license_number',
            'experience_years' => 'required|integer|min:0',
            'type' => 'required|string',
            'specialization' => 'required|string',
            'certificate' => 'required|string',
        ];
    }
}
