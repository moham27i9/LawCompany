<?php

// app/Services/LegalBookService.php
namespace App\Services;

use App\Repositories\LegalBookRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\LegalBook;

class LegalBookService
{
    protected $repo;

    public function __construct(LegalBookRepository $repo)
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
        if (isset($data['book'])) {
            $data['book'] = $data['book']->store('legal_books', 'public');
        }
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $book = $this->repo->findById($id);

        if (isset($data['book'])) {
            Storage::disk('public')->delete($book->book);
            $data['book'] = $data['book']->store('legal_books', 'public');
        }

        return $this->repo->update($book, $data);
    }

    public function delete($id)
    {
        $book = $this->repo->findById($id);
        Storage::disk('public')->delete($book->book);
        return $this->repo->delete($book);
    }

    public function save($userId, $bookId)
    {
        return $this->repo->saveBook($userId, $bookId);
    }

    public function unsave($userId, $bookId)
    {
        return $this->repo->unsaveBook($userId, $bookId);
    }

    public function getUserSavedBooks($userId)
    {
        return $this->repo->getSavedBooksByUser($userId);
    }


}

