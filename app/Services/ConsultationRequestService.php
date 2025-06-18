<?php
namespace App\Services;

use App\Repositories\ConsultationRequestRepository;

class ConsultationRequestService
{
    protected $repository;

    public function __construct(ConsultationRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
        public function lockConsultation($id)
    {
        $consultation = $this->repository->getById($id);
         if (!$consultation) {
        throw new \Exception("Consultation not found");
          }
        $consultation->update(['is_locked' => true]);
        $consultation->save();
      
        return $consultation;
    }

    public function unlockConsultation($id)
    {
        $consultation = $this->repository->getById($id);
         if (!$consultation) {
        throw new \Exception("Consultation not found");
    }
        $consultation->update(['is_locked' => false]);
          $consultation->save();
        return $consultation;
    }
}