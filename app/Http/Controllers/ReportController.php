<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReportRequest;
use App\Services\ReportService;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(ReportService $service )
    {
        $this->service = $service;
    }

    public function store(CreateReportRequest $request)
    {
        $employeeId = auth()->user()->employee->id;

        $file = $request->file('file');
        $filename = 'report_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('storage/reports', $filename, 'public');

        $data = $request->validated();
        $data['file_path'] = $path;
        $data['employee_id'] = $employeeId;
        $data['report_date'] = now();

        $report = $this->service->create($data);

        return $this->successResponse($report, 'تم إنشاء التقرير بنجاح');
    }

    public function index()
    {
        $reports = $this->service->getAll();
        return $this->successResponse($reports, 'تم استرجاع التقارير بنجاح');
    }

    public function show($id)
    {
        $report = $this->service->getById($id);
        return $this->successResponse($report, 'تفاصيل التقرير');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'تم حذف التقرير بنجاح');
    }


    public function generateFinancial()
    {
        $result = $this->service->generate();
        return $this->successResponse($result, ' تم انشاء التقرير المالي  وحساب رواتب الموظفين  بنجاح ' );
    }

}
