<?php

namespace App\Repositories;

use App\Models\Consultation;

class ConsultationRepository
{
    public function getAll()
    {
        return Consultation::with('lawyer')->get();
    }

    public function create(array $data)
    {
        return Consultation::create($data);
    }

    public function getById($id)
    {
        return Consultation::with('lawyer')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->update($data);
        return $consultation;
    }

    public function delete($id)
    {
        return Consultation::destroy($id);
    }
}