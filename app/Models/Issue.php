<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $issueNumber
 * @property string $category
 * @property int $num_of_payments
 * @property string|null $total_cost
 * @property float $due
 * @property string|null $description
 * @property int $user_id
 * @property string $status
 * @property string $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttendDemand> $attend_demand
 * @property-read int|null $attend_demand_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereIssueNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereNumOfPayments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Issue whereUserId($value)
 * @mixin \Eloquent
 */
class Issue extends Model
{

    protected $fillable = [
        'title',
        'issue_number',
        'category',
        'opponent_name',
        'court_name',
        'description',
        'user_id',
        'number_of_payments',
        'total_cost',
        'amount_paid',
        'status',
        'priority',
        'start_date',
        'end_date',
   
    ];
    

    public function invoices()
{
    return $this->hasMany(Invoice::class);
}
    public function sessions()
{
    return $this->hasMany(Session::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}

public function attend_demand()
{
    return $this->hasMany(AttendDemand::class);
}
}
