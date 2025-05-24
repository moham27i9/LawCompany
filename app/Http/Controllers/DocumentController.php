<?php

// app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Services\DocumentService;

class DocumentController extends Controller
{
    protected $service;

    public function __construct(DocumentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function store(StoreDocumentRequest $request,$session_id)
    {
        $document = $this->service->create($request->validated(),$session_id);
        return response()->json($document, 201);
    }

    public function show($id)
    {
        return response()->json($this->service->find($id));
    }

    public function update(UpdateDocumentRequest $request,$session_id,$docId)
    {
        return response()->json($this->service->update($request->validated(),$session_id,$docId));
    }

    public function destroy($session_id,$docId)
    {
        $this->service->delete($session_id,$docId);
        return response()->json(null, 204);
    }
}
