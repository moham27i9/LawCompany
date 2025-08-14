<?php

namespace App\Repositories;

use App\Models\LegalNews;
use App\Models\SavedLegalBook;
use App\Models\SavedLegalNews;

class LegalNewsRepository
{
    public function getAll()
    {
        return LegalNews::all();
    }
    public function get_latest()
    {
         return LegalNews::latest()->take(10)->get();
    }

    public function findById($id)
    {
        return LegalNews::findOrFail($id);
    }

    public function create(array $data)
    {
        return LegalNews::create($data);
    }

    public function update(LegalNews $new, array $data)
    {
        $new->update($data);
        return $new;
    }

    public function delete(LegalNews $new)
    {
        return $new->delete();
    }

        public function saveNew($userId, $newId)
    {
        return SavedLegalNews::firstOrCreate([
            'user_id' => $userId,
            'legalNews_id' => $newId,
        ]);
    }

    public function unsaveNew($userId, $newId)
    {
        return SavedLegalNews::where('user_id', $userId)
            ->where('legalNews_id', $newId)
            ->delete();
    }

    public function getSavedNewsByUser($userId)
    {
        return \App\Models\SavedLegalNews::with('legalNew')
            ->where('user_id', $userId)
            ->get();

    }


}
