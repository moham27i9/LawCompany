<?php
namespace App\Http\Controllers;

use App\Services\ConsultationService;
use App\Http\Requests\StoreConsultationRequest;
use App\Models\Consultation;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    use ApiResponseTrait;
    use AuthorizesRequests;

    protected $service;

    public function __construct(ConsultationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successResponse($this->service->getAll(), 'All consultations');
    }

    public function store(StoreConsultationRequest $request,$cons_reqId)
    {
        $consultation =$this->service->create($request->validated(),$cons_reqId);
        if($consultation)
        return $this->successResponse( $consultation , 'Consultation created');
        return $this->errorResponse('Consultation failed!');
    }

    public function show($id)
    {
        return $this->successResponse($this->service->getById($id), 'Consultation details');
    }

    public function update(StoreConsultationRequest $request, $id)
    {       $consultation = $this->service->getById($id);
        $this->authorize('update',$consultation);
        return $this->successResponse($this->service->update($id, $request->validated()), 'Consultation updated');
    }

    public function destroy($id)
    {    $request = $this->service->getById($id);
         $this->authorize('delete',$request);
        return $this->successResponse($this->service->delete($id), 'Consultation deleted');
    }

    

}