<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'description', 'status', 'lawyer_id','consultation_id'
    ];


    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function consultationRequests()
    {
        return $this->belongsTo(ConsultationRequest::class);
    }
}
