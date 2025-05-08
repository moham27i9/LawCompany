<?php
namespace App\Http\Requests;

use App\Models\Issue;
use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'outcome' => 'required|string',
            'court' => 'required|string',
            'type' => 'required|string',
            'is_attend' => 'required|boolean',
            'lawyer_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                $issueId = request()->route('issue_id'); // من URL
                $issue = Issue::find($issueId);
                if (!$issue || !in_array($value, $issue->lawyer_ids ?? [])) {
                    $fail("This lawyer is not assigned to this issue.");
                }
            }],
        ];
    }
}
