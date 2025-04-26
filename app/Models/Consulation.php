<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $description
 * @property string $status
 * @property int $user_id
 * @property int $lawyer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lawyer $lawyer
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation whereLawyerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consulation whereUserId($value)
 * @mixin \Eloquent
 */
class Consulation extends Model
{
    protected $fillable = [
        'user_id',
        'lawyer_id',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
}
