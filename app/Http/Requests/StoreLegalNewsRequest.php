<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLegalNewsRequest extends FormRequest
{

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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        if ($this->isMethod('post')) {
            $rules['title'] = 'required|string|max:255';
            $rules['description'] = 'required|string';
        } elseif ($this->isMethod('put')) {
            $rules['title'] = 'required|string|max:255';
            $rules['description'] = 'required|string';
        }

        return $rules;
    }
}
