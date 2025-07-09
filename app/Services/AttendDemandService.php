<?php
namespace App\Services;

use App\Models\AttendDemand;
use App\Models\Issue;
use App\Models\User;
use App\Notifications\GeneralNotification;
use App\Repositories\AttendDemandRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttendDemandService
{
     use AuthorizesRequests;
    protected $repo;

    public function __construct(AttendDemandRepository $repo)
    {
        $this->repo = $repo;
    }
    public function create(array $data, $issueId)
    {
        $issue = Issue::findOrFail($issueId);
        $this->authorize('create', [AttendDemand::class, $issue]);
        $lawyerId = auth()->user()->lawyer->id;
         $data['issue_id']=$issueId;
         $data['lawyer_id']=$lawyerId;
         $user = User::findOrFail($issue->user_id);
        $attendDemand =$this->repo->create($data);
        $user->notify(new GeneralNotification('طلب حضور', $data['date'].': بتاريخ '  , '/AttendDemand/'.$attendDemand->id));
        return $attendDemand ;
    }

    public function update(array $data, $id)
    {
        return $this->repo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function getMyDemand()
    {
        return $this->repo->getMydemand();
    }

    public function getByIssue($issueId)
    {
        return $this->repo->getByIssue($issueId);
    }

      public function updateResault(AttendDemand $attendDemand, string $resault)
    {
        $resault = $this->repo->updateResault($attendDemand, $resault);
        $lawyer =User::findOrFail($attendDemand->lawyer->user_id);;
        $lawyer->notify(new GeneralNotification('إجابة طلب حضور',$attendDemand->resault.': الإجابة '  , '/AttendDemand/'.$attendDemand->id));
        return  $resault;
    }
}

