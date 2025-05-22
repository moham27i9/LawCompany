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
        'certificate' => 'sometimes|file|mimes:pdf,doc,docx,txt|max:2048',
             'phone' => 'sometimes|string|max:15',
            'age' => 'sometimes|integer|min:18|max:100',
            'address' => 'sometimes|string',
            'scientificLevel' => 'sometimes|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
{
    return [
        'license_number.string' => 'رقم الرخصة يجب أن يكون نصًا',
        'experience_years.integer' => 'عدد سنوات الخبرة يجب أن يكون رقمًا صحيحًا',
        'type.string' => '(lawyer أو intern) نوع المحامي يجب أن يكون إما.',
        'specialization.string' => 'التخصص يجب أن يكون نصًا.',
        'certificate.file' => ' الشهادة يجب أن تكون ملفاً',
        'certificate.max' => ' 2MB حجم الشهادة يجب أن لا يتجاوز  ',
        'certificate.mimes' => 'pdf,doc,docx,txt :ملف الشهادة يجب أن يكون بتنسيق',
        'phone.string' => 'رقم الهاتف يجب أن يكون نصًا',
        'phone.max' => 'رقم الهاتف لا يجب أن يتجاوز 15 رقمًا.',
        'age.integer' => 'العمر يجب أن يكون رقمًا.',
        'age.min' => 'العمر يجب أن لا يقل عن 18 سنة.',
        'age.max' => 'العمر يجب أن لا يزيد عن 100 سنة.',
        'address.string' => 'العنوان يجب أن يكون نصًا.',
        'scientificLevel.string' => 'التحصيل العلمي يجب أن يكون نصًا.',
        'image.image' => 'الملف يجب أن يكون صورة.',
        'image.mimes' => ' jpg, jpeg, png:الصورة يجب أن تكون من نوع:',
        'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميغابايت.',
    ];
}

}
