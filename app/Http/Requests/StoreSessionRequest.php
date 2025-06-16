<?php
namespace App\Http\Requests;

use App\Models\Issue;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
{
   
public function rules(): array
{
    return [
        'outcome' => 'sometimes|in:held,postponed,canceled,rescheduled,closed,judged,attended_by_lawyer_only,attended_by_client_only,absent',
        'session_type_id' => ['required', 'exists:session_types,id'],   
        'is_attend' => 'sometimes|boolean',
        'lawyer_id' => ['required', 'integer', function ($attribute, $value, $fail) {
            $issueId = request()->route('issue_id'); 
            $issue = Issue::with('lawyers')->find($issueId);
            if (!$issue) {
                $fail("Issue not found.");
                return;
            }
            $session= $issue->sessions;
            $lawyerIds = $issue->lawyers->pluck('id')->toArray();
            if (!in_array($value, $lawyerIds)) {
                $fail("This lawyer is not assigned to this issue.");
            }
            // if (in_array($value, $session->pluck('lawyer_id')->toArray())) {
            //     $fail("This lawyer is assigned to this session actually.");
            // }
        }],
    ];
}
         public function messages(): array
{
    return [

        'session_type_id.required' => 'حقل نوع الجلسة مطلوب.',
        'is_attend.boolean'    => '(true أو false)قيمة الحضور يجب أن تكون .',
        'outcome.in' => 'held, postponed, canceled,rescheduled,closed, judged, attended_by_lawyer_only, attended_by_client_only, absent :نتيجة الجلسة يجب أن تكون واحدة من  ',
        'lawyer_id.required' => 'معرف المحامي مطلوب.',
        'lawyer_id.integer' => 'معرف المحامي يجب أن يكون عدداً صحيحاً.',
    ];
}

}
