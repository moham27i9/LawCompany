<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $jopTitle
 * @property string $type
 * @property string $description
 * @property string $status
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobApplication> $jobApplication
 * @property-read int|null $job_application_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereJopTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HiringRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HiringRequest extends Model
{
    protected $fillable = [
        'jopTitle',
        'created_by',
        'status',
        'type',
        'description',
      
    ];

    public function jobApplication()
    {
        return $this->hasMany(JobApplication::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
