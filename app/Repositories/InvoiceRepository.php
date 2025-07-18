<?php
namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Issue;

class InvoiceRepository
{
    public function create(array $data)
    {
        $issue = Issue::findOrFail($data['issue_id']);
        $paidSoFar = Invoice::where('issue_id', $issue->id)
                            ->where('status', 'paid') // حسب حالتك
                            ->sum('amount');
        $newTotal = $paidSoFar + $data['amount'];

        if ($newTotal > $issue->total_cost) {
            throw new \Exception('المبلغ الإجمالي للدفعات تجاوز تكلفة القضية.');
        }

        return Invoice::create($data);
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
}
