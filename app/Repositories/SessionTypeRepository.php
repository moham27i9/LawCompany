<?php
// app/Repositories/SessionTypeRepository.php

namespace App\Repositories;

use App\Models\SessionType;
use Cache;

class SessionTypeRepository
{
    public function getAll()
    {
            return Cache::remember('sessions_type_all', now()->addMinutes(720), function () {
                return SessionType::all();
    });
    }

    public function find($id)
    {
        return SessionType::findOrFail($id);
    }

    public function create(array $data)
    {
        Cache::forget('sessions_type_all');
        return SessionType::create($data);
    }

    public function update($id, array $data)
    {
        $sessionType = $this->find($id);
        $sessionType->update($data);
        Cache::forget('sessions_type_all');
        return $sessionType;
    }

    public function delete($id)
    {
        $sessionType = $this->find($id);
        Cache::forget('sessions_type_all');
        return $sessionType->delete();
    }
}
