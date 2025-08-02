<?php
namespace App\Http\Controllers;

use App\Http\Requests\GenerateLawyerReportRequest;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionOutcomeRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\Sessionss;
use App\Services\SessionService;
use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

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

    public function showByIssueId($issue_id)
    {
        $session = $this->sessionService->getByIssueId($issue_id);
        if ($session)
            return $this->successResponse($session, 'Sessions retrieved successfully');
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

    public function sessionsThisMonth()
    {
        $session_month = $this->sessionService->sessionsThisMonth();
            return $this->successResponse($session_month, 'Session in this month retrieved successfully');

    }

      public function calculateAmounts($issueId)
    {
        $result = $this->sessionService->calculateSessionsPayment($issueId);

        return $this->successResponse($result, 'Payment per session calculated');
    }

      public function calculateLawyeramountIssue($issueId,$lawyerId)
    {
        $result = $this->sessionService->calculateLawyerShareForIssue($issueId,$lawyerId);

        return $this->successResponse($result, 'precentage and amount for this lawyer in issue calculated');
    }

        public function generateLawyerReport(GenerateLawyerReportRequest $request)
    {
        $lawyerId = auth()->user()->lawyer->id;
        $report = $this->sessionService->generateLawyerReport($lawyerId, $request->validated());

        return $this->successResponse($report, 'تم إنشاء التقرير بنجاح');
    }

    public function markAttendance($sessionId)
    {
        $session = $this->sessionService->markAttendance($sessionId);
        return $this->successResponse($session, 'تم تسجيل الحضور للجلسة وحساب النقاط بنجاح');
    }




}
