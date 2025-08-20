<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalaryAdjustmentRequest;
use App\Http\Requests\UpdateSalaryAdjustmentRequest;
use App\Services\SalaryAdjustmentService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SalaryAdjustmentController extends Controller
{
    use ApiResponseTrait;
    protected $service;

    public function __construct(SalaryAdjustmentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
         return $this->successResponse($this->service->all(), 'تم ارجاع الرواتب الفعلية بنجاح ');
    }

    public function show($id)
    {
      return $this->successResponse($this->service->find($id), 'تم إعادة التعديل المالي بنجاح ');
    }

    public function store(StoreSalaryAdjustmentRequest $request,$user_id)
    {
        $result = $this->service->create($request->validated(),$user_id);
       return $this->successResponse($result, 'تم إضافة التعديل على الراتب بنجاح ');
    }

    public function update(UpdateSalaryAdjustmentRequest $request, $id)
    {
        $result = $this->service->update($id, $request->validated());
         return $this->successResponse($result, 'تم تعديل التعديل المالي بنجاح ');
    }

    public function destroy($id)
    {
     return $this->successResponse( $this->service->delete($id), 'تم حذف التعديل المالي بنجاح ');
    }
}
