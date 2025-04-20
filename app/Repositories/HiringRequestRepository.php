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
}
