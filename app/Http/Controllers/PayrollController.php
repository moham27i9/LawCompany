<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Lawyer;
use App\Models\Payroll;
use App\Models\User;
use App\Services\PayrollService;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    use ApiResponseTrait;
    protected $service;

    public function __construct(PayrollService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
     return $this->successResponse($this->service->all(), 'تم إعادة جميع الدفعات بنجاح ');
    }

    public function show($id)
    {
         return $this->successResponse($this->service->find($id), 'تم إعادة الدفعة بنجاح ');
    }

    public function store($user_id)
    {
       $user = User::findOrFail($user_id);
         if($user->role->name === 'lawyer'){
             $employable = Lawyer::findOrFail($user->lawyer->id);
             $payroll = $this->service->generatePayroll($employable, $employable->salary);
         }else{
             $employable = Employee::findOrFail($user->employee->id);
             $payroll = $this->service->generatePayroll($employable, $employable->salary);
         }
      
          return $this->successResponse($payroll, 'تم إضافة الدفعة بنجاح ');

        return response()->json($payroll);
    }

    public function update(Request $request, $id)
    {
         return $this->successResponse($this->service->update($id, $request->all()), 'تم تحديث الدفعة بنجاح ');
    }

    public function destroy($id)
    {
         return $this->successResponse($this->service->delete($id), 'تم حذف الدفعة بنجاح ');
    }
    
    public function getMonthlyCosts()
    {
         return $this->successResponse($this->service->getMonthlyCosts(), 'تم ارجاع التكاليف بنجاح ');
    }



}
