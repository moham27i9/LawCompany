<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreIssueRequestRequest;
use App\Http\Requests\UpdateIssueRequestAdminRequest;
use App\Http\Requests\UpdateIssueRequestRequest;
use App\Models\IssueRequest;
use App\Models\User;
use App\Services\IssueRequestService;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IssueRequestController extends Controller
{
    use ApiResponseTrait;
    use AuthorizesRequests;

    protected $service;

    public function __construct(IssueRequestService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successResponse($this->service->list(), 'All issue requests');
    }

    public function store(StoreIssueRequestRequest $request)
    {
        $issue = $this->service->create($request->validated());
        return $this->successResponse($issue, 'issue request created');
    }

    public function show($id)
    {
        return $this->successResponse($this->service->get($id), 'Issue request details');
    }

    public function update(UpdateIssueRequestRequest $request, $id)
    {
        $issue = IssueRequest::findOrFail($id);
    
        // تفويض الصلاحية
        $this->authorize('update', $issue);
    
        $updated = $this->service->update($id, $request->validated());
    
        return $this->successResponse($updated, 'Issue request updated');
    }
    
    public function updateIssueRequestAdmin(UpdateIssueRequestAdminRequest $request, $id)
    {
        $issue = IssueRequest::findOrFail($id);
        $updated = $this->service->updateOnlyAdmin($id, $request->validated());
        return $this->successResponse($updated, 'Issue request updated');
    }
    

    public function destroy($id)
    {
        $issueRequest = IssueRequest::findOrFail($id);
        $this->authorize('delete', $issueRequest);
        $issueRequest = $this->service->delete($id);
        return $this->successResponse(null, 'Issue request deleted');
    }
}
