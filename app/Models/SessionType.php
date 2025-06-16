<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    protected $fillable = ['type', 'points', 'description'];

    public function sessions()
    {
        return $this->hasMany(Sessionss::class);
    }
}
