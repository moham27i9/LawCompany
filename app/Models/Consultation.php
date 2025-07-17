<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
     protected $table = 'consulations';
   protected $fillable = [
        'consultation_req_id',
        'lawyer_id',
        'resault',

    ];



    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function consultationRequests()
    {
        return $this->belongsTo(ConsultationRequest::class );
    }
}
