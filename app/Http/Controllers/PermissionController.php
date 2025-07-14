<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PermissionController extends Controller
{
    use ApiResponseTrait;use AuthorizesRequests;
    protected $service;

    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $permission = $this->service->getAll();
        return $this->successResponse($permission , 'Permissions retrieved successfully ');
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

     public function update(UpdatePermissionRequest $request , $id)
    {

        $permission = $this->service->update($request->validated(),$id);
        return $this->successResponse($permission, 'permission updated successfully');
        return $this->errorResponse('no updates yet!', 422, null);
    }

 public function getUserPermissions($userId)
{
    $this->authorize('viewAny', Permission::class);

    $permissions = $this->service->getPermissionsByUserId($userId);

    return $this->successResponse($permissions, 'User permissions retrieved successfully');
}


}

