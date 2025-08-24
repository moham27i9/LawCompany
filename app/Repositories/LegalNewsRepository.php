<?php

namespace App\Repositories;

use App\Models\LegalNews;
use App\Models\SavedLegalBook;
use App\Models\SavedLegalNews;
use Cache;

class LegalNewsRepository
{
    public function getAll()
    {
        return Cache::remember('legalNews_all', now()->addMinutes(15), function () {
        return LegalNews::all();
    });
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
        Cache::forget('legalNews_all');
        return LegalNews::create($data);
    }

    public function update(LegalNews $new, array $data)
    {
        $new->update($data);
        Cache::forget('legalNews_all');
        return $new;
    }

    public function delete(LegalNews $new)
    {
        Cache::forget('legalNews_all');
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
