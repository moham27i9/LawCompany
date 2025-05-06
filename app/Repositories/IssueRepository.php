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
            'number_of_payments'=> $data['number_of_payments'] ,
            'court_name'=> $data['court_name'] ,
            'opponent_name'=> $data['opponent_name'] ,
            'lawyer_ids' => $data['lawyer_ids'] ?? [], // ✅ هنا
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
        // dd($data);
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
            'lawyer_ids' => array_key_exists('lawyer_ids', $data) ? $data['lawyer_ids'] : $issue->lawyer_ids,
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
            'lawyer_ids' => array_key_exists('lawyer_ids', $data) ? $data['lawyer_ids'] : $issue->lawyer_ids,
        ];
        return $info;

    }
    public function delete($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return true;
    }


}
