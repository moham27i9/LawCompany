<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

     use ApiResponseTrait;
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return $this->employeeService->list();
    }

    public function store(CreateEmployeeRequest $request,$id)
    {
        return $this->employeeService->create($id,$request->validated());
    }

    public function show($id)
    {

        $employee = $this->employeeService->show($id);
        if(!$employee)
            return $this->errorResponse(null, 'failed');
        return $this->successResponse($employee, 'success');
    }

    public function update(UpdateEmployeeRequest $request)
    {

        return $this->employeeService->update(auth()->user()->employee->id, $request->validated());
    }

    public function destroy($id)
    {
        $this->employeeService->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}

