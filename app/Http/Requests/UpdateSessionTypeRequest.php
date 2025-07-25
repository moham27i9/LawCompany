<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionTypeRequest extends FormRequest
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
   // UpdateSessionTypeRequest
public function rules(): array
{
    return [
        'type' => 'sometimes|string|unique:session_types,type,' . $this->route('id'),
        'points' => 'sometimes|integer|min:0',
        'description' => 'nullable|string',
    ];
}

}
