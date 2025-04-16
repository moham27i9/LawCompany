<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHiringRequest;
use App\Services\HiringRequestService;
use App\Traits\ApiResponseTrait;

class HiringRequestController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(HiringRequestService $service)
    {
        $this->service = $service;
    }

    public function store(StoreHiringRequest $request)
    {
        $hiring = $this->service->store($request->validated());
        return $this->successResponse($hiring, 'تم إنشاء إعلان التوظيف بنجاح');
    }
}

