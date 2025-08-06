<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\LawyerService;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Http;


class LegalAIController extends Controller
{
    use ApiResponseTrait;

    protected $lawyerService;

    public function __construct(LawyerService $lawyerService)
    {
        $this->lawyerService = $lawyerService;
    }


    public function askAI(Request $request)
    {
        $query = $request->input('query');

    $response = Http::timeout(500)->post('http://127.0.0.1:8000/rag', [
        'query' => $query
    ]);


        if ($response->successful()) {
            return response()->json([
                'answer' => $response->json()['answer']
            ]);
        }

        return response()->json([
            'error' => 'Failed to get answer from AI server.'
        ], 500);
}


}

