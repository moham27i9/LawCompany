<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryAdjustment extends Model
{
     protected $fillable = [
        'type', 'reason', 'amount', 'effective_date',
        'employable_id', 'employable_type'
    ];

    public function employable()
    {
        return $this->morphTo();
    }
}
