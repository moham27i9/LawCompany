<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessionss extends Model
{


    protected $fillable = [
        'outcome',
        'is_attend',
        'issue_id',
        'lawyer_id',
        'session_type_id',
         'notes',

    ];
    public function issue()
{
    return $this->belongsTo(Issue::class);
}
    public function lawyer()
{
    return $this->belongsTo(Lawyer::class);
}

    public function issueProgressReport()
{
    return $this->hasOne(IssueProgressReport::class);
}
    public function appointments()
{
    return $this->hasMany(SessionAppointment::class);
}
    public function documents()
{
    return $this->hasMany(Document::class);
}
    public function sessionType()
    {
        return $this->belongsTo(SessionType::class);
    }

}
