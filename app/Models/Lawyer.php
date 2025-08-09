<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Lawyer extends Model
{
    protected $fillable = [
        'license_number',
        'experience_years',
        'salary',
        'certificate',
        'type',
        'user_id',
        'specialization',
        'age',
        'phone',
        'address',
        'image',
        'user_id',
        'scientificLevel',
    ];
    public function leaves()
    {
        return $this->morphMany(FurLoughRequest::class, 'covet_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sessions()
    {
        return $this->hasMany(Sessionss::class);
    }
    public function attend_demand()
    {
        return $this->hasMany(AttendDemand::class);
    }

    public function issues()
    {
        return $this->belongsToMany(Issue::class, 'issue_lawyer');
    }

    public function points()
    {
        return $this->hasMany(LawyerPoint::class);
    }

    public function payrolls()
    {
        return $this->morphMany(\App\Models\Payroll::class, 'payable');
    }

    public function delegationRequestsSent()
    {
        return $this->hasMany(DelegationRequest::class, 'original_lawyer_id');
    }

    public function delegationRequestsReceived()
    {
        return $this->hasMany(DelegationRequest::class, 'delegate_lawyer_id');
    }


}
