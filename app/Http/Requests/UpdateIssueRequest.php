<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
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
            'total_cost' => 'sometimes|decimal:2',
            'number_of_payments' => 'sometimes|integer',
            'title' => 'sometimes|string|max:255',
            'issue_number' => 'sometimes|string',
            'category' => 'sometimes|string',
           'amount_paid' => 'sometimes|numeric',
            'court_name' => 'sometimes|string',
            'opponent_name' => 'sometimes|string',
            'status' => 'sometimes|in:open,in_progress,closed,archived',
            'priority' => 'sometimes|in:normal,medium,high,critical',
            'end_date' => 'sometimes|date',
            'description' => 'sometimes|string',
            'lawyer_ids'   => ['sometimes', 'array', 'size:4'],
            'lawyer_ids.*' => ['integer', 'exists:users,id'],
        ];
        
    }
}
