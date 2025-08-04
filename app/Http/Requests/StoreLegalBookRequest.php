<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLegalBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->role?->name === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'bookTitle' => 'required|string|max:255',
        ];

        if ($this->isMethod('post')) {
            $rules['book'] = 'required|file|mimes:pdf,docx,doc';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['book'] = 'nullable|file|mimes:pdf,docx,doc';
        }

        return $rules;
    }
}
