<?php

namespace App\Repositories;

use App\Models\Complaint;

class ComplaintRepository{

    public function getAll()
    {
        return Complaint::with('user')->get();
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->user()->id;
        $complaint = Complaint::create($data);
        return $complaint;

    }

    public function getById($id)
    {
        return Complaint::with('user')->findOrFail($id);
    }

    public function myComplaints()
    {
        return Complaint::where('user_id',auth()->user()->id)->with('user')->get();
    }

    public function update($id,array $data)
    {
        $complaint = $this->getById($id);
        $complaint->update($data);
        $complaint->save();
        return $complaint;
    }
    
    public function updateStatus($id,array $data)
    {
        $complaint = $this->getById($id);
        $complaint->update([
            'status' => $data['status']
        ]);
        $complaint->save();
        return $complaint;
    }

    public function delete($id)
    {
        return Complaint::destroy($id);
    }


}