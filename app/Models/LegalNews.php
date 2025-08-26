<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SavedLegalNews> $savedLegalNews
 * @property-read int|null $saved_legal_news_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalNews whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin IdeHelperLegalNews
 */
class LegalNews extends Model
{

    protected $fillable = [
        'title',
        'description',
      
    ];
    public function savedLegalNews()
    {
        return $this->hasMany(SavedLegalNews::class);
    }
}
