<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\User;
use Cache;

class EmployeeRepository
{
public function getAll()
{
    return Cache::remember('employees_all', now()->addMinutes(30), function () {
        return Employee::all();
    });
}

    public function find($id)
    {
        return Employee::findOrFail($id);
    }

    public function create(array $data)
    {
        $user = User::findOrFail($data['user_id']);

        return Employee::create($data);
    }

    public function update($id, array $data)
    {

        $employee = Employee::findOrFail($id);
        $employee->update($data);
        $employee->save();
        return $employee;
    }

    public function delete($id)
    {
        return Employee::destroy($id);
    }
}
