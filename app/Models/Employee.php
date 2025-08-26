<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $salary
 * @property string|null $certificate
 * @property string $hire_date
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HiringRequest> $hiringRequest
 * @property-read int|null $hiring_request_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FurLoughRequest> $leaves
 * @property-read int|null $leaves_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payroll> $payroll
 * @property-read int|null $payroll_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Report> $reports
 * @property-read int|null $reports_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereHireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUserId($value)
 * @mixin \Eloquent
 * @mixin IdeHelperEmployee
 */
class Employee extends Model
{

    protected $fillable = [
        'certificate',
        'salary',
        'hire_date',
        'user_id',
    ];
    public function leaves()
    {
        return $this->morphMany(FurLoughRequest::class, 'covet_by');
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function payrolls()
    {
        return $this->morphMany(Payroll::class, 'payable');
    }

    public function salaryAdjustments()
    {
        return $this->morphMany(SalaryAdjustment::class, 'employable');
    }


    public function hiringRequest()
    {
        return $this->hasMany(HiringRequest::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
