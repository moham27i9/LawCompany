<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @mixin IdeHelperComplaint
 */
class Complaint extends Model
{
    protected $fillable = [
    
        'status',
        'description',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
