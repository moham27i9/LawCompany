<?php

namespace App\Repositories;


use App\Models\HiringRequest;

class HiringRequestRepository
{
    public function create(array $data)
    {
       
        return HiringRequest::create($data);
    }
}
