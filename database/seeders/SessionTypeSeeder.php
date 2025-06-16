<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SessionType;

class SessionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $sessionTypes = [
            ['type' => 'preliminary',    'points' => 5,  'description' => 'جلسة تمهيدية لعرض الموضوع ومراجعة المعلومات الأولية.'],
            ['type' => 'hearing',        'points' => 10, 'description' => 'جلسة استماع للشهود أو الأطراف.'],
            ['type' => 'judgment',       'points' => 20, 'description' => 'جلسة النطق بالحكم النهائي.'],
            ['type' => 'pleading',       'points' => 15, 'description' => 'جلسة مرافعة يقدم فيها المحامون حججهم.'],
            ['type' => 'postponed',      'points' => 0,  'description' => 'جلسة مؤجلة لأسباب إجرائية أو فنية.'],
            ['type' => 'mediation',      'points' => 12, 'description' => 'جلسة وساطة لحل النزاع وديًا.'],
            ['type' => 'followup',       'points' => 8,  'description' => 'جلسة متابعة تطورات القضية.'],
            ['type' => 'consultation',   'points' => 6,  'description' => 'جلسة استشارية مع أحد الأطراف أو الخبراء.'],
        ];

        foreach ($sessionTypes as $type) {
            SessionType::create($type);
        }
    }
}
