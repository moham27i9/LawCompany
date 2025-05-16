<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessionss extends Model
{


    protected $fillable = [
        'outcome',
        'type',
        'is_attend',
        'issue_id',
        'lawyer_id',
       
    ];
    public function issue()
{
    return $this->belongsTo(Issue::class);
}
    public function lawyer()
{
    return $this->belongsTo(Lawyer::class);
}
    public function point()
{
    return $this->hasOne(Point::class);
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
}
