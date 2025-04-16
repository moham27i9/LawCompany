<?php

namespace App\Services;

use App\Repositories\JobApplicationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobApplicationService
{
    protected $repo;

    public function __construct(JobApplicationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store(array $data,$HirReq_id)
    {
        return $this->repo->create([
            'user_id' => auth()->user()->id,
            'HirReq_id' => $HirReq_id,
            'cv' => $data['cv'],
          
        ]);
    }
}
