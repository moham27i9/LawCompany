<?php
namespace App\Repositories;

use App\Models\DelegationRequest;
use App\Models\Sessionss;

class DelegationRequestRepository
{
    public function create(array $data)
    {
        return DelegationRequest::create($data);
    }
        public function update($id, array $data)
    {
        $item = DelegationRequest::findOrFail($id);
        $item->update($data); 
        return $item;
    }

    public function delete($id)
    {
        return DelegationRequest::destroy($id);
    }

    public function find($id)
    {
        return DelegationRequest::with(['originalLawyer.user', 'delegateLawyer.user', 'session.issue'])
            ->findOrFail($id);
    }

    public function getAll()
    {
        return DelegationRequest::with(['originalLawyer.user', 'delegateLawyer.user', 'session.issue'])
            ->latest()
            ->get();
    }
    public function updateStatus($id, array $data)
    {
        $request = DelegationRequest::findOrFail($id);
        $request->update($data);
        return $request->refresh();
    }

    public function getByLawyer($lawyerId)
    {
        return DelegationRequest::where('original_lawyer_id', $lawyerId)->get();
    }
}
