<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

  
    public function rules(): array
    {
        return [
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
        'phone.string' => 'رقم الهاتف يجب أن يكون نصًا.',
        'phone.max' => 'رقم الهاتف يجب ألا يتجاوز 15 رقمًا.',
        
        'age.integer' => 'العمر يجب أن يكون رقمًا صحيحًا.',
        'age.min' => 'العمر يجب ألا يقل عن 18 سنة.',
        'age.max' => 'العمر يجب ألا يتجاوز 100 سنة.',
        
        'address.string' => 'العنوان يجب أن يكون نصًا.',
        
        'scientificLevel.string' => 'المستوى العلمي يجب أن يكون نصًا.',
        
        'image.image' => 'الملف يجب أن يكون صورة.',
        'image.mimes' => ' jpg أو jpeg أو png:يجب أن تكون الصورة بصيغة:',
        'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميغابايت.',
    ];
}

}
