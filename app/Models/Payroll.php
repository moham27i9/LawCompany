<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'payment',
        'status',
        'confirm',
      
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
