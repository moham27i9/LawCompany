<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionAppointmentRequest;
use App\Http\Requests\StoreSessionAppointmentRequest;
use App\Http\Requests\UpdateSessionAppointmentRequest;
use App\Services\SessionAppointmentService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SessionAppointmentController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(SessionAppointmentService $service)
    {
        $this->service = $service;
    }

    public function index($session_id)
    {
        $appointments = $this->service->getBySessionId($session_id);
        return $this->successResponse($appointments, 'Appointments retrieved successfully');
    }

    public function store(StoreSessionAppointmentRequest $request ,$session_id)
    {
        $appointment = $this->service->create($request->validated() , $session_id);
        return $this->successResponse($appointment, 'Appointment created successfully');
    }

    public function show($id)
    {
        $appointment = $this->service->getById($id);
        return $this->successResponse($appointment, 'Appointment retrieved successfully');
    }

    public function update(UpdateSessionAppointmentRequest $request, $id)
    {
        $appointment = $this->service->update($request->validated() , $id);
        return $this->successResponse($appointment, 'Appointment updated successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'Appointment deleted successfully');
    }
}
