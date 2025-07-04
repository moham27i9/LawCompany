<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\IssueCategory;
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
    protected $issueCategoryRepository;

    public function __construct(IssueRepository $issueRepository , IssueCategory $issueCategoryRepository)
    {
        $this->issueRepository = $issueRepository;
        $this->issueCategoryRepository = $issueCategoryRepository;
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

    // تأكد أن المستخدم صاحب القضية
    if ($issue->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }


    // استخراج موعد الجلسة القادمة من أول موعد بعد الآن
    $nextAppointment = $issue->sessions
        ->flatMap->appointments
        ->filter(fn($a) => $a->date > now())
        ->sortBy('date')
        ->first();

    // استخراج نتائج وملاحظات الجلسات
    $sessionSummaries = $issue->sessions->map(fn($s) => [
        'session_date' => optional($s->appointments->first())->date,
        'outcome' => $s->outcome,
        'notes' => $s->notes ?? null,
    ]);
    return [
        'title' => $issue->title,
        'issue_number' => $issue->issue_number,
        'total_cost' => $issue->total_cost,
        'installments_per_payment' => $issue->total_cost / max(1, $issue->number_of_payments),
        'balance_due' => $issue->total_cost - $issue->amount_paid,
        'last_update' => $issue->updated_at,
        'lawyers' => $issue->lawyers->pluck('user.name'),
        'next_session' => $nextAppointment,
        'documents' => $issue->sessions->flatMap->documents,
        'previous_sessions' => $sessionSummaries,
    ];
}


  public function getClientIssues() {
        return $this->issueRepository->getIssuesForClient();
    }

  public function getClientSessions() {
        return $this->issueRepository->getSessionsForClient();
    }

    public function getByCategory($categoryId)
    {
        $category = IssueCategory::findOrFail($categoryId);
        $issues = $this->issueRepository->getIssuesWithChildren($categoryId);
        $formattedIssues = $issues->map(function ($issue) {
            return [
                'id' => $issue->id,
                'title' => $issue->title,
                'issue_number' => $issue->issue_number,
                'status' => $issue->status,
                'priority' => $issue->priority,
                'amount_paid' => $issue->amount_paid,
                'total_cost' => $issue->total_cost,
                'court_name' => $issue->court_name,
                'opponent_name' => $issue->opponent_name,
                'start_date' => $issue->start_date,
                'end_date' => $issue->end_date,
            ];
        });

        return [
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'parent_id' => $category->parent_id,
            ],
            'issues' => $formattedIssues
        ];
    }



}
