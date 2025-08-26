<?php
namespace App\Repositories;

use App\Models\Payroll;
use Carbon\Carbon;
use DB;

class PayrollRepository
{
    public function all()
    {
        return Payroll::with('payable')->get();
    }

    public function find($id)
    {
        return Payroll::with('payable')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Payroll::create($data);
    }

    public function update($id, array $data)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->update($data);
        return $payroll;
    }

    public function delete($id)
    {
        return Payroll::destroy($id);
    }

  public function lastPaymentDate($payableType, $payableId)
{
    $last = Payroll::where('payable_type', $payableType)
        ->where('payable_id', $payableId)
        ->orderBy('created_at', 'desc')
        ->first();

    return $last?->created_at;
}

public function getMonthlyCosts()
{
    // نأتي بالبيانات من قاعدة البيانات
    $costs = DB::table('expenses')
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total_cost')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('total_cost', 'month'); // نخزنها في مصفوفة month => total_cost

    // ننشئ استجابة كاملة لجميع الأشهر 1 → 12
    $months = collect(range(1, 12))->map(function ($month) use ($costs) {
        return [
            'month' => Carbon::create()->month($month)->format('M'),
            'total_cost' => $costs[$month] ?? 0, // إذا لا يوجد بيانات الشهر يرجع 0
        ];
    });

    return $months;
}


}
