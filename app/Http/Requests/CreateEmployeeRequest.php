<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'hire_date' => 'required|date',
            'type' => 'required|in:HR,accountant',
            'salary' => 'required|numeric',
           'certificate' => 'required|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg|max:2048',
        ];
    }
}
