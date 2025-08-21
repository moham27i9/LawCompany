<?php

// app/Services/LegalBookService.php
namespace App\Services;

use App\Repositories\LegalBookRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\LegalBook;
use App\Repositories\LegalNewsRepository;

class LegalNewsService
{
    protected $repo;

    public function __construct(LegalNewsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getById($id)
    {
        return $this->repo->findById($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $new = $this->repo->findById($id);

        return $this->repo->update($new, $data);
    }

    public function delete($id)
    {
        $new = $this->repo->findById($id);
        return $this->repo->delete($new);
    }

    public function get_latest()
    {
        return $this->repo->get_latest();
    }

    public function save($userId, $newId)
    {
        return $this->repo->saveNew($userId, $newId);
    }

    public function unsave($userId, $newId)
    {
        return $this->repo->unsaveNew($userId, $newId);
    }

    public function getUserSavedNews($userId)
    {
        return $this->repo->getSavedNewsByUser($userId);
    }


}

