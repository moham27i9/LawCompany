<?php
// app/Http/Controllers/IssueCategoryController.php

namespace App\Http\Controllers;

use App\Services\IssueCategoryService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class IssueCategoryController extends Controller
{
    use ApiResponseTrait;

    protected $issueService;

    public function __construct(IssueCategoryService $issueService)
    {
        $this->issueService = $issueService;
    }

    public function index()
    {
        $tree = $this->issueService->getTree();
        return $this->successResponse($tree, 'All categories retrieved successfully');
    }



}
