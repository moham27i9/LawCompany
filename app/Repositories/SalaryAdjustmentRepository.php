<?php
namespace App\Repositories;

use App\Models\Employee;
use App\Models\Lawyer;
use App\Models\SalaryAdjustment;
use App\Models\User;

class SalaryAdjustmentRepository
{
    public function all()
    {
        return SalaryAdjustment::with('employable')->get();
    }

    public function find($id)
    {
        return SalaryAdjustment::with('employable')->findOrFail($id);
    }

    public function create(array $data,$user_id)
    {
        $user = User::findOrFail($user_id);
        if($user->role->name === 'lawyer'){
             $data['employable_id'] =$user->lawyer->id;
            $data['employable_type'] = Lawyer::class;
         }else{
             $data['employable_id'] =$user->employee->id;
            $data['employable_type'] = Employee::class;
         }
        return SalaryAdjustment::create($data);
    }

    public function update($id, array $data)
    {
        $item = SalaryAdjustment::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        return SalaryAdjustment::destroy($id);
    }
}
