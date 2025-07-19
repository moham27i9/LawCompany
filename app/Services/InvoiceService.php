<?php
namespace App\Services;

use App\Repositories\InvoiceRepository;

class InvoiceService
{
    protected $repo;

    public function __construct(InvoiceRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $data ,$request)
    {
        return $this->repo->create($data ,$request);
    }

    public function getAllForIssue($issueId)
    {
        return $this->repo->getByIssue($issueId);
    }

    public function getAllForUser($userId)
    {
        return $this->repo->getByUser($userId);
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}

