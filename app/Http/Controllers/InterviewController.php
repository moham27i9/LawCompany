<?php

// app/Http/Controllers/InterviewController.php
namespace App\Http\Controllers;

use App\Http\Requests\CreateInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Http\Requests\UpdateInterviewResultRequest;
use App\Services\InterviewService;
use App\Traits\ApiResponseTrait;

class InterviewController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(InterviewService $service)
    {
        $this->service = $service;
    }

    public function store(CreateInterviewRequest $request, $jobAppId)
    {
        $interview = $this->service->create($request->validated(), $jobAppId);
        return $this->successResponse($interview, 'Interview created');
    }

    public function update(UpdateInterviewRequest $request, $id)
    {
        $interview = $this->service->update($request->validated(), $id);
        return $this->successResponse($interview, 'Interview updated');
    }

    public function show($id)
    {
        $interview = $this->service->get($id);
        return $this->successResponse($interview, 'Interview retrieved');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'Interview deleted');
    }

    public function index($jobAppId)
    {
        $interviews = $this->service->getByJobApp($jobAppId);
        return $this->successResponse($interviews, 'Interviews retrieved');
    }

    public function updateResult(UpdateInterviewResultRequest $request, $id)
{
    $interview = $this->service->updateResult($request->validated(), $id);
    return $this->successResponse([
        'result' => $interview->result,
        'date' => $interview->date,
    ], 'تم تحديث النتيجة بنجاح');
}


}

