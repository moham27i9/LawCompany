<?php

namespace App\Repositories;

use App\Models\AppRoute;

class RouteRepository
{
    public function getAll()
    {
        return AppRoute::all();
    }

    public function create(array $data)
    {
        return AppRoute::create($data);
    }

    public function delete($id)
    {
        return AppRoute::findOrFail($id)->delete();
    }
}
