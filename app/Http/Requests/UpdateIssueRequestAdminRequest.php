<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequestAdminRequest extends FormRequest
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
            'admin_note' => 'sometimes|string',
            'status' => 'sometimes|in:approved,rejected',
             'scheduled_at' => 'sometimes|date', // أو date_format:Y-m-d H:i
        ];
    }
 public function messages(): array
{
    return [
        'admin_note.string' => 'ملاحظة المدير يجب أن تكون نصاً.',
        'status.in' => '"rejected" (مرفوض) أو "approved" (مقبول):يجب أن تكون الحالة إما ',
    ];
}

}
