<?php
// app/Repositories/SessionTypeRepository.php

namespace App\Repositories;

use App\Models\SessionType;

class SessionTypeRepository
{
    public function getAll()
    {
        return SessionType::all();
    }

    public function find($id)
    {
        return SessionType::findOrFail($id);
    }

    public function create(array $data)
    {
        return SessionType::create($data);
    }

    public function update($id, array $data)
    {
        $sessionType = $this->find($id);
        $sessionType->update($data);
        return $sessionType;
    }

    public function delete($id)
    {
        $sessionType = $this->find($id);
        return $sessionType->delete();
    }
}
