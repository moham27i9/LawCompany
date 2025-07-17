<?php

namespace App\Repositories;

use App\Models\Issue;
use App\Models\IssueCategory;

class IssueRepository
{
    public function create(array $data , $user_id)
    {
        return Issue::create([
            'title'=> $data['title'] ,
            'status'=> $data['status'] ,
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
            'category_id'=> $data['category_id'] ,
            'user_id'=> $user_id,
        ]);
    }
    public function getAll()
    {
        return Issue::with(['user.role:id,name','user.profile'])->get();
    }

    public function getById($id)
    {
        return Issue::with(['user.role:id,name','user.profile'])->findOrFail($id);
    }
    public function update($id, array $data)
    {
        $issue = Issue::findOrFail($id);
        $issue->update([
            'title'=> $data['title'] ?? $issue->title ,
            'status'=> $data['status'] ?? $issue->status,
            'category_id'=> $data['category_id']?? $issue->category_id ,
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
            'category_id'=> $data['category_id']?? $issue->category_id ,
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

    public function getIssuesWithChildren($categoryId)
    {
        $category = IssueCategory::with('children')->findOrFail($categoryId);
        $childIds = $this->getAllChildrenIds($category);
        $allIds = array_merge([$category->id], $childIds);

        // هنا استخدمنا with('category') لتحميل التصنيف مع القضايا
        return Issue::with('category','user.role:id,name','user.profile')
        return Issue::with(['user.role:id,name','user.profile','category'])
                    ->whereIn('category_id', $allIds)
                    ->get();
    }


    // دالة مساعدة لاستخراج كل الأبناء بشكل متداخل
    public function getAllChildrenIds($category)
    {
        $ids = [];
        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllChildrenIds($child)); // Recursive
        }
        return $ids;
    }

     public function getCaseTypePercentages()
    {

        $total = Issue::count();
        $catg_ids = IssueCategory::select('id')->groupBy('id')->pluck('id');

        $result = [];

        foreach ($catg_ids as $ctgId) {
            $count = Issue::where('category_id', $ctgId)->count();
            $type = IssueCategory::select('name')->where('id',$ctgId)->get();
            $percentage = $total > 0 ? round(($count / $total) * 100) : 0;

            $result[] = [
                'type' => $type,
                'percentage' => $percentage
            ];
        }

        return $result;
    }

     public function countOpenIssues(): int
    {
        return Issue::where('status', 'open')->count();
    }
}
