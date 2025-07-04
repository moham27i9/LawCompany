<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IssueCategory;

class IssueCategorySeeder extends Seeder
{
    public function run(): void
    {
        // الطبقة الأولى
        $general = IssueCategory::create(['name' => 'عام']);
        $judicial = IssueCategory::create(['name' => 'قضائي']);
        $agencies = IssueCategory::create(['name' => 'وكالات']);

        // القضائي → جزائية، مدنية، تجارية، جمركية، مصرفية، عسكرية
        $criminal = IssueCategory::create(['name' => 'جزائية', 'parent_id' => $judicial->id]);
        $civil = IssueCategory::create(['name' => 'مدنية', 'parent_id' => $judicial->id]);
        $commercial = IssueCategory::create(['name' => 'تجارية', 'parent_id' => $judicial->id]);
        $customs = IssueCategory::create(['name' => 'جمركية', 'parent_id' => $judicial->id]);
        $banking = IssueCategory::create(['name' => 'مصرفية', 'parent_id' => $judicial->id]);
        $military = IssueCategory::create(['name' => 'عسكرية', 'parent_id' => $judicial->id]);

        // الجزائية
        IssueCategory::insert([
            ['name' => 'نيابة عامة', 'parent_id' => $criminal->id],
            ['name' => 'استئناف جزاء', 'parent_id' => $criminal->id],
            ['name' => 'صلح جزاء', 'parent_id' => $criminal->id],
            ['name' => 'تحقيق', 'parent_id' => $criminal->id],
            ['name' => 'بداية جزاء', 'parent_id' => $criminal->id],
        ]);

        // المدنية
        IssueCategory::insert([
            ['name' => 'صلح مدني', 'parent_id' => $civil->id],
            ['name' => 'بداية مدنية', 'parent_id' => $civil->id],
            ['name' => 'استئناف مدني', 'parent_id' => $civil->id],
            ['name' => 'نقض مدني', 'parent_id' => $civil->id],
        ]);

        // التجارية
        IssueCategory::insert([
            ['name' => 'بداية تجارية', 'parent_id' => $commercial->id],
            ['name' => 'استئناف تجاري', 'parent_id' => $commercial->id],
            ['name' => 'نقض تجاري', 'parent_id' => $commercial->id],
        ]);

        // الجمركية
        IssueCategory::insert([
            ['name' => 'بداية جمركية', 'parent_id' => $customs->id],
            ['name' => 'استئناف جمركي', 'parent_id' => $customs->id],
            ['name' => 'نقض جمركي', 'parent_id' => $customs->id],
        ]);

        // المصرفية
        IssueCategory::insert([
            ['name' => 'بداية مصرفية', 'parent_id' => $banking->id],
            ['name' => 'استئناف مصرفي', 'parent_id' => $banking->id],
        ]);

        // العسكرية
        IssueCategory::insert([
            ['name' => 'نيابة عسكرية', 'parent_id' => $military->id],
            ['name' => 'فرد عسكري', 'parent_id' => $military->id],
            ['name' => 'تحقيق عسكري', 'parent_id' => $military->id],
            ['name' => 'جنايات عسكرية', 'parent_id' => $military->id],
        ]);
    }
}
