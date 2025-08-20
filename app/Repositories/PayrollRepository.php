<?php
namespace App\Repositories;

use App\Models\Payroll;

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

}
