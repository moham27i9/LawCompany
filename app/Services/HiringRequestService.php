<?php

namespace App\Services;

use App\Repositories\HiringRequestRepository;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponseTrait;
use App\Notifications\GeneralNotification;
use App\Models\User;

class HiringRequestService
{
    
    use ApiResponseTrait;
    protected $repository;

    public function __construct(HiringRequestRepository $repository)
    {
        $this->repository = $repository;
    }


    public function list()
    {
        $hiringRequest = $this->repository->getAll();
        return $this->successResponse($hiringRequest, 'success');  
    }

    public function show($id)
    {
        $hiringRequest = $this->repository->find($id);
        return $this->successResponse($hiringRequest, 'success');  
    }

    public function store(array $data)
    {
        $data['created_by'] = auth()->user()->employee->id;
    
        $users = User::all();
       
        $hiringRequest = $this->repository->create($data);
        foreach($users as $user){

            $user->notify(new GeneralNotification($data['jopTitle'], $data['description']  , '/hiring-requests/show/'.$hiringRequest->id));

            // $user->notify(new HirringRequestNotification($data['jopTitle']));
        }

        return $hiringRequest;
    }
}
