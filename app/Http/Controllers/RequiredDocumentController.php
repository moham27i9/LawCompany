<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequiredDocumentRequest;
use App\Http\Requests\UpdateFileRequiredDocumentRequest;
use App\Services\RequiredDocumentService;
use Illuminate\Http\Request;

class RequiredDocumentController extends Controller
{
    protected $service;

    public function __construct(RequiredDocumentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function store(RequiredDocumentRequest $request)
    {
        $doc = $this->service->create($request->validated());
        return response()->json(['message' => 'تم إنشاء المستند بنجاح', 'data' => $doc]);
    }

    public function show($id)
    {
        return response()->json($this->service->find($id));
    }

    public function update(RequiredDocumentRequest $request, $id)
    {
        $doc = $this->service->update($id, $request->validated());
        return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $doc]);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
    public function updateFile(UpdateFileRequiredDocumentRequest $request, $id)
    {

        $updated = $this->service->updateFile($id, auth()->user()->id, $request->validated());

        return response()->json(['message' => 'تم رفع الملف بنجاح وإعادة إرساله للمراجعة.', 'data' => $updated]);
    }

}

