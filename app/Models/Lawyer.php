<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $license_number
 * @property float $experience_years
 * @property string $salary
 * @property string|null $certificate
 * @property string $type
 * @property string $specialization
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendDemand> $attend_demand
 * @property-read int|null $attend_demand_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FurLoughRequest> $leaves
 * @property-read int|null $leaves_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereExperienceYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lawyer whereUserId($value)
 * @mixin \Eloquent
 */
class Lawyer extends Model
{
    protected $fillable = [
        'license_number',
        'experience_years',
        'salary',
        'certificate',
        'type',
        'user_id',
        'specialization',
        'age',
        'phone',
        'address',
        'image',
        'user_id',
        'scientificLevel',
    ];
    public function leaves()
    {
        return $this->morphMany(FurLoughRequest::class, 'covet_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sessions()
    {
        return $this->hasMany(Sessionss::class);
    }
    public function attend_demand()
    {
        return $this->hasMany(AttendDemand::class);
    }

    public function issues()
    {
        return $this->belongsToMany(Issue::class, 'issue_lawyer');
    }

    public function points()
    {
        return $this->hasMany(LawyerPoint::class);
    }


}
