<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\LawyerPoint;
use App\Models\Report;
use App\Models\Sessionss;
use App\Repositories\ReportRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Storage;
use App\Traits\ApiResponseTrait;

class ReportService
{
    use ApiResponseTrait;
    protected $repo;

    public function __construct(ReportRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function calculateFinancialData(): array
    {
        $closedIssues = Issue::with(['sessions.lawyer.user'])->where('status', 'closed')->get();
        $reportData = [];

        foreach ($closedIssues as $issue) {
            $lawyers = [];

            foreach ($issue->sessions as $session) {
                $lawyer = $session->lawyer;
                if (!$lawyer) continue;

                $lawyerId = $lawyer->id;
                if (!isset($lawyers[$lawyerId])) {
                    $lawyers[$lawyerId] = [
                        'lawyer_id' => $lawyer->id,
                        'lawyer_name' => $lawyer->user->name,
                        'salary' => $lawyer->salary,
                        'total_points' => 0,
                        'amount' => 0,
                        'sessions' => [],
                        'issue_title' => $issue->title,
                    ];
                }

                $points = LawyerPoint::where('session_id', $session->id)
                    ->where('lawyer_id', $lawyerId)->sum('points');

                $lawyers[$lawyerId]['total_points'] += $points;
                $lawyers[$lawyerId]['sessions'][] = [
                    'session_id' => $session->id,
                    'points' => $points,
                ];
            }

            $issueTotalPoints = LawyerPoint::whereIn('session_id', $issue->sessions->pluck('id'))->sum('points');
            $issueCost = $issue->total_cost;
            $issueLawyerPercent = $issue->lawyer_percentage;
            $lawyerAmountPool = ($issueLawyerPercent / 100) * $issueCost;

            foreach ($lawyers as &$lawyerData) {
                $shareRatio = $lawyerData['total_points'] / max(1, $issueTotalPoints);
                $earned = round($shareRatio * $lawyerAmountPool, 2);
                $lawyerData['amount'] = $earned + $lawyerData['salary'];
                $reportData[] = $lawyerData;
            }
        }

        return $reportData;
    }

public function storePayrollsFromReport(array $reportData): void
{
    foreach ($reportData as $entry) {

        $payableType = null;
        $payable = null;

        $lawyer = \App\Models\Lawyer::find($entry['lawyer_id'] ?? null);
        if ($lawyer) {
            $payableType = \App\Models\Lawyer::class;
            $payable = $lawyer;
        }
        if (!$payable && isset($entry['employee_id'])) {
            $employee = \App\Models\Employee::find($entry['employee_id']);
            if ($employee) {
                $payableType = \App\Models\Employee::class;
                $payable = $employee;
            }
        }
        if (!$payable || !$payableType) continue;

        $exists = \App\Models\Payroll::where('payable_id', $payable->id)
            ->where('payable_type', $payableType)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->exists();

        if (!$exists) {
            \App\Models\Payroll::create([
                'payment' => $entry['amount'],
                'confirm' => 0,
                'status' => 'pending',
                'payable_id' => $payable->id,
                'payable_type' => $payableType,
            ]);
        }
    }
}


    public function generateFinancialPdf(array $reportData): string
    {
        $totalPaid = array_sum(array_column($reportData, 'amount'));

        $pdf = PDF::loadView('reports.financial_report', [
            'entries' => $reportData,
            'total_paid' => $totalPaid,
            'date' => now()->format('Y-m-d H:i'),
        ]);

        $filename = 'report_' . time() . '.pdf';
        $path = 'storage/reports/' . $filename;

        \Storage::disk('public')->put('reports/' . $filename, $pdf->output());

        return $path;
    }

    public function generate()
    {
        // 1. احسب البيانات المالية من القضايا المغلقة
        $reportData = $this->calculateFinancialData();

        // 2. خزّن الرواتب في جدول payrolls
        $this->storePayrollsFromReport($reportData);

        // 3. أنشئ ملف PDF
        $pdfPath = $this->generateFinancialPdf($reportData);

        // 4. خزّن التقرير في جدول reports
        $report = Report::create([
            'type' => 'financial',
            'employee_id' => auth()->user()->employee->id ?? null,
            'file_path' => $pdfPath,
            'report_date' => now(),
            'total_amount' => array_sum(array_column($reportData, 'amount')),
        ]);

        return [
            'link' => asset($pdfPath),
            'report_id' => $report->id,
            'summary_total_paid' => $report->total_amount,
        ];
    }


    public function generateLawyerReport(int $lawyerId, string $from, string $to)
    {
        $sessions = $this->repo->getSessionsForLawyer($lawyerId, $from, $to);
        $rows = [];
        foreach ($sessions as $s) {
            $attended = $s->is_attend;
            $points = \App\Models\LawyerPoint::where('session_id', $s->id)
                        ->where('lawyer_id', $lawyerId)
                        ->sum('points');
            $futureAppointments = $s->appointments()
                                    ->where('date', '>', now())
                                    ->count();

            $rows[] = [
                'session_id'       => $s->id,
                'issue_number'     => $s->issue->issue_number,
                'issue_title'      => $s->issue->title,
                'issue_status'     => $s->issue->status,
                'session_type'     => optional($s->sessionType)->type ?? null,
                'outcome'          => $s->outcome,
                'attended'         => $attended ? 'Yes' : 'No',
                'points'           => $points,
                'future_appointments' => $futureAppointments,
            ];
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.lawyer_sessions_report', [
            'rows' => $rows,
            'from' => $from,
            'to'   => $to,
        ]);

        return $pdf->stream('lawyer_sessions_report.pdf');
    }


    public function generate_session_report($sessionId)
    {
        $user = auth()->user();
        $session = Sessionss::findOrFail($sessionId);

        if (!($user->role->name =='admin' || $user->lawyer?->id === $session->lawyer_id)) {
            return $this->errorResponse('غير مسموح لك بعرض هذا التقرير', 403);
        }

        return $this->repo->getSessionReportData($sessionId);

    }

    public function generate_issue_report($issueId)
    {
        return $this->repo->getIssueReportData($issueId);
    }

    public function generate_user_report($userId)
    {
        return $this->repo->getUserReportData($userId);
    }
}
