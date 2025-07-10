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
    try {
        $request = ConsultationRequest::where('id', $cons_reqId)
            ->where('is_locked', false)
            ->where('status', 'approved')
            ->firstOrFail();

        // قفل الاستشارة وتعيين المحامي
        $request->update([
            'is_locked' => true,
        ]);

        $data['lawyer_id'] = auth()->user()->lawyer->id;
        $data['consultation_req_id'] = $cons_reqId;

        // إنشاء الاستشارة
        $consultation = Consultation::create($data);

        // تغيير الحالة إلى مغلقة
        $request->update([
            'status' => 'closed'
        ]);

        return $consultation;
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return null;
    }
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