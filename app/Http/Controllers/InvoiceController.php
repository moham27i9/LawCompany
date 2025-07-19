<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoiceRequest;
use App\Services\InvoiceService;
use App\Traits\ApiResponseTrait;

class InvoiceController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(InvoiceService $service)
    {
        $this->service = $service;
    }

    public function store(CreateInvoiceRequest $request, $issueId, $userId)
    {
        $data = $request->validated();
        $data['issue_id'] = $issueId;
        $data['user_id'] = $userId;
        $invoice = $this->service->create($data ,$request);
        return $this->successResponse($invoice, 'تم إنشاء الفاتورة بنجاح');
    }

    public function indexByUser($userId)
    {
        $invoices = $this->service->getAllForUser($userId);
        return $this->successResponse($invoices, 'تم استرجاع الفواتير بنجاح');
    }

    public function indexByIssue($issueId)
    {
        $invoices = $this->service->getAllForIssue($issueId);
        return $this->successResponse($invoices, 'تم استرجاع الفواتير بنجاح');
    }

    public function show($id)
    {
        $invoice = $this->service->getById($id);
        return $this->successResponse($invoice, 'تفاصيل الفاتورة');
    }

    public function update(CreateInvoiceRequest $request, $id)
    {
        $invoice = $this->service->update($id, $request->validated());
        return $this->successResponse($invoice, 'تم تعديل الفاتورة');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'تم حذف الفاتورة');
    }
}
