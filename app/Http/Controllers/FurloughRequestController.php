<?php

namespace App\Http\Controllers;

use App\Services\FurloughRequestService;
use App\Http\Requests\StoreFurloughRequest;
use App\Http\Requests\UpdateFurloughRequest;
use App\Models\FurloughRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class FurloughRequestController extends Controller
{
    use ApiResponseTrait;
    use AuthorizesRequests;
    protected $service;

    public function __construct(FurloughRequestService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
         $this->authorize('viewAny', FurloughRequest::class);
         return $this->successResponse($this->service->getAll(), 'All furlough Requests');
    }

    public function store(StoreFurloughRequest $request)
    {
        $this->authorize('create', FurloughRequest::class); 
        $created = $this->service->create($request->validated());
         return $this->successResponse($created, 'furlough Request created');
    }

    public function show($id)
    {
        $item = $this->service->getById($id);
         $this->authorize('view', $item);
         return $this->successResponse($item, 'furlough Request details');
    }

    public function update(UpdateFurloughRequest $request, $id)
    {
           $furlough = $this->service->getById($id);
           $this->authorize('update', $furlough);
        $updated = $this->service->update($id, $request->validated());
        return $this->successResponse($updated, 'furlough Request updated');
    }

    public function updateStatus(UpdateFurloughRequest $request, $id)
    {
           $furlough = $this->service->getById($id);
           $this->authorize('updateStatus', $furlough);
        $updated = $this->service->update($id, $request->validated());
        return $this->successResponse($updated, 'furlough Request status updated');
    }

    public function destroy($id)
    {  $furlough = $this->service->getById($id);
        $this->authorize('delete', $furlough);
        $deleted = $this->service->delete($id);
        return $this->successResponse($deleted, 'furlough Request deleted');
    }
}