<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
         return auth()->user()->role->name === "admin"|| auth()->user()->role->name === "accountant";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'description' => 'sometimes|string',
            'amount' => 'sometimes|numeric|min:0',
            'type' => 'sometimes|in:operational,payroll,case,other',
        ];
    }
}
