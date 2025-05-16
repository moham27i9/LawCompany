<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequestRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ];
    }

       public function messages(): array
{
    return [
        'title.string' => ' العنوان يجب أن يكون نصًا.',
        'title.max' => 'العنوان يجب ألا يتجاوز 255 محرفاً.',
        'description.string' => 'العنوان يجب أن يكون نصًا.',
    ];
}
}
