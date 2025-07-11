<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\LawyerPoint;
use App\Models\Report;
use App\Repositories\ReportRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Storage;


class ReportService
{
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
            $employee = \App\Models\Lawyer::find($entry['lawyer_id'])->employee ?? null;
            if (!$employee) continue;

            // تحقق من عدم التكرار
            $exists = \App\Models\Payroll::where('employee_id', $employee->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->exists();

            if (!$exists) {
                \App\Models\Payroll::create([
                    'employee_id' => $employee->id,
                    'payment' => $entry['amount'],
                    'confirm' => 0,
                    'status' => 'pending',
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

}
