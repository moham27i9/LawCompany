<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionTypeRequest extends FormRequest
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
  // StoreSessionTypeRequest
public function rules(): array
{
    return [
        'type' => 'required|string|unique:session_types,type',
        'points' => 'required|integer|min:0',
        'description' => 'nullable|string',
    ];
}

}
