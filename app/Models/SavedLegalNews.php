<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $legalNews_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereLegalNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavedLegalNews whereUserId($value)
 * @mixin \Eloquent
 * @mixin IdeHelperSavedLegalNews
 */
class SavedLegalNews extends Model
{
    protected $fillable = [
        'user_id',
        'legalNews_id',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function legalNew()
    {
        return $this->belongsTo(\App\Models\LegalNews::class, 'legalNews_id');
    }

}
