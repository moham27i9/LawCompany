<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIssueRequest extends FormRequest
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
            'total_cost' => 'sometimes|numeric',
            'number_of_payments' => 'required|integer',
            'lawyer_percentage' => 'sometimes|integer|max:100',
            'title' => 'required|string|max:255',
            'issue_number' => 'required|string|unique:issues,issue_number',
            'category_id' => 'required|exists:issue_categories,id',
            'amount_paid' => 'nullable|numeric',
            'court_name' => 'required|string',
            'opponent_name' => 'required|string',
            'status' => 'required|in:open,in_progress,closed,archived',
            'priority' => 'required|in:normal,medium,high,critical',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',

        ];
    }
}
