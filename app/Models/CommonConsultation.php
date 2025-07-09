<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonConsultation extends Model
{
    protected $table = 'common_consulation';
    protected $fillable = ['question', 'answer'];
}
