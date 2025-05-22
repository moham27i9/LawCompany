<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
    
            'status' => 'required|in:open,in_progress,closed,archived',
   
        ];
        
    }

    public function messages(): array
    {
        return [
            'status.required' => 'الحالة مطلوبة!.',
            'status.in' => 'open, in_progress, closed, archived :الحالة يجب أن تكون واحدة من.',
        ];
    }

}
