<?php
namespace App\Services;

use App\Repositories\PayrollRepository;
use App\Repositories\SalaryAdjustmentRepository;
use Carbon\Carbon;

class PayrollService
{
    protected $payrollRepo, $adjustmentRepo;

    public function __construct(PayrollRepository $payrollRepo, SalaryAdjustmentRepository $adjustmentRepo)
    {
        $this->payrollRepo = $payrollRepo;
        $this->adjustmentRepo = $adjustmentRepo;
    }
public function generatePayroll($employable, $baseSalary)
{
    // 🔹 جلب آخر دفعة
    $lastPayment = $this->payrollRepo->lastPaymentDate(get_class($employable), $employable->id);

    $monthsToPay = 1; // الافتراضي شهر واحد

    if ($lastPayment) {
        // احسب كم شهر مرّ منذ آخر دفعة
        $monthsDiff = $lastPayment->diffInMonths(now());

        if ($monthsDiff < 1) {
            throw new \Exception("لا يمكن صرف دفعة جديدة قبل مرور شهر على الأقل من آخر دفعة (آخر دفعة: " 
                . $lastPayment->toDateString() . ")");
        }

        $monthsToPay = $monthsDiff; // عدد الأشهر التي لم تُدفع
    }

    // 🔹 جمع البدلات والخصومات (شاملة لجميع الشهور)
    $allowances = $employable->salaryAdjustments()
        ->where('type', 'allowance')
        ->where('processed', false)
        ->sum('amount');

    $deductions = $employable->salaryAdjustments()
        ->where('type', 'deduction')
        ->where('processed', false)
        ->sum('amount');

    // 🔹 الراتب الصافي للشهور المتراكمة
    $netPayment = ($baseSalary * $monthsToPay) + $allowances - $deductions;

    // 🔹 إنشاء سجل جديد في جدول الرواتب
    $payroll = $this->payrollRepo->create([
        'payment'      => $netPayment,
        'allowances'   => $allowances,
        'deductions'   => $deductions,
        'status'       => 'pending',
        'payable_id'   => $employable->id,
        'payable_type' => get_class($employable),
    ]);

        // 🔹 تحديث المستحقات لتصبح "processed"
    $employable->salaryAdjustments()
        ->where('processed', false)
        ->update(['processed' => true]);

        return $payroll;
}



    public function all()
    {
        return $this->payrollRepo->all();
    }

    public function find($id)
    {
        return $this->payrollRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->payrollRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->payrollRepo->delete($id);
    }
}
