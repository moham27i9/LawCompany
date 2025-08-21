<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Services\ExpenseService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    use ApiResponseTrait;
    protected $service;

    public function __construct(ExpenseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
       return $this->successResponse(  $this->service->getAll(), 'تم إعادة جميع التكاليف المضافة بنجاح');
    }

    public function show($id)
    {
         return $this->successResponse( $this->service->getById($id), 'تم إعادة تفاصيل التكلفة بنجاح');
    }

    public function store(StoreExpenseRequest $request)
    {
     return $this->successResponse( $this->service->create($request->validated()), 'تم إنشاء التكلفة بنجاح');
   
    }

    public function update(UpdateExpenseRequest $request, $id)
    {
        return $this->successResponse($this->service->update($id, $request->validated()),'تم تحديث التكلفة بنجاح');
    }

    public function destroy($id)
    {
        return $this->successResponse($this->service->delete($id),'تم حذف التكلفة بنجاح');
    }


}
