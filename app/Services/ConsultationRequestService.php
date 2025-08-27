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
    public function showMyRequests()
    {
        return $this->repository->showMyRequests();
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
    // إذا كانت مغلقة تمامًا (تمت الإجابة)
    if ($consultation->status === 'closed') {
        throw new \Exception("Cannot lock a closed consultation.");
    }

    // إذا كانت مقفلة من محامي آخر
    if ($consultation->is_locked && $consultation->locked_by !== auth()->user()->lawyer->id) {
        throw new \Exception("This consultation is locked by another lawyer.");
    }

    // قفل وتعيين المحامي الحالي
         $consultation->is_locked = true;
        $consultation->locked_by = auth()->user()->lawyer->id;
        $consultation->save();
         return $consultation;
    }

public function unlockConsultation($id)
{
    $consultation = $this->repository->getById($id);

    if (
        auth()->user()->role->name !== 'admin' &&
        $consultation->locked_by !== optional(auth()->user()->lawyer)->id
    ) {
        throw new \Exception("You cannot unlock a consultation you didn't lock.");
    }

    $consultation->is_locked = false;
    $consultation->locked_by = null;
    $consultation->save();

    return $consultation->refresh();
}


    public function getByLawyer($lawyerId)
    {
        return $this->repository->getByLawyer($lawyerId);
    }


    public function getConsultationRequestWithLawyer($id)
    {
        $consultationRequest = $this->repository->findWithLockedLawyer($id);

        $lawyer = $consultationRequest->lockedByLawyer;

        // دمج بيانات المحامي مع بيانات اليوزر والبروفايل
        $lawyerData = null;
        if ($lawyer) {
            $lawyerData = [
                'id' => $lawyer->id,
                'name' => $lawyer->user->name ?? null,
                'email' => $lawyer->user->email ?? null,
                'address' => $lawyer->user->profile->address ?? null,
                'phone' => $lawyer->user->profile->phone ?? null,
                'age' => $lawyer->user->profile->age ?? null,
                'image' => $lawyer->user->profile->image ? asset($lawyer->user->profile->image) : null,
                'license_number' => $lawyer->license_number,
                'experience_years' => $lawyer->experience_years,
                'type' => $lawyer->type,
                'specialization' => $lawyer->specialization,
                'certificate' => $lawyer->certificate ? asset($lawyer->certificate) : null,
            ];
        }

        return [
            'id' => $consultationRequest->id,
            'subject' => $consultationRequest->subject,
            'details' => $consultationRequest->details,
            'status' => $consultationRequest->status,
            'is_locked' => $consultationRequest->is_locked,
            'locked_by_lawyer' => $lawyerData,
        ];
    }

}
