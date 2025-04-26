<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $bookTitle
 * @property string $book
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SavedLegalBook> $SavedLegalBook
 * @property-read int|null $saved_legal_book_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereBook($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereBookTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LegalBook whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LegalBook extends Model
{
    protected $fillable = [
        'book',
        'bookTitle',
      
    ];
    public function SavedLegalBook()
    {
        return $this->hasMany(SavedLegalBook::class);
    }
}
