<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Services\RolePermissionService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    protected $service;
    use ApiResponseTrait;
    public function __construct(RolePermissionService $service)
    {
        $this->service = $service;
    }

    public function assign(Request $request, $roleId,$permissionId)
    {

        $this->service->assignPermissions($roleId, $permissionId);
        return response()->json(['message' => 'Permissions updated for role']);
    }

    public function getPermissions($roleId)
    {
        return $this->service->getPermissions($roleId);
    }

    public function store(CreateRoleRequest $request)
    {
        $role = $this->service->create($request->validated());
        return $this->successResponse($role, 'Role created successfully');
    }
}

