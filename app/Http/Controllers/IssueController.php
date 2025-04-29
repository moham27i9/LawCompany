<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Services\IssueService;
use App\Traits\ApiResponseTrait;

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

    public function update(UpdateIssueRequest $request, $id)
    {
        $issue = $this->issueService->update($id, $request->validated());
        return $this->successResponse($issue, 'Issue updated');
    }

    public function destroy($id)
    {
        $this->issueService->delete($id);
        return $this->successResponse(null, 'Issue deleted');
    }

}
