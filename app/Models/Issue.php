<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{

    protected $fillable = [
        'title',
        'issue_number',
        'category',
        'opponent_name',
        'court_name',
        'description',
        'user_id',
        'number_of_payments',
        'total_cost',
        'amount_paid',
        'status',
        'priority',
        'start_date',
        'end_date',
   
    ];
    

    public function invoices()
{
    return $this->hasMany(Invoice::class);
}
    public function sessions()
{
    return $this->hasMany(Session::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}

public function attend_demand()
{
    return $this->hasMany(AttendDemand::class);
}
}
