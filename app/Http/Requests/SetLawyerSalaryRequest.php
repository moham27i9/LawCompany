<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetLawyerSalaryRequest extends FormRequest
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
            'salary' => 'required|numeric|min:0|max:1000000',
        ];
    }

    public function messages()
    {
        return [
            'salary.required' => 'يرجى إدخال قيمة الراتب.',
            'salary.numeric' => 'يجب أن يكون الراتب رقماً.',
            'salary.min' => 'لا يمكن أن يكون الراتب سالباً.',
        ];
    }
}
