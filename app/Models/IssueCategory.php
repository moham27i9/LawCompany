<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperIssueCategory
 */
class IssueCategory extends Model
{
    protected $fillable = ['name', 'parent_id', 'type'];

    public function parent()
    {
        return $this->belongsTo(IssueCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(IssueCategory::class, 'parent_id');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'category_id');
    }

}
