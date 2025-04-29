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
            'issue_number'=> $data['issue_number'] ,
            'priority'=> $data['priority'] ,
            // 'amount_paid'=> $data['amount_paid'] ,
            'total_cost'=> $data['total_cost'] ,
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
        $issue->update($data);
        return $issue;
    }
    public function delete($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return true;
    }


}
