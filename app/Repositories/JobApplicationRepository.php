<?php

namespace App\Repositories;

use App\Models\JobApplication;

class JobApplicationRepository
{
    public function create(array $data ,$HirReq_id,$user_id)
    {
        return JobApplication::create([
            'HirReq_id'=>$HirReq_id,
            'user_id'=>$user_id,
            'cv'=>$data['cv'],
        ]);
    }


public function getAllByUserId($userId)
{
    return JobApplication::with(['user:id,name', 'hiringRequest:id,jopTitle'])
        ->where('user_id', $userId)
        ->get();
}

public function getById($id)
{
    return JobApplication::with(['user:id,name', 'hiringRequest:id,jopTitle'])
        ->findOrFail($id);
}

public function updateStatus($id, string $status)
{
    $application = JobApplication::findOrFail($id);
    $application->status = $status;
    $application->save();

    return $application;
}


public function getByHiringRequest($hiringRequestId)
{
    return JobApplication::with('user')
        ->where('HirReq_id', $hiringRequestId)
        ->get()
        ->map(function ($application) {
            return [
                'id' => $application->id,
                'user_name' => $application->user->name ?? 'غير معروف',
                'cv_link' => url($application->cv),
                'status' => $application->status ?? 'pending',
                'submitted_at' => $application->created_at->format('Y-m-d H:i'),
            ];
        });
}



}
