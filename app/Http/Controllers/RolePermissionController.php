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
      public function index()
    {
        return $this->successResponse($this->service->all(), 'Roles retrieved successfully');
    }
      public function show($role_id)
    {
        return $this->successResponse($this->service->getById($role_id), 'Role details retrieved successfully');
    }
      public function destroy($role_id)
    {
        return $this->successResponse($this->service->destroy($role_id), 'Role  deleted successfully');
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

