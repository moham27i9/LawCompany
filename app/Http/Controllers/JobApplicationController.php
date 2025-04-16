<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Services\JobApplicationService;
use App\Traits\ApiResponseTrait;

class JobApplicationController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(JobApplicationService $service)
    {
        $this->service = $service;
    }

    public function store(StoreJobApplicationRequest $request,$HirReq_id)
    {
        $application = $this->service->store($request->validated(),$HirReq_id);
        return $this->successResponse($application, 'تم تقديم الطلب بنجاح');
    }
}

