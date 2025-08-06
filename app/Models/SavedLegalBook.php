<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $legalbook_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereLegalbookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalBook whereUserId($value)
 * @mixin \Eloquent
 */
class SavedLegalBook extends Model
{

    protected $fillable = [
        'user_id',
        'legalbook_id',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function legalBook()
    {
        return $this->belongsTo(\App\Models\LegalBook::class, 'legalbook_id');
    }
}
