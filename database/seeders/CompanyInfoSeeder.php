<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    public function run(): void
    {
        CompanyInfo::create([
            'name' => 'Yagmour Law Company',
            'address' => '123 Main Street, Damascus, Syria',
            'foundation_date' => '2005-05-15',
            'description' => 'شركة قانونية تقدم الاستشارات والخدمات القانونية في مختلف المجالات.',
            'goals' => 'تحقيق العدالة، تقديم المشورة القانونية المتخصصة، دعم العملاء.',
            'vision' => 'أن نكون الشركة القانونية الرائدة في المنطقة.',
        ]);
    }
}
