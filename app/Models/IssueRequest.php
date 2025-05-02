<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueRequest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'admin_note',
 
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
