<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationStatusRequest;
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

public function showMyApplications()
{
    $applications = $this->service->getMyApplications();

    $data = $applications->map(function ($app) {
        return [
            'id' => $app->id,
            'job_title' => $app->hiringRequest->jopTitle,
            'cv_link' => asset($app->cv),
            'created_at' => $app->created_at->format('Y-m-d H:i'),
        ];
    });

    return $this->successResponse($data, 'طلباتك');
}

public function show($id)
{
    $application = $this->service->getById($id);

    $data = [
        'id' => $application->id,
        'user_name' => $application->user->name,
        'job_title' => $application->hiringRequest->jopTitle,
        'cv_link' =>  asset('storage/' . $application->cv),
        'created_at' => $application->created_at->format('Y-m-d H:i'),
    ];

    return $this->successResponse($data, 'تم استرجاع الطلب');
}

public function updateStatus(UpdateJobApplicationStatusRequest $request, $id)
{
    $updatedApplication = $this->service->updateStatus($id, $request->status);

    return $this->successResponse($updatedApplication, 'Job application status updated successfully');
}

}

