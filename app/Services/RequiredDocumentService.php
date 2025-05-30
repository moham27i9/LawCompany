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
        return $this->repo->getAll();
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
        return $this->repo->findById($id);
    }

    public function updateFile($id, $userId,$file)
    {
          $document = $this->repo->findById($id);
          $this->authorize('updateFile', $document);
        return $this->repo->updateFile($id, $userId, $file);
    }

}
