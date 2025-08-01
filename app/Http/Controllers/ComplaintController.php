<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Http\Requests\UpdateComplaintStatusRequest;
use App\Services\ComplaintService;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
  use ApiResponseTrait;
  use AuthorizesRequests;

    protected $service;
    public function __construct(ComplaintService $service)
    {
        $this->service = $service;
    }
     public function index()
    {
        
        return $this->successResponse($this->service->getAll(), 'All complaints');
    }
     public function show($id)
    {
             $complaint = $this->service->getById($id);
        $this->authorize('view',$complaint);
        return $this->successResponse($complaint, 'complaint details');
    }


     public function myComplaints()
    {
        return $this->successResponse($this->service->myComplaints(), 'your complaints');
    }

      public function store(CreateComplaintRequest $request)
    {
        $complaint =$this->service->create($request->validated());
        if($complaint)
        return $this->successResponse( $complaint , 'complaint created');
        return $this->errorResponse('complaint failed!');
    }
    
     public function update(UpdateComplaintRequest $request, $id)
    {    
           $complaint = $this->service->getById($id);
        $this->authorize('update',$complaint);
        return $this->successResponse($this->service->update($id, $request->validated()), 'complaint updated');
    }

     public function updateStatus(UpdateComplaintStatusRequest $request, $id)
    {    
        return $this->successResponse($this->service->updateStatus($id, $request->validated()), 'complaint status updated');
    }

    public function destroy($id)
    {
             $complaint = $this->service->getById($id);
        $this->authorize('delete',$complaint);
        return $this->successResponse($this->service->delete($id), 'complaint deleted success');
    }


}
