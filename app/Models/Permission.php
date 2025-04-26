<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   
    protected $fillable = ['name', 'app_route_id'];

    public function route()
    {
        return $this->belongsTo(AppRoute::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_permissions');
    }

}
