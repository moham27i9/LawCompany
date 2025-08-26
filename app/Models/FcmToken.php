<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FcmToken extends Model
{
    protected $table = 'user_fcm_tokens';
         protected $fillable = ['device_type', 'user_id', 'fcm_token'];

         public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
