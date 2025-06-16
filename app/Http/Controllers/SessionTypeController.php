<?php

// app/Http/Controllers/SessionTypeController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionTypeRequest;
use App\Http\Requests\UpdateSessionTypeRequest;
use App\Services\SessionTypeService;
use App\Traits\ApiResponseTrait;

class SessionTypeController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(SessionTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successResponse($this->service->list(), 'All session types');
    }

    public function store(StoreSessionTypeRequest $request)
    {
        $created = $this->service->create($request->validated());
        return $this->successResponse($created, 'Session type created');
    }

    public function show($id)
    {
        $item = $this->service->get($id);
        return $this->successResponse($item, 'Session type details');
    }

    public function update(UpdateSessionTypeRequest $request, $id)
    {
        $updated = $this->service->update($id, $request->validated());
        return $this->successResponse($updated, 'Session type updated');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->successResponse(null, 'Session type deleted');
    }
}

