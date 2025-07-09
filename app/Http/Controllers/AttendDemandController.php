<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendDemandRequest;
use App\Http\Requests\UpdateAttendDemandRequest;
use App\Http\Requests\UpdateAttendDemandResaultRequest;
use App\Models\AttendDemand;
use App\Services\AttendDemandService;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttendDemandController extends Controller
{
    use ApiResponseTrait;
     use AuthorizesRequests;
    protected $service;

    public function __construct(AttendDemandService $service)
    {
        $this->service = $service;
    }

    public function index($issue_id)
    {
        $demands = $this->service->getByIssue($issue_id);
        return $this->successResponse($demands, 'Attend Demands fetched successfully');
    }

    public function store(StoreAttendDemandRequest $request, $issue_id)
    {
        $demand = $this->service->create($request->validated(), $issue_id);
        return $this->successResponse($demand, 'Attend Demand created successfully');
    }

    public function show($id)
    {
        $demand = $this->service->getById($id);
        return $this->successResponse($demand, 'Attend Demand retrieved successfully');
    }
    public function showMyDemands()
    {
        $demand = $this->service->getMyDemand();
        return $this->successResponse($demand, 'your Attend Demands retrieved successfully');
    }

    public function update(UpdateAttendDemandRequest $request, $id)
    {
        $demand = $this->service->update($request->validated(), $id);
        return $this->successResponse($demand, 'Attend Demand updated successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'Attend Demand deleted successfully');
    }

    public function updateResault(UpdateAttendDemandResaultRequest $request, $id)
{
    $attendDemand = AttendDemand::with('issue')->findOrFail($id);

    $this->authorize('update', $attendDemand);

    $updated = $this->service->updateResault($attendDemand, $request->resault);

     return $this->successResponse($updated, 'Attend Demand resault updated successfully');
  
}

}
