<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRouteRequest;
use App\Services\RouteService;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class RouteController extends Controller
{
    use ApiResponseTrait;
    protected $service;

    public function __construct(RouteService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store(CreateRouteRequest $request)
{
    $route = $this->service->create($request->validated());
    return $this->successResponse($route, 'Route created successfully');
}


    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'Route deleted successfully ');
    }
}

