<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueCategory extends Model
{
    protected $fillable = ['name', 'parent_id', 'type'];

    // العلاقة مع التصنيف الأب
    public function parent()
    {
        return $this->belongsTo(IssueCategory::class, 'parent_id');
    }

    // العلاقة مع التصنيفات الأبناء
    public function children()
    {
        return $this->hasMany(IssueCategory::class, 'parent_id');
    }


    // القضايا المرتبطة بهذا التصنيف
    public function issues()
    {
        return $this->hasMany(Issue::class, 'category_id');
    }



}
