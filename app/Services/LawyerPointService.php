<?php

namespace App\Services;

use App\Models\LawyerPoint;
use App\Models\Sessionss;
use App\Repositories\LawyerPointRepository;
use App\Repositories\LawyerRepository;
use App\Traits\ApiResponseTrait;

class LawyerPointService
{
    use ApiResponseTrait;
    protected $repo;

    public function __construct(LawyerPointRepository $repo)
    {
        $this->repo = $repo;
    }

public function addAdminEvaluation(int $sessionId, int $lawyerId, array $data)
{
    $session = Sessionss::findOrFail($sessionId);

    if ($session->lawyer_id !== $lawyerId) {
        abort(403, 'لا يمكنك تقييم محامي غير مسؤول عن هذه الجلسة.');
    }
    $existingEvaluation = LawyerPoint::where([
        'session_id' => $sessionId,
        'lawyer_id' => $lawyerId,
        'source' => 'admin',
        ])->first();

        if ($existingEvaluation) {
        abort(403, 'تم تقييم هذا المحامي لهذه الجلسة مسبقًا من قبل الإدارة');
    }

    return $this->repo->storeAdminEvaluation($sessionId, $lawyerId, $data);
}

public function getPointsSummary($lawyerId)
{
    return $this->repo->getPointsSummaryByLawyer($lawyerId);
}


}
