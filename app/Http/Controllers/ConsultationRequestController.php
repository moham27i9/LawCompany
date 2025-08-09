<?php

namespace App\Http\Controllers;

use App\Services\ConsultationRequestService;
use App\Services\ConsultationService;
use App\Http\Requests\StoreConsultationRequestRequest;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequestRequest;
use App\Models\ConsultationRequest;
use App\Models\User;
use App\Notifications\GeneralNotification;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ConsultationRequestController extends Controller
{
    use ApiResponseTrait;
       use AuthorizesRequests;
    protected $service;

    public function __construct(ConsultationRequestService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successResponse($this->service->getAll(), 'All consultation requests');
    }

    public function store(StoreConsultationRequestRequest $request)
    {
        return $this->successResponse(
            $this->service->create($request->validated()),
            'Consultation request created'
        );
    }

    public function show($id)
    {
        return $this->successResponse($this->service->getById($id), 'Consultation request details');
    }

    public function showMyRequests()
    {
        return $this->successResponse($this->service->showMyRequests(), 'Consultations request details');
    }

    public function update(UpdateConsultationRequestRequest $request, $id)
    {
       $updated = $this->service->update($id, $request->validated());
         $this->authorize('update', $updated);
        return $this->successResponse(
            $updated,
            'Consultation request updated'
        );
    }

    public function updateStatus(UpdateConsultationRequestRequest $request, $id)
    {     $consl_request =$this->service->getById($id);
        $this->authorize('updateStatus', $consl_request);
        $updated = $this->service->update($id, $request->validated());
        if($request['status'] === 'approved'){
            $users = User::all();
             foreach($users as $user){
                if($user->lawyer)
                $user->notify(new GeneralNotification($updated->subject, $updated->details  , '/consultation_requests/'.$updated->id));
        }
        }
        return $this->successResponse(
            $updated,
            'Consultation request status updated'
        );
    }

    public function destroy($id)
    {
            $consl_request =$this->service->getById($id);
            $this->authorize('delete', $consl_request);
        return $this->successResponse(
            $this->service->delete($id),
            'Consultation request deleted'
        );
    }
        public function startReview($id)
    {
         $consultation = ConsultationRequest::findOrFail($id);
        $this->authorize('isAdmin',$consultation); // تأكد أن المستخدم أدمن
        $this->service->lockConsultation($id);
        return $this->successResponse($consultation, 'consultation locked for review');
    }

    public function endReview($id)
    {
        $consultation = ConsultationRequest::findOrFail($id);
        $this->authorize('isAdmin',$consultation); // تأكد أن المستخدم أدمن
        $this->service->unlockConsultation($id);
        return $this->successResponse($consultation, 'consultation unlocked');
    }

      public function byLawyer($lawyerId)
    {
        $requests = $this->service->getByLawyer($lawyerId);

        return $this->successResponse(
            $requests,
            'Consultation requests retrieved for the lawyer successfully.'
        );
    }
}
