<?php

// app/Services/DocumentService.php

namespace App\Services;

use App\Models\Document;
use App\Models\Sessionss;
use App\Repositories\DocumentRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DocumentService
{

 use AuthorizesRequests;
    protected $repository;

    public function __construct(DocumentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data,$session_id)
    {
           $session = Sessionss::findOrFail($session_id);
         
          $this->authorize('create', [Document::class, $session]);

           if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = 'session_doc_' . $session_id . '.' . $data['file']->getClientOriginalExtension();
            $filePath = $data['file']->storeAs('storage/documents', $filename, 'public');
            $data['file'] = $filePath;
        }
        return $this->repository->create($data,$session_id);
    }

    public function update(array $data,$session_id,$docId)
    {
          if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $filename = 'session_doc_' . $session_id . '.' . $data['file']->getClientOriginalExtension();
            $filePath = $data['file']->storeAs('storage/documents', $filename, 'public');
            $data['file'] = $filePath;
        }

        return $this->repository->update($data,$session_id,$docId);
    }

    public function delete($session_id,$docId)
    {
        return $this->repository->delete($session_id,$docId);
    }
}
