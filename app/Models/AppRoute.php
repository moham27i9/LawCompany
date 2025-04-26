<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppRoute extends Model
{
    protected $fillable = ['name', 'path', 'method'];

    public function permission()
    {
        return $this->hasOne(Permission::class);
    }

}
