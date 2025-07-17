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
           'certificate' => 'required|file|mimes:pdf,doc,docx,txt,png,jpg,jpeg|max:2048',
        ];
    }

     public function messages(): array
{
    return [
        'license_number.required' => 'رقم الرخصة مطلوب',
        'license_number.string' => 'رقم الرخصة يجب أن يكون نصًا',
        'experience_years.integer' => 'عدد سنوات الخبرة يجب أن يكون رقمًا صحيحًا',
        'experience_years.required' => 'عدد سنوات الخبرة مطلوب ',
        'type.string' => '(lawyer أو intern) نوع المحامي يجب أن يكون إما.',
        'type.required' => ' نوع المحامي مطلوب.',
        'specialization.string' => 'التخصص يجب أن يكون نصًا.',
        'specialization.required' => 'التخصص مطلوب',
        'certificate.required' => ' الشهادة مطلوبة',
        'certificate.file' => ' الشهادة يجب أن تكون ملفاً',
        'certificate.max' => ' 2MB حجم الشهادة يجب أن لا يتجاوز  ',
        'certificate.mimes' => 'pdf,doc,docx,txt :ملف الشهادة يجب أن يكون بتنسيق',
      
    ];
}
}
