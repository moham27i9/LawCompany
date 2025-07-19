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
        'is_locked',
        'scheduled_at'
 
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
