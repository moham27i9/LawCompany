<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $report
 * @property int $pre_session_count
 * @property int $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Session $session
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport wherePreSessionCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IssueProgressReport whereUpdatedAt($value)
 * @mixin \Eloquent
 * @mixin IdeHelperIssueProgressReport
 */
class IssueProgressReport extends Model
{
    protected $fillable = [
        'session_id',
        'pre_session_count',
        'report',

    ];
    public function session()
    {
        return $this->belongsTo(Sessionss::class ,  'session_id');
    }
}
