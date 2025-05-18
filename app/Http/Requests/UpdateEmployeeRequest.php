<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'hire_date' => 'sometimes|date',
            'salary' => 'sometimes|numeric',
            'certificate' => 'sometimes|string',
        ];
    }

    public function messages(): array
{
    return [

        'salary.numeric' => 'الراتب يجب أن يكون رقمًا.',
        'hire_date.date' => 'تاريخ التوظيف يجب أن يكون تاريخًا صحيحًا.',
        'certificate.string' => 'رابط الشهادة يجب أن يكون نصًا.',
    ];
}

}
