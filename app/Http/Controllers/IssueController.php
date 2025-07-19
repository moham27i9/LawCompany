<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignIssueRequest;
use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssuePriorityRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Http\Requests\UpdateIssueStatusRequest;
use App\Services\IssueService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    use ApiResponseTrait;

    protected $issueService;

    public function __construct(IssueService $issueService)
    {
        $this->issueService = $issueService;
    }

    public function store(CreateIssueRequest $request , $user_id)
    {
        $issue = $this->issueService->create($request->validated() , $user_id);
        return $this->successResponse($issue, 'Issue created successfully');
    }

    public function index()
    {
        $issues = $this->issueService->getAll();
        return $this->successResponse($issues, 'All issues retrieved');
    }

    public function show($id)
    {
        $issue = $this->issueService->getById($id);
        return $this->successResponse($issue, 'Issue retrieved');
    }

    public function indexArchived()
    {
        $issues = $this->issueService->getAllArchive();
        return $this->successResponse($issues, 'All Archived issues retrieved');
    }
    
    public function showArchived($id)
    {
        $issue = $this->issueService->getByIdArchive($id);
        return $this->successResponse($issue, 'Issue Archived retrieved');
    }

    public function getAllMyArchive()
    {
        $issues = $this->issueService->getAllMyArchive();
        return $this->successResponse($issues, 'My Archived issues retrieved');
    }

    public function update(UpdateIssueRequest $request, $id)
    {
        $issue = $this->issueService->update($id ,$request->validated());
        return $this->successResponse($issue, 'Issue updated');
    }

    public function updateStatus(UpdateIssueStatusRequest $request, $id)
    {
        $issue = $this->issueService->update($id ,$request->validated());
        return $this->successResponse($issue, 'Issue status updated');
    }

    public function destroy($id)
    {
        $this->issueService->delete($id);
        return $this->successResponse(null, 'Issue deleted');
    }

    public function updatePriority(UpdateIssuePriorityRequest $request, $id)
    {


        $issue = $this->issueService->changePriority($id,$request->validated());
        return $this->successResponse($issue, 'تم تغيير أولوية القضية');
    }

    public function assignIssue(AssignIssueRequest $request, $issueId)
    {
        $this->issueService->assignIssue($issueId, $request->lawyer_ids);

        return $this->successResponse(null, 'تم إسناد القضية للمحامين');
    }

       public function getIssueLawyers($caseId)
    {
        $lawyers = $this->issueService->getLawyers($caseId);
        return $this->successResponse($lawyers, 'Lawyers in the issue');
    }

    public function track($id)
{
    return $this->issueService->track($id);
}

    public function showClientIssue() {
        $issues = $this->issueService->getClientIssues();
            return $this->successResponse($issues, 'Your issues retrieved');
             return $this->errorResponse('something wrong!!', 422);
    }



     public function showClientSession() {
        $sessions = $this->issueService->getClientSessions();
            return $this->successResponse($sessions, 'Your sessions retrieved');
             return $this->errorResponse('something wrong!!', 422);
    }

    public function getByCategory($categoryId)
    {
        $data = $this->issueService->getByCategory($categoryId);
        return $this->successResponse($data, 'تم استرجاع القضايا حسب التصنيف');
    }

  public function caseTypePercentages()
    {
        
        $data = $this->issueService->getCaseTypePercentages();

       return $this->successResponse($data, ' issue types and percentages retrieved ');
    }

       public function countOpenCases()
    {
        $count = $this->issueService->getOpenIssuesCount();
         return $this->successResponse($count, ' open issues count retrieved ');
    }

        public function archive($id)
    {
        $issue = $this->issueService->archive($id);
         return $this->successResponse($issue, 'Issue archived successfully');
    }

    public function unarchive($id)
    {
          $issue = $this->issueService->unarchive($id);
         return $this->successResponse($issue,  'Issue restored successfully');
    }
}
