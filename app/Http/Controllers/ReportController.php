<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReportRequest;
use App\Http\Requests\GenerateLawyerReportRequest;
use App\Services\ReportService;
use App\Traits\ApiResponseTrait;
use Barryvdh\DomPDF\Facade\Pdf;
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
        return $this->successResponse($result, ' تم انشاء تقرير توضيح لرواتب الموظفين  بنجاح ' );
    }

public function lawyerSessionsReport(GenerateLawyerReportRequest $request)
{
    return $this->service->generateLawyerReport(
        auth()->user()->lawyer->id,
        $request->from,
        $request->to
    );
}


    public function generate_session_report($sessionId)
    {
        $sessionData = $this->service->generate_session_report($sessionId);

        $pdf = Pdf::loadView('reports.session_report', $sessionData);

        return $pdf->stream('session_report.pdf');
    }


    public function generate_issue_report($issueId)
    {
        if (!auth()->user()->role->name ='admin') {
            return $this->errorResponse('غير مسموح لك بعرض هذا التقرير', 403);
        }

        $data = $this->service->generate_issue_report($issueId);

        $pdf = Pdf::loadView('reports.issue_report', $data);
        return $pdf->stream('issue_report.pdf');
    }

    public function generate_user_report($userId)
    {
        if (!auth()->user()->role->name ='admin') {
            return $this->errorResponse('ليس لديك صلاحية', 403);
        }

        $data = $this->service->generate_user_report($userId);
        $pdf = Pdf::loadView('reports.user_report', $data);

        return $pdf->stream('user_report.pdf');
    }


    public function generateInvoicesReport()
    {
        $result = $this->service->generateInvoicesReport();
        return $this->successResponse($result, 'تم إنشاء تقرير الدفعات المالية بنجاح');
    }


    public function generateHiringReport()
    {
        $result = $this->service->generateHiringReport();
        return $this->successResponse($result, 'تم إنشاء تقرير الوظائف والمتقدمين لها بنجاح');
    }

}
