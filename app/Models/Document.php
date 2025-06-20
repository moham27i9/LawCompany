<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'session_id',
        'file',
        'privacy',

    ];
    public function session()
    {
        return $this->belongsTo(Sessionss::class , 'session_id');
    }
}
