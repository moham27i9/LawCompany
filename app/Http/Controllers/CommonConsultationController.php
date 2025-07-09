<?php

namespace App\Http\Controllers;

use App\Http\Requests\SCommonConsultationRequest;
use App\Http\Requests\UCommonConsultationRequest;
use App\Services\CommonConsultationService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CommonConsultationController extends Controller
{
     use ApiResponseTrait;
    protected $service;

    public function __construct(CommonConsultationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successResponse($this->service->getAll(), 'Consultations retrieved');
    }

    public function store(SCommonConsultationRequest $request)
    {
     return $this->successResponse($this->service->create($request->validated()), 'Consultations created');
    }

    public function show($id)
    {
         return $this->successResponse( $this->service->getById($id), 'Consultation retrieved');
    }

    public function update(UCommonConsultationRequest $request, $id)
    {
      return $this->successResponse($this->service->update($id, $request->validated()), 'Consultations retrieved');
    }

    public function destroy($id)
    {
       return $this->successResponse($this->service->delete($id), 'Consultation deleted');
    }
}
