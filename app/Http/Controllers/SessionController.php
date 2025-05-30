<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionOutcomeRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\Sessionss;
use App\Services\SessionService;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SessionController extends Controller
{
    use ApiResponseTrait;
  use AuthorizesRequests;
    protected $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function index()
    {
        $sessions = $this->sessionService->all();
        return $this->successResponse($sessions, 'Sessions retrieved successfully');
    }

    public function show($id)
    {
        $session = $this->sessionService->getById($id);
        if ($session)
            return $this->successResponse($session, 'Session retrieved successfully');
        return $this->errorResponse('Session not found', 404);
    }

    public function store(StoreSessionRequest $request, $issue_id)
    {
        $session = $this->sessionService->create($request->validated(), $issue_id);
        return $this->successResponse($session, 'Session created successfully');
    }

    public function update(UpdateSessionRequest $request, $id)
    {
         $sess = Sessionss::findOrFail($id);

        $this->authorize('update', $sess);
        $session = $this->sessionService->update($id, $request->validated());

        if ($session)
            return $this->successResponse($session, 'Session updated successfully');
        return $this->errorResponse('Failed to update session', 422);
    }

    public function destroy($id)
    {
        $deleted = $this->sessionService->delete($id);
        if ($deleted)
            return $this->successResponse(null, 'Session deleted successfully');
        return $this->errorResponse('Failed to delete session', 422);
    }


}
