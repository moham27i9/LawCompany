<?php

namespace App\Repositories;

use App\Models\CompanyInfo;

class CompanyInfoRepository
{
    public function updateInfo(array $data)
    {
        $info = CompanyInfo::first(); 
        $info->update($data);
        return $info;
    }

    public function getInfo()
    {
        return CompanyInfo::first();
    }
}
