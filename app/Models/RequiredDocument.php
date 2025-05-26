<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequiredDocument extends Model
{
      protected $fillable = ['issue_id', 'require_file_type', 'file', 'status', 'note'];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
