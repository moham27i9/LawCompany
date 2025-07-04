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

    public function create(array $data,$cons_reqId)
    {

        try{
            
            $request_approved_unlock = ConsultationRequest::where('is_locked', true)->where('status', 'approved')->findOrFail($cons_reqId);
                 if($request_approved_unlock){
                    $data['lawyer_id'] = auth()->user()->lawyer->id;
                    $data['consultation_req_id'] = $cons_reqId;
                     return Consultation::create($data);
                 }
                return null;
        }
         catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return null;}
    }

    public function getById($id)
    {
        return Consultation::with('lawyer')->findOrFail($id);
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