<?php

namespace App\Repositories;


use App\Models\HiringRequest;

class HiringRequestRepository
{
    public function getAll()
    {
        return HiringRequest::all();
    }

    public function find($id)
    {
        return HiringRequest::findOrFail($id);
    }
    public function create(array $data)
    {

        return HiringRequest::create($data);
    }

    public function delete($id)
    {
        $hiringRequest = HiringRequest::findOrFail($id);
        return $hiringRequest->delete();
    }

    public function updateStatus($id, string $status)
{
    $hiring = HiringRequest::findOrFail($id);
    $hiring->status = $status;
    $hiring->save();

    return $hiring;
}

}
