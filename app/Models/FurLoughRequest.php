<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @mixin IdeHelperFurloughRequest
 */
class FurloughRequest extends Model
{
    protected $table = 'fur_lough_requests';

    protected $fillable = [
        'start_date', 'end_date', 'cause', 'status', 'covet_by_id', 'covet_by_type'
    ];

    public function covet_by()
    {
        return $this->morphTo();
    }
}
