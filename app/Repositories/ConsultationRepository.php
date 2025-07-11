<?php

namespace App\Repositories;

use App\Models\Consultation;
use App\Models\ConsultationRequest;

class ConsultationRepository
{
    public function getAll()
    {
        return Consultation::with('lawyer')->get();
    }

public function create(array $data, $cons_reqId)
{
    $request = ConsultationRequest::findOrFail($cons_reqId);

    if ($request->status !== 'approved' || !$request->is_locked || $request->locked_by !== auth()->user()->lawyer->id) {
        throw new \Exception("Consultation not available for reply.");
    }

    $data['lawyer_id'] = auth()->user()->lawyer->id;
    $data['consultation_req_id'] = $cons_reqId;

    $consultation = Consultation::create($data);

    // تحديث حالة الطلب إلى مغلق
    $request->update([
        'status' => 'closed',
        'is_locked' => false,
        'locked_by' => null,
    ]);

    return $consultation;
}



    public function getById($id)
    {
        return Consultation::with('lawyer')->findOrFail($id);
    }

    public function getCousultByRequestId($consultReqId)
    {
        return Consultation::where('consultation_req_id',$consultReqId)->get();
    }

    public function update($id, array $data)
    {
        try{

            $consultation = Consultation::findOrFail($id);
            $consultation->update($data);
            $consultation->save();
            return $consultation;
        }
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return null;}
    }

    public function delete($id)
    {
        return Consultation::destroy($id);
    }
}