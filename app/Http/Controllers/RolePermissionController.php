<?php

namespace App\Http\Controllers;

use App\Services\RolePermissionService;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    protected $service;

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
}

