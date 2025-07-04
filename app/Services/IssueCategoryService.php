<?php

// app/Services/IssueCategoryService.php

namespace App\Services;

use App\Repositories\IssueCategoryRepository;

class IssueCategoryService
{
    protected $issueRepository;

    public function __construct(IssueCategoryRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function getTree()
    {
        return $this->issueRepository->getTree();
    }






}
