<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'payment',
        'status',
        'allowances',
         'deductions',
        // 'confirm',
        'payable_id',
        'payable_type',

    ];


    public function payable()
    {
        return $this->morphTo();
    }

       public function expenses() {
        return $this->morphMany(Expense::class, 'related');
    }

}
