<?php

namespace App\Repositories;

use App\Models\Issue;

class IssueRepository
{
    public function create(array $data , $user_id)
    {
        return Issue::create([
            'title'=> $data['title'] ,
            'status'=> $data['status'] ,
            'category'=> $data['category'] ,
            'start_date'=> $data['start_date'] ,
            'end_date'=> $data['end_date'] ,
            'description'=> $data['description'] ,
            'issue_number'=> $data['issue_number'] ,
            'priority'=> $data['priority'] ,
            'amount_paid'=> $data['amount_paid'] ,
            'total_cost'=> $data['total_cost'] ,
            'lawyer_percentage'=> $data['lawyer_percentage'] ,
            'number_of_payments'=> $data['number_of_payments'] ,
            'court_name'=> $data['court_name'] ,
            'opponent_name'=> $data['opponent_name'] ,
            'user_id'=> $user_id,
        ]);
    }
    public function getAll()
    {
        return Issue::all();
    }

    public function getById($id)
    {
        return Issue::findOrFail($id);
    }
    public function update($id, array $data)
    {
        $issue = Issue::findOrFail($id);
        $issue->update([
            'title'=> $data['title'] ?? $issue->title ,
            'status'=> $data['status'] ?? $issue->status,
            'category'=> $data['category']?? $issue->category ,
            'end_date'=> $data['end_date'] ?? $issue->end_date,
            'description'=> $data['description'] ?? $issue->description,
            'issue_number'=> $data['issue_number'] ?? $issue->issue_number,
            'priority'=> $data['priority'] ?? $issue->priority,
            'amount_paid'=> $data['amount_paid'] ?? $issue->amount_paid,
            'total_cost'=> $data['total_cost'] ?? $issue->total_cost,
            'number_of_payments'=> $data['number_of_payments']?? $issue->number_of_payments ,
            'court_name'=> $data['court_name'] ?? $issue->court_name,
            'opponent_name'=> $data['opponent_name'] ?? $issue->opponent_name,
        ]);
        $info =[
            'title'=> $data['title'] ?? $issue->title ,
            'status'=> $data['status'] ?? $issue->status,
            'category'=> $data['category']?? $issue->category ,
            'end_date'=> $data['end_date'] ?? $issue->end_date,
            'description'=> $data['description'] ?? $issue->description,
            'issue_number'=> $data['issue_number'] ?? $issue->issue_number,
            'priority'=> $data['priority'] ?? $issue->priority,
            'amount_paid'=> $data['amount_paid'] ?? $issue->amount_paid,
            'total_cost'=> $data['total_cost'] ?? $issue->total_cost,
            'number_of_payments'=> $data['number_of_payments']?? $issue->number_of_payments ,
            'court_name'=> $data['court_name'] ?? $issue->court_name,
            'opponent_name'=> $data['opponent_name'] ?? $issue->opponent_name,
        ];
        return $info;

    }
    public function delete($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return true;
    }

    public function updatePriority($issueId, $newPriority)
    {

        $issue = Issue::findOrFail($issueId);
        $issue->priority = $newPriority;
        $issue->save();
        return $issue;
    }

   public function syncIssue($issueId, array $lawyerIds)
{
    $issue = Issue::findOrFail($issueId);
    return $issue->lawyers()->syncWithoutDetaching($lawyerIds); // يُضيف بدون حذف الموجود
}
public function getLawyersByIssueId($caseId)
{
    $issue = Issue::with('lawyers.user.profile')->findOrFail($caseId);

    return $issue->lawyers->map(function ($lawyer) {
        $profile = $lawyer->user->profile;

        return [
            'id'               =>$lawyer->id,
            'name'             => $lawyer->user->name,
            'email'             => $lawyer->user->email,
            'license_number'   => $lawyer->license_number,
            'experience_years' => $lawyer->experience_years,
            'certificate'      => $lawyer->certificate,
            'specialization'   => $lawyer->specialization,
            'age'              => $profile->age ?? null,
            'phone'            => $profile->phone ?? null,
            'address'          => $profile->address ?? null,
            'scientificLevel'  => $profile->scientificLevel ?? null,
            'image'            => $profile->image ? asset($profile->image) : null,
        ];
    });
}


    public function track($id)
    {

            return Issue::with([
        'sessions',
        'sessions.appointments', 
        'sessions.documents',
        'lawyers',
    ])->findOrFail($id);
    }

      public function getIssuesForClient() {
         return Issue::where('user_id',auth()->user()->id)->get();
    }

  public function getSessionsForClient() {
    $sessions =Issue::where('user_id',auth()->user()->id)->with('sessions')->get();

        return  $sessions;
    }

}
