<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminEvaluationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->user()->role->name === 'admin'; // أو تحقق الصلاحية المناسبة
    }

    public function rules(): array
    {
        return [
            'points' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string'],
        ];
    }
}
