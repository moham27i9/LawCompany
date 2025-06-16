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
        $issue = $this->service->get($id);
        $this->authorize('view', $issue);
        return $this->successResponse($issue, 'Issue request details');
    }

    public function update(UpdateIssueRequestRequest $request, $id)
    {
        $issue = IssueRequest::findOrFail($id);
   
        $this->authorize('update', $issue);
    
        $updated = $this->service->update($id, $request->validated());
    if($updated)
        return $this->successResponse($updated, 'Issue request updated');
        return $this->errorResponse('You are not allowed to update this request. It might be locked or not yours.', 403);
    }
    
    public function updateIssueRequestAdmin(UpdateIssueRequestAdminRequest $request, $id)
    {
        $issue = IssueRequest::findOrFail($id);
        $updated = $this->service->updateOnlyAdmin($id, $request->validated());
        return $this->successResponse($updated, 'Issue request updated');
    }
    

    public function myRequests()
    {
        
        $requests = $this->service->listClientRequests(auth()->user()->id);
        return $this->successResponse($requests, 'My issue requests');
    }

    public function updateMyRequest(UpdateIssueRequestRequest $request, $id)
    {

        $issueRequest = IssueRequest::findOrFail($id);
           $this->authorize('update', $issueRequest);

               $updated = $this->service->updateClientRequest($id,auth()->user()->id, $request->validated());
               return $this->successResponse($updated, 'Issue request updated');
         
         
    }

    public function startReview($id)
    {
         $issueRequest = IssueRequest::findOrFail($id);

        $this->authorize('isAdmin',$issueRequest); // تأكد أن المستخدم أدمن
        $this->service->lockRequest($id);
        return $this->successResponse($issueRequest, 'Request locked for review');
    }

    public function endReview($id)
    {
        $issueRequest = IssueRequest::findOrFail($id);
        $this->authorize('isAdmin',$issueRequest); // تأكد أن المستخدم أدمن
        $this->service->unlockRequest($id);
        return $this->successResponse($issueRequest, 'Request unlocked');
    }

    public function destroy($id)
    {
        $issueRequest = IssueRequest::findOrFail($id);
        
        $this->authorize('delete', $issueRequest);
        $issueRequest = $this->service->delete($id);
        return $this->successResponse(null, 'Issue request deleted');
    }
}
