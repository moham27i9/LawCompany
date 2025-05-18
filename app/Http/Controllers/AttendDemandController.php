<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendDemandRequest;
use App\Http\Requests\UpdateAttendDemandRequest;
use App\Services\AttendDemandService;
use App\Traits\ApiResponseTrait;

class AttendDemandController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(AttendDemandService $service)
    {
        $this->service = $service;
    }

    public function index($issue_id)
    {
        $demands = $this->service->getByIssue($issue_id);
        return $this->successResponse($demands, 'AttendDemands fetched successfully');
    }

    public function store(StoreAttendDemandRequest $request, $issue_id)
    {
        $demand = $this->service->create($request->validated(), $issue_id);
        return $this->successResponse($demand, 'AttendDemand created successfully');
    }

    public function show($id)
    {
        $demand = $this->service->getById($id);
        return $this->successResponse($demand, 'AttendDemand retrieved successfully');
    }

    public function update(UpdateAttendDemandRequest $request, $id)
    {
        $demand = $this->service->update($request->validated(), $id);
        return $this->successResponse($demand, 'AttendDemand updated successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'AttendDemand deleted successfully');
    }
}
