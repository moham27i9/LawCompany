<?php
namespace App\Repositories;

use App\Models\SessionAppointment;

class SessionAppointmentRepository
{
    public function create(array $data , $session_id)
    {
        $data['session_id']=$session_id;
        return SessionAppointment::create($data);
    }

public function getAllBySessionId($sessionId)
{
    return SessionAppointment::where('session_id', $sessionId)->get();
}


    public function getById($id)
    {
        return SessionAppointment::findOrFail($id);
    }

    public function update(array $data ,$id)
    {
        $appointment = SessionAppointment::findOrFail($id);
        $appointment->update([
        'type' => $data['type']    ?? $appointment->type,
        'date'  => $data['date']  ?? $appointment->date,
    ]);
        return $appointment;
    }


    public function delete($id)
    {
        $appointment = SessionAppointment::findOrFail($id);
        return $appointment->delete();
    }
}
