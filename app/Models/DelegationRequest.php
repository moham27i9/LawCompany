<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DelegationRequest extends Model
{
 
    protected $fillable = [
        'delegation_file', 
        'admin_note', 
        'status', 
        'delegate_lawyer_id', 
         'original_lawyer_id',
         'session_id'
    ];


    public function session()
    {
        return $this->belongsTo(Sessionss::class);
    }

    public function originalLawyer()
    {
        return $this->belongsTo(Lawyer::class, 'original_lawyer_id');
    }

    public function delegateLawyer()
    {
        return $this->belongsTo(Lawyer::class, 'delegate_lawyer_id');
    }

}