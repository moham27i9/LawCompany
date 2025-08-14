<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyInfoRequest;
use App\Services\CompanyInfoService;
use App\Traits\ApiResponseTrait;

class CompanyInfoController extends Controller
{
    protected $service;
    use ApiResponseTrait;

    public function __construct(CompanyInfoService $service)
    {
        $this->service = $service;
    }

    public function update(UpdateCompanyInfoRequest $request)
    {
        $info = $this->service->updateInfo($request->validated());
        return response()->json([
            'message' => 'Company info updated successfully',
            'data' => $info
        ]);
    }

    public function show()
    {
        $data = $this->service->getCompanyWithTeam();
        return $this->successResponse($data, 'Company info with team retrieved successfully');
    }
}
