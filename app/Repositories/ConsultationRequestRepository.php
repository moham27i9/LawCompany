<?php
namespace App\Repositories;

use App\Models\ConsultationRequest;

class ConsultationRequestRepository
{
    public function getAll()
    {
        return ConsultationRequest::with('user')->get();
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->user()->id;
        return ConsultationRequest::create($data);
    }

    public function getById($id)
    {
        return ConsultationRequest::with('user')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $item = ConsultationRequest::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        return ConsultationRequest::destroy($id);
    }
}