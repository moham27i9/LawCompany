<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\Lawyer;
use App\Models\User;
use App\Notifications\GeneralNotification;
use App\Notifications\IssuePriorityChanged;
use App\Repositories\IssueRepository;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IssueService
{
    use ApiResponseTrait;
     use AuthorizesRequests;
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

      public function getLawyers($issueId)
    {
        $issue =  $this->getById($issueId);
          $this->authorize('view', $issue);
        return $this->issueRepository->getLawyersByIssueId($issueId);
    }

    public function track($id)
{
    $issue = $this->issueRepository->track($id);

    // تحقق من ملكية القضية
    if ($issue->user_id !== auth()->user()->id) {
        return $this->errorResponse('Unauthorized', 403);
    }

    return $this->successResponse([
        'title' => $issue->title,
        'issue_number' => $issue->issue_number,
        'total_cost' => $issue->total_cost,
        'installments_per_payment' => $issue->total_cost / $issue->number_of_payments,
        'balance_due' => $issue->total_cost - $issue->amount_paid,
        'last_update' => $issue->updated_at,
        'lawyers' => $issue->lawyers,
        'sessions' => $issue->sessions,
        // 'documents' => $issue->sessions->documents,

    ]);
}

  public function getClientIssues() {
        return $this->issueRepository->getIssuesForClient();
    }

  public function getClientSessions() {
        return $this->issueRepository->getSessionsForClient();
    }

}
