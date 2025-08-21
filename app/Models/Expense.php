<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
       protected $fillable = ['description', 'amount', 'type', 'related_id', 'related_type'];

    public function related()
    {
        return $this->morphTo();
    }
}
