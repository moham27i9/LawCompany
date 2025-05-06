<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'outcome' => 'nullable|string',
            'court' => 'required|string',
            'type' => 'required|string',
            'is_attend' => 'nullable|boolean',
            'issue_id' => 'required|exists:issues,id',
            'lawyer_id' => 'required|exists:lawyers,id',
        ];
    }
}
