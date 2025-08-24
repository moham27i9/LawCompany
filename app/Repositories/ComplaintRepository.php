<?php

namespace App\Repositories;

use App\Models\Complaint;
use Cache;

class ComplaintRepository{

    public function getAll()
    {
            return Cache::remember('complaints_all', now()->addMinutes(15), function () {
                return Complaint::with('user')->get();
    });
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->user()->id;
        $complaint = Complaint::create($data);
        Cache::forget('complaints_all');
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
        Cache::forget('complaints_all');
        return $complaint;
    }

    public function updateStatus($id,array $data)
    {
        $complaint = $this->getById($id);
        $complaint->update([
            'status' => $data['status']
        ]);
        $complaint->save();
        Cache::forget('complaints_all');
        return $complaint;
    }

    public function delete($id)
    {
        Cache::forget('complaints_all');
        return Complaint::destroy($id);
    }


}
