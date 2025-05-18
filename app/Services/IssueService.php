<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\Lawyer;
use App\Models\User;
use App\Notifications\GeneralNotification;
use App\Notifications\IssuePriorityChanged;
use App\Repositories\IssueRepository;

class IssueService
{
    protected $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function create(array $data , $user_id)
    {
        
        return $this->issueRepository->create($data , $user_id);
    }

    public function getAll()
    {
        return $this->issueRepository->getAll();
    }

    public function getById($id)
    {
        return $this->issueRepository->getById($id);
    }
    public function update($id, array $data)
    {
        
        return $this->issueRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->issueRepository->delete($id);
    }

        
    public function changePriority($issueId, $priority)
    {    
        $issue = $this->issueRepository->updatePriority($issueId, $priority['priority']);
        $issue->user->notify(new GeneralNotification('إنشاء قضية','تم إنشاء القضية الخاصة بك','/issues/' . $issue->id));
        $lawyers = $issue->lawyers;
        foreach ($lawyers as $lawyer) {
            $lawyer->user->notify(new GeneralNotification('تحديث أولوية قضية',$priority['priority'].'يرجى الانتباه إلى أنه تم تحديث أولوية القضية إلى','/issues/' . $issue->id));
        }

        return $issue;
    }


    public function assignIssue($issueId, array $lawyerIds)
    {
        $issue = Issue::findOrFail($issueId);

        foreach ($lawyerIds as $lawyerId) {
            $lawyer = Lawyer::findOrFail($lawyerId);
         
            // إرسال إشعار
            $lawyer->user->notify(new GeneralNotification(
                'إسناد قضية',
                ' إليك'. $issue->issue_number . ' تم إسناد القضية رقم ' ,
                '/issues/' . $issue->id
            ));
        }

        return $this->issueRepository->syncIssue($issueId, $lawyerIds);
    }

      public function getLawyers($caseId)
    {
        return $this->issueRepository->getLawyersByIssueId($caseId);
    }
}
