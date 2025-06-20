<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHiringRequest;
use App\Http\Requests\UpdateHiringRequestStatusRequest;
use App\Http\Requests\UpdateHiringStatusRequest;
use App\Services\HiringRequestService;
use App\Traits\ApiResponseTrait;
use Request;

class HiringRequestController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(HiringRequestService $service)
    {
        $this->service = $service;
    }


    public function index()
    {
        return $this->service->list();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function store(StoreHiringRequest $request)
    {
        $hiring = $this->service->store($request->validated());
        return $this->successResponse($hiring, 'تم إنشاء إعلان التوظيف بنجاح');
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

    public function updateStatus(UpdateHiringStatusRequest $request, $id)
    {
        $hiring = $this->service->updateStatus($id, $request->status);
        return $this->successResponse($hiring, 'Hiring status updated successfully');
    }



}

