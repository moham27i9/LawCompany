<?php

namespace App\Repositories;

use App\Models\LawyerPoint;
use App\Models\Sessionss;

class LawyerPointRepository
{

public function storeAdminEvaluation(int $sessionId, int $lawyerId, array $data)
{
    return LawyerPoint::create([
        'session_id' => $sessionId,
        'lawyer_id' => $lawyerId,
        'points' => $data['points'],
        'note' => $data['note'] ?? 'تقييم إداري',
        'source' => 'admin',
    ]);
}

public function getPointsSummaryByLawyer($lawyerId)
{
    $points = LawyerPoint::where('lawyer_id', $lawyerId)->get();

    return [
        'total' => $points->sum('points'),
        'attendance' => $points->where('source', 'attendance')->sum('points'),
        'session_type' => $points->where('source', 'type')->sum('points'),
        'admin' => $points->where('source', 'admin')->sum('points'),
    ];
}




}
