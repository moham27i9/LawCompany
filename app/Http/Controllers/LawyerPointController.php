<?php

namespace App\Http\Controllers;
use App\Http\Requests\AdminEvaluationRequest;
use App\Services\LawyerPointService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class LawyerPointController extends Controller
{
use ApiResponseTrait;
    protected $Service;

    public function __construct(LawyerPointService $Service)
    {
        $this->Service = $Service;
    }

    public function addAdminEvaluation(AdminEvaluationRequest $request, int $session_id, int $lawyer_id)
    {
        $evaluation = $this->Service->addAdminEvaluation($session_id, $lawyer_id, $request->validated());
        return $this->successResponse($evaluation, 'تم تسجيل التقييم الإداري بنجاح');

    }

     public function getPointsSummary($lawyerId)
    {
        $summary = $this->Service->getPointsSummary($lawyerId);

        return $this->successResponse($summary, 'تم استرجاع النقاط بنجاح');
    }


}
