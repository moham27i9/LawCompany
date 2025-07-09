<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AttendDemand extends Model
{
    protected $fillable = [
        'issue_id',
        'lawyer_id',
        'resault',
        'date',
    ];
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
