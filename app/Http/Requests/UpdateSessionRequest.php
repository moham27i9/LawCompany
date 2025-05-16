<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
{

      public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'outcome' => 'nullable|string',
            'type' => 'sometimes|string',
            'is_attend' => 'nullable|boolean',
            'issue_id' => 'sometimes|exists:issues,id',
            'lawyer_id' => 'sometimes|exists:lawyers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'outcome.string'       => 'يجب أن يكون نتيجة الجلسة نصًا.',
            'type.string'          => 'يجب أن يكون نوع الجلسة نصًا.',
            'is_attend.boolean'    => '(true أو false)قيمة الحضور يجب أن تكون صحيحة .',
            'issue_id.exists'      => 'القضية المحددة غير موجودة.',
            'lawyer_id.exists'     => 'المحامي المحدد غير موجود.',
        ];
    }

}
