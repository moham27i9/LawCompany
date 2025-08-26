<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperIssue
 */
class Issue extends Model
{

    protected $fillable = [
        'title',
        'issue_number',
        'category_id',
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
        'lawyer_percentage',
    ];

    // protected $casts = [
    //     'lawyer_ids' => 'array',
    // ];



    public function invoices()
{
    return $this->hasMany(Invoice::class);
}
    public function sessions()
{
    return $this->hasMany(Sessionss::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}

public function attend_demand()
{
    return $this->hasMany(AttendDemand::class);
}

public function lawyers()
{
    return $this->belongsToMany(Lawyer::class, 'issue_lawyer');
}
public function category()
{
    return $this->belongsTo(IssueCategory::class, 'category_id');
}



}
