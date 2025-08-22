<?php
namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Issue;
use Carbon\Carbon;

class InvoiceRepository
{
    public function create(array $data , $request)
    {
        $issue = Issue::findOrFail($data['issue_id']);
        $paidSoFar = Invoice::where('issue_id', $issue->id)
                            ->where('status', 'paid')
                            ->sum('amount');
        $newTotal = $paidSoFar + $data['amount'];

        if ($newTotal > $issue->total_cost) {
            throw new \Exception('المبلغ الإجمالي للدفعات تجاوز تكلفة القضية.');
        }

        $user = auth()->user();

        if ($user) {
            $invoices= Invoice::create([
            'amount' => $request->amount,
            'status' => $request->status,
            'issue_id' => $data['issue_id'],
            'user_id' => $data['user_id'],
            'creator_id' => $user->id,
            'creator_type' =>$user->role->name,
             ]);
             return $invoices;

        }
        else {

            return response()->json(['message' => 'User not authenticated'], 401);
        }


    }

    public function getByIssue($issueId)
    {
        return Invoice::with('user')->where('issue_id', $issueId)->get();
    }

    public function getByUser($userId)
    {
        return Invoice::with('user')->where('user_id', $userId)->get();
    }


    public function getById($id)
    {
        return Invoice::with('issue')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $invoice = Invoice::with('issue')->findOrFail($id);
        $invoice->update($data);
        return $invoice;
    }

    public function delete($id)
    {
        $invoice = Invoice::findOrFail($id);
        return $invoice->delete();
    }

       public function monthlyRevenues()
    {
        return Invoice::selectRaw('MONTH(created_at) as month, SUM(amount) as total_revenue')
            ->where('status', 'paid') // نأخذ الإيرادات المؤكدة فقط
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($row) {
                return [
                    'month' => Carbon::create()->month($row->month)->format('M'),
                    'total_revenue' => $row->total_revenue,
                ];
            });
    }
}
