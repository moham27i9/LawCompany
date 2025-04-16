<?php

namespace App\Repositories;

use App\Models\JobApplication;

class JobApplicationRepository
{
    public function create(array $data)
    {
        return JobApplication::create($data);
    }
}
