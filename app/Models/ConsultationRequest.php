<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    protected $fillable = ['subject', 'details', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultation()
    {
         return $this->hasOne(Consultation::class);  
    }
    
}

