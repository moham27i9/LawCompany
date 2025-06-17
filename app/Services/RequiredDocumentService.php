<?php

namespace App\Services;

use App\Repositories\RequiredDocumentRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RequiredDocumentService
{
     use AuthorizesRequests;
    protected $repo;

    public function __construct(RequiredDocumentRepository $repo)
    {
        $this->repo = $repo;
    }

public function getAll()
{
    $documents = $this->repo->getAll();

    return $documents->map(function ($document) {
        return [
            'id' => $document->id,
            'issue_id' => $document->issue_id,
            'require_file_type' => $document->require_file_type,
            'status' => $document->status,
            'note' => $document->note,
            'file' => $document->file ? asset($document->file) : null,
        ];
    });
}


    public function create($data,$issue_id)
    {
        return $this->repo->create($data,$issue_id);
    }

    public function update($id, $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function find($id)
    {
        $document = $this->repo->findById($id);

        if ($document) {
            return [
                'id'         => $document->id,
                'issue_id' => $document->issue_id,
                'status' => $document->status,
                'note' => $document->note,
                'require_file_type' => $document->require_file_type,
                'file'       => $document->file ? asset('storage/' . $document->file) : null,
            ];
        }

        return null;
    }

    public function updateFile($id, $userId,$file)
    {
          $document = $this->repo->findById($id);
          $this->authorize('updateFile', $document);
        return $this->repo->updateFile($id, $userId, $file);
    }

}
