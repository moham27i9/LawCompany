<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteModel extends Model
{
    protected $table = ['routes'];
    protected $fillable = ['name', 'path', 'method'];

    public function permission()
    {
        return $this->hasOne(Permission::class);
    }

    
}
