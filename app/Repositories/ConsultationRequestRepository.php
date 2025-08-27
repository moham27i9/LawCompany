<?php
namespace App\Repositories;

use App\Models\ConsultationRequest;

class ConsultationRequestRepository
{
    public function getAll()
    {
        return ConsultationRequest::with(['user.role:id,name','user.profile'])->get();
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->user()->id;
        return ConsultationRequest::create($data);
    }

    public function getById($id)
    {
        return ConsultationRequest::with(['user.role:id,name','user.profile'])->findOrFail($id);
    }

    public function showMyRequests()
    {
        return ConsultationRequest::with(['user.role:id,name','user.profile'])
                                         ->where('user_id',auth()->user()->id)
                                         ->get();
    }

  public function update($id, array $data)
{
    $item = ConsultationRequest::findOrFail($id);

    if ($item->status !== 'pending') {
        throw new \Exception('لا يمكن تعديل الاستشارة بعد الموافقة عليها أو رفضها.');
    }

    $item->update($data);
    return $item->refresh();
}


    public function getByLawyer($lawyerId)
    {
        return ConsultationRequest::where('locked_by', $lawyerId)
            ->where('status', 'closed') // أو حسب الحالة التي تدل على الرد
            ->get();
    }

    public function delete($id)
    {
        $deleted = ConsultationRequest::findOrFail($id);

    if ($deleted->status !== 'pending' || $deleted->status !== 'rejected') {
        throw new \Exception('لا يمكن حذف الاستشارة بعد الموافقة عليها  .');
    }

         $deleted->destroy();
    }

    public function findWithLockedLawyer($id)
    {
        return ConsultationRequest::with([                       // صاحب الاستشارة
            'lockedByLawyer.user.profile'   // المحامي القافل + اليوزر تبعه + البروفايل
        ])->findOrFail($id);
    }

}
