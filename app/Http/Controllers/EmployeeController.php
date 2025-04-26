<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
<<<<<<< HEAD
        // BCOmment2
        // comment for test
=======
>>>>>>> B_Rayyan
        return $this->employeeService->list();
    }

    public function store(CreateEmployeeRequest $request,$id)
    {

        return $this->employeeService->create($id,$request->validated());
    }

    public function show($id)
    {
        return $this->employeeService->show($id);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {

        return $this->employeeService->update($id, $request->validated());
    }

    public function destroy($id)
    {
        $this->employeeService->delete($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}

