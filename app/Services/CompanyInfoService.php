<?php

namespace App\Services;

use App\Models\CompanyInfo;
use App\Models\Employee;
use App\Models\Lawyer;
use App\Repositories\CompanyInfoRepository;

class CompanyInfoService
{
    protected $repo;

    public function __construct(CompanyInfoRepository $repo)
    {
        $this->repo = $repo;
    }

    public function updateInfo(array $data)
    {
        return $this->repo->updateInfo($data);
    }

    public function getCompanyWithTeam()
    {
        $company = CompanyInfo::firstOrFail();

        $lawyers   = Lawyer::with(['user.profile'])->get();

        return [
            'company'   => $company,
            'lawyers'   => $lawyers
        ];
    }
}
