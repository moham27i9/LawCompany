<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreIssueProgressReportRequest;
use App\Services\IssueProgressReportService;
use App\Traits\ApiResponseTrait;

class IssueProgressReportController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(IssueProgressReportService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $reports = $this->service->getAll();
        return $this->successResponse($reports, 'تم جلب تقارير التقدم');
    }

    public function store(StoreIssueProgressReportRequest $request, $session_id)
    {
        $data = $request->validated();
        $data['session_id'] = $session_id;

        $report = $this->service->store($data);
        return $this->successResponse($report, 'تم إنشاء تقرير التقدم بنجاح');
    }


    public function show($id)
    {
        $report = $this->service->getById($id);
        return $this->successResponse($report, 'تفاصيل التقرير');
    }

    public function update(StoreIssueProgressReportRequest $request, $id)
    {
        $report = $this->service->update($request->validated(), $id);
        return $this->successResponse($report, 'تم تعديل التقرير');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'تم حذف التقرير بنجاح');
    }

    public function getByIssueId($issueId)
    {
        $reports = $this->service->getByIssueId($issueId);

        if(!$reports->isEmpty())
            return $this->successResponse($reports);
        return $this->errorResponse('reports failed!');

    }
}

