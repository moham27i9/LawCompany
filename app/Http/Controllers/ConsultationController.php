<?php
namespace App\Http\Controllers;

use App\Services\ConsultationService;
use App\Http\Requests\StoreConsultationRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(ConsultationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successResponse($this->service->getAll(), 'All consultations');
    }

    public function store(StoreConsultationRequest $request)
    {
        return $this->successResponse($this->service->create($request->validated()), 'Consultation created');
    }

    public function show($id)
    {
        return $this->successResponse($this->service->getById($id), 'Consultation details');
    }

    public function update(StoreConsultationRequest $request, $id)
    {
        return $this->successResponse($this->service->update($id, $request->validated()), 'Consultation updated');
    }

    public function destroy($id)
    {
        return $this->successResponse($this->service->delete($id), 'Consultation deleted');
    }
}