<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $date
 * @property int $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Session $session
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SessionAppointment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SessionAppointment extends Model
{
protected $fillable = ['date', 'type', 'session_id'];
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
