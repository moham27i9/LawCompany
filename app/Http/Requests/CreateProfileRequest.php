<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProfileRequest extends FormRequest
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
            'phone' => 'required|string|max:15',
            'age' => 'required|integer|min:18|max:100',
            'address' => 'required|string',
            'scientificLevel' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ];
    }
}
