<?php

namespace App\Services;

use App\Repositories\RouteRepository;

class RouteService
{
    protected $repo;

    public function __construct(RouteRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function create(array $data)
    {
        return $this->repo->create($data); 
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
