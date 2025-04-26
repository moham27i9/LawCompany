<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $HirReq_id
 * @property string $cv
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HiringRequest|null $hiringRequest
 * @property-read \App\Models\Interview|null $interview
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereCv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereHirReqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplication whereUserId($value)
 * @mixin \Eloquent
 */
class JobApplication extends Model
{

    protected $fillable = [
        'user_id',
        'HirReq_id',
        'cv',
      
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hiringRequest()
    {
        return $this->belongsTo(HiringRequest::class);
    }
    public function interview()
{
    return $this->hasOne(Interview::class);
}
}
