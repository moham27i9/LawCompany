<?php

// app/Repositories/IssueCategoryRepository.php

namespace App\Repositories;

use App\Models\Issue;
use App\Models\IssueCategory;

class IssueCategoryRepository
{
    public function getTree()
    {
        return IssueCategory::with('children.children') // حسب العمق المطلوب
            ->whereNull('parent_id')
            ->get();
    }




}
