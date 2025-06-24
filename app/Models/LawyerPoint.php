<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LawyerPoint extends Model
{
    protected $fillable = [
        'lawyer_id',
        'points',
        'source',
        'notes',
        'session_id',
        'admin_id',
    ];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function session()
    {
        return $this->belongsTo(Sessionss::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

