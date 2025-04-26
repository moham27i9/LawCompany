<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $date
 * @property string $resault
 * @property int $issue_id
 * @property int $lawyer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Issue $issue
 * @property-read \App\Models\Lawyer $lawyer
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereIssueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereResault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttendDemand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttendDemand extends Model
{
    protected $fillable = [
        'issue_id',
        'lawyer_id',
        'resault',
        'date',
    ];
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
