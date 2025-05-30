<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssuePriorityRequest extends FormRequest
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
                'priority' => 'required|in:normal,medium,high,critical'
        ];
    }

     public function messages(): array
{
    return [
        'priority.required' => ' الأولوية مطلوبة.',
        'priority.in' => '"critical" (حرجة) أو"high" (عالية) ,"medium" (متوسطة) , "normal" (عادية):يجب أن تكون الحالة إما ',
    ];
}
}
