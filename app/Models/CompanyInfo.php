<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCompanyInfo
 */
class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'name',
        'address',
        'foundation_date',
        'description',
        'goals',
        'vision'
    ];

    protected $casts = [
        'foundation_date' => 'date',
    ];
}
