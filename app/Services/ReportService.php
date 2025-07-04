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


        public function generate()
    {
        // 1. جلب القضايا المنتهية
        $closedIssues = Issue::with(['sessions.lawyer.user'])
            ->where('status', 'closed')
            ->get();

        $reportData = [];
        $totalPaid = 0;

        foreach ($closedIssues as $issue) {
            $lawyers = [];

            foreach ($issue->sessions as $session) {
                $lawyer = $session->lawyer;
                if (!$lawyer) continue;

                $lawyerId = $lawyer->id;
                if (!isset($lawyers[$lawyerId])) {
                    $lawyers[$lawyerId] = [
                        'lawyer_name' => $lawyer->user->name,
                        'salary' => $lawyer->salary,
                        'total_points' => 0,
                        'amount' => 0,
                        'sessions' => [],
                        'lawyer_id' => $lawyer->id,
                        'issue_title' => $issue->title,
                    ];
                }

                $sessionPoints = LawyerPoint::where('session_id', $session->id)
                    ->where('lawyer_id', $lawyerId)
                    ->sum('points');

                $lawyers[$lawyerId]['total_points'] += $sessionPoints;
                $lawyers[$lawyerId]['sessions'][] = [
                    'session_id' => $session->id,
                    'points' => $sessionPoints,
                ];
            }

            // مجموع النقاط للقضية كاملة
            $issueTotalPoints = LawyerPoint::whereIn('session_id', $issue->sessions->pluck('id'))->sum('points');
            $issueCost = $issue->total_cost;
            $issueLawyerPercent = $issue->lawyer_percentage;
            $lawyerAmountPool = ($issueLawyerPercent / 100) * $issueCost;

            foreach ($lawyers as &$lawyerData) {
                $shareRatio = $lawyerData['total_points'] / max(1, $issueTotalPoints);
                $earned = round($shareRatio * $lawyerAmountPool, 2);
                $lawyerData['amount'] = $earned + $lawyerData['salary'];
                $totalPaid += $lawyerData['amount'];
                $reportData[] = $lawyerData;
            }
        }

        // 2. إنشاء PDF


        $pdf = Pdf::loadView('reports.financial_report', [
            'entries' => $reportData,
            'total_paid' => $totalPaid,
            'date' => now()->format('Y-m-d H:i'),
        ]);


        $filename = 'report_' . time() . '.pdf';
        $path = 'storage/reports/' . $filename;
        Storage::disk('public')->put('reports/' . $filename, $pdf->output());

        // 3. حفظ في جدول التقارير
        $report = Report::create([
            'type' => 'financial',
            'employee_id' => auth()->user()->employee->id ?? null,
            'file_path' => 'storage/reports/' . $filename,
            'report_date' => now(), // 👈 هذا هو السطر الذي يجب أن تضيفه
        ]);

        return [
            'link' => asset($path),
            'report_id' => $report->id,
            'summary_total_paid' => $totalPaid,
        ];
    }
}
