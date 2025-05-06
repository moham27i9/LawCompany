<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'outcome' => 'nullable|string',
            'court' => 'sometimes|string',
            'type' => 'sometimes|string',
            'is_attend' => 'nullable|boolean',
            'issue_id' => 'sometimes|exists:issues,id',
            'lawyer_id' => 'sometimes|exists:lawyers,id',
        ];
    }
}
