<?php

namespace App\Services;

use App\Repositories\HiringRequestRepository;
use Illuminate\Support\Facades\Auth;
use App\Notifications\HirringRequestNotification;
use App\Models\User;

class HiringRequestService
{
    protected $repository;

    public function __construct(HiringRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data)
    {
        $data['created_by'] = auth()->user()->employee->id;
    
        $users = User::all();
       
        foreach($users as $user){

            $user->notify(new HirringRequestNotification($data['jopTitle']));
        }

        return $this->repository->create($data);
    }
}
