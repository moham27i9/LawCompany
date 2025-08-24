<?php

namespace App\Repositories;

use App\Models\Consultation;
use App\Models\ConsultationRequest;
use Cache;

class ConsultationRepository
{
    public function getAll()
    {
            return Cache::remember('consultation_all', now()->addMinutes(15), function () {
                return Consultation::with('lawyer')->get();
    });
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
    Cache::forget('consultation_all');

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
            Cache::forget('consultation_all');
            return $consultation;
        }
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return null;
            }
    }


    public function delete($id)
    {
        Cache::forget('consultation_all');
        return Consultation::destroy($id);
    }
}
