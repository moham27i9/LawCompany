<?php

// app/Repositories/CommonConsultation/CommonConsultationRepository.php

namespace App\Repositories;

use App\Models\CommonConsultation;

class CommonConsultationRepository
{
    public function all()
    {
        return CommonConsultation::all();
    }

    public function find($id)
    {
        return CommonConsultation::findOrFail($id);
    }

    public function create(array $data)
    {
        return CommonConsultation::create($data);
    }

    public function update($id, array $data)
    {
        $consultation = CommonConsultation::findOrFail($id);
        $consultation->update($data);
         $consultation->save();
        return $consultation;
    }

    public function delete($id)
    {
        return CommonConsultation::destroy($id);
    }
}
