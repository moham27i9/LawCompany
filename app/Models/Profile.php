<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
   
    protected $fillable = [
        'age',
        'phone',
        'address',
        'image',
        'user_id',
        'scientificLevel',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

}