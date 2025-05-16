<?php
namespace App\Services;

use App\Models\SessionAppointment;
use App\Repositories\SessionAppointmentRepository;
use Carbon\Carbon;
use Session;

class SessionAppointmentService
{
    protected $repo;

    public function __construct(SessionAppointmentRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $data , $session_id)
    {
        return $this->repo->create($data , $session_id);
    }

    public function getBySessionId($sessionId)
    {
        return $this->repo->getAllBySessionId($sessionId);
    }


    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function update(array $data , $id)
    {
        return $this->repo->update( $data ,$id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
