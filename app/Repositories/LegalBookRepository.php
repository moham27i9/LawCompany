<?php

namespace App\Repositories;

use App\Models\LegalBook;
use App\Models\SavedLegalBook;
use Cache;

class LegalBookRepository
{
    public function getAll()
    {
        return Cache::remember('legalBook_all', now()->addMinutes(15), function () {
        return LegalBook::all();
    });
    }

    public function findById($id)
    {
        return LegalBook::findOrFail($id);
    }

    public function create(array $data)
    {
        Cache::forget('legalBook_all');
        return LegalBook::create($data);
    }

    public function update(LegalBook $book, array $data)
    {
        $book->update($data);
        Cache::forget('legalBook_all');
        return $book;
    }

    public function delete(LegalBook $book)
    {
        Cache::forget('legalBook_all');
        return $book->delete();
    }

        public function saveBook($userId, $bookId)
    {
        return SavedLegalBook::firstOrCreate([
            'user_id' => $userId,
            'legalbook_id' => $bookId,
        ]);
    }

    public function unsaveBook($userId, $bookId)
    {
        return SavedLegalBook::where('user_id', $userId)
            ->where('legalbook_id', $bookId)
            ->delete();
    }

    public function getSavedBooksByUser($userId)
    {
        return \App\Models\SavedLegalBook::with('legalBook')
            ->where('user_id', $userId)
            ->get();

    }


}
