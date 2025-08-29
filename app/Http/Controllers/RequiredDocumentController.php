<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequiredDocumentRequest;
use App\Http\Requests\UpdateFileRequiredDocumentRequest;
use App\Http\Requests\UpdateRequiredDoc_ClinetRequest;
use App\Services\RequiredDocumentService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class RequiredDocumentController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(RequiredDocumentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $documents = $this->service->getAll();
            return $this->successResponse($documents, 'تم استرجاع كل الوثائق');
        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ أثناء جلب الوثائق', 500, $e->getMessage());
        }
    }

    public function store(RequiredDocumentRequest $request, $issue_id)
    {
        try {
            $doc = $this->service->create($request->validated(), $issue_id);
            return $this->successResponse($doc, 'تم طلب إضافة مستند بنجاح');
        } catch (\Exception $e) {
            return $this->errorResponse('تعذر إنشاء المستند', 500, $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $doc = $this->service->find($id);
            return $this->successResponse($doc, 'تم جلب المستند بنجاح');
        } catch (\Exception $e) {
            return $this->errorResponse('تعذر عرض المستند', 404, $e->getMessage());
        }
    }

    public function update(UpdateRequiredDoc_ClinetRequest $request, $id)
    {
        try {
            $doc = $this->service->update($id, $request->validated());
            return $this->successResponse($doc, 'تم التحديث بنجاح');
        } catch (\Exception $e) {
            return $this->errorResponse('فشل التحديث', 422, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->successResponse(null, 'تم الحذف بنجاح');
        } catch (\Exception $e) {
            return $this->errorResponse('فشل الحذف', 422, $e->getMessage());
        }
    }

    public function updateFile(UpdateFileRequiredDocumentRequest $request, $id)
    {
        try {
            $updated = $this->service->updateFile($id, auth()->user()->id, $request->validated());
            return $this->successResponse($updated, 'تم رفع الملف بنجاح وإعادة إرساله للمراجعة');
        } catch (\Exception $e) {
            return $this->errorResponse('فشل رفع الملف', 422, $e->getMessage());
        }
    }

    public function getClientDocuments($issueId)
    {
        $documents = $this->service->getClientDocumentsByIssue($issueId);

        if ($documents->isEmpty()) {
            return $this->errorResponse('لا يوجد مستندات مطلوبة لك في هذه القضية أو أنك لا تملك هذه القضية', 404);
        }

        return $this->successResponse($documents, 'تم استرجاع المستندات بنجاح');
    }


    public function getByIssueId($issueId)
    {
        $documents = $this->service->getRequiredDocumentsByIssue($issueId);

        return response()->json([
            'success' => true,
            'data' => $documents
        ]);
    }

}
