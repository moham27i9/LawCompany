<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePermissionRequest;
use App\Traits\ApiResponseTrait;


class PermissionController extends Controller
{
    use ApiResponseTrait;
    protected $service;

    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store(CreatePermissionRequest $request,$id)
    {
        $this->service->create($request->validated(),$id);
        return $this->successResponse(null, 'Permission added successfully ');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'Permission deleted successfully ');
    }
}

