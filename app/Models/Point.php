<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $rate
 * @property int $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Session $session
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Point newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Point newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Point query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Point whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Point whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Point whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Point extends Model
{
    protected $fillable = [
        'rate',
        'session_id',
    
    ];
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
