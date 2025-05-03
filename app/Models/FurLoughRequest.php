<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property string $cause
 * @property string $status
 * @property string $covet_by_type
 * @property int $covet_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereCause($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereCovetById($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereCovetByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FurLoughRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FurLoughRequest extends Model
{
    //
}
