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

public function store(array $data, $HirReq_id)
{
    $user = auth()->user();


    $hasApplied = \App\Models\JobApplication::where('user_id', $user->id)
        ->where('HirReq_id', $HirReq_id)
        ->exists();

    if ($hasApplied) {
        throw new \Exception('لقد قمت بالتقديم على هذه الوظيفة مسبقاً.');
    }


    if (isset($data['cv']) && $data['cv'] instanceof \Illuminate\Http\UploadedFile) {
        $filename = 'cv_' . $user->id . '_' . $HirReq_id . '.' . $data['cv']->getClientOriginalExtension();
        $certificatePath = $data['cv']->storeAs('cv_s', $filename, 'public');
        $data['cv'] = 'storage/' . $certificatePath;
    }

    return $this->repo->create($data, $HirReq_id, $user->id);
}

    public function getMyApplications()
    {
        return $this->repo->getAllByUserId(auth()->user()->id);
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function updateStatus(int $id, string $status)
    {
        return $this->repo->updateStatus($id, $status);
    }



}
