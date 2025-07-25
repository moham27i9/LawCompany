<?php

namespace App\Services;
use App\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\EmployeeRepository;

class EmployeeService
{
     use ApiResponseTrait; 
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function list()
    {
        $employee = $this->employeeRepository->getAll();
        return $this->successResponse($employee, 'success');  
    }

    public function create($id, $data)
    {
        return DB::transaction(function () use ($data, $id) {
    
            $user = User::findOrFail($id);
    
            if ($user->employee) {
                return $this->errorResponse('هذا المستخدم مسجل بالفعل كموظف!', 422);
            }
            if ($user->lawyer) {
                $user->lawyer->delete();
            }
    
            if (strtolower($data['type']) === 'hr') {
                $user->role_id = 3;
            } elseif (strtolower($data['type']) === 'accountant') {
                $user->role_id = 4;
            } 
            $user->save();
                 // التعامل مع الملف
        if (isset($data['certificate']) && $data['certificate'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = 'EMP_cert_' . $user->id . '.' . $data['certificate']->getClientOriginalExtension();
              $data['certificate']->storeAs('certificates', $filename, 'public');
            $data['certificate'] =  'storage/certificates/' . $filename;
        }
            $employee = $this->employeeRepository->create([
                'hire_date' => $data['hire_date'],
                'salary' => $data['salary'],
                'certificate' => $data['certificate'],
                'user_id' => $id
            ]);
    
            return $this->successResponse($employee, 'تمت إضافة الموظف بنجاح');
        });
    }
    

    public function show($id)
    {
        $employee = $this->employeeRepository->find($id);      
    if ($employee) {
        return [
            'id'=>$employee->id,
            'name' => $employee->user->name,
            'email' => $employee->user->email,

            'address' => $employee->user->profile->address,
            'phone' => $employee->user->profile->phone,
            'age' => $employee->user->profile->age,
            'image' => $employee->user->profile->image ? asset($employee->user->profile->image) : null,

            'salary' => $employee->salary,
            'hire_date' => $employee->hire_date,
            'certificate' => $employee->certificate ? asset($employee->certificate):null,
        ];
    }

        return null;  
    }

    public function update($id, $data)
    {
         if (isset($data['certificate']) && $data['certificate'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = 'EMP_cert_' . $id . '.' . $data['certificate']->getClientOriginalExtension();
              $data['certificate']->storeAs('certificates', $filename, 'public');
            $data['certificate'] =  'storage/certificates/' . $filename;
        }
        $employee = $this->employeeRepository->update($id, $data);
        return $this->successResponse($employee, 'success');  
        return $this->errorResponse('Updated failed', 500);
    }

    public function delete($id)
    {
        $employee = $this->employeeRepository->find($id);
        $user = $employee->user;
        $user->role_id = 2;
        $user->save();
        $employee = $this->employeeRepository->delete($id);
        return $this->successResponse($employee, 'Deleted successfully',200);  
        return $this->errorResponse('Deleted failed', 500);
    }
}
