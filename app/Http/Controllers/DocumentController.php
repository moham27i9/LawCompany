<?php

// app/Http/Controllers/DocumentController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Services\DocumentService;
use App\Traits\ApiResponseTrait;

class DocumentController extends Controller
{
     use ApiResponseTrait;
    protected $service;

    public function __construct(DocumentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
          return $this->successResponse($this->service->getAll(), 'all documents retrieved');
             return $this->errorResponse('something wrong!!', 422);
    }

    public function store(StoreDocumentRequest $request,$session_id)
    {
        $document = $this->service->create($request->validated(),$session_id);
          return $this->successResponse($document, 'document added successfuly');
             return $this->errorResponse('something wrong!!', 422);
    }

    public function show($id)
    {
            return $this->successResponse($this->service->find($id), 'all documents retrieved');
             return $this->errorResponse('something wrong!!', 422);
        
    }

    public function update(UpdateDocumentRequest $request,$session_id,$docId)
    {
        $updated_doc =$this->service->update($request->validated(),$session_id,$docId);
            return $this->successResponse($updated_doc, 'document updated successfuly');
             return $this->errorResponse('something wrong!!', 422);
    }

    public function destroy($session_id,$docId)
    {
        $this->service->delete($session_id,$docId);
            return $this->successResponse(null, 'document deleted successfuly',204);
             return $this->errorResponse('something wrong!!', 422);
    }
}
