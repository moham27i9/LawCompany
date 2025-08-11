<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\ApiResponseTrait;

class LegalAIController extends Controller
{
    use ApiResponseTrait;

    public function askAssistant(Request $request)
    {
        // التحقق أن السؤال موجود
        $request->validate([
            'question' => 'required|string|max:1000'
        ]);

        $question = $request->input('question');

        // زيادة وقت التنفيذ
        ini_set('max_execution_time', 180); // 3 دقائق

        try {
            // إرسال الطلب إلى FastAPI
            $response = Http::timeout(180)->post('http://127.0.0.1:8001/legal-assistant', [
                'question' => $question
            ]);

            if ($response->successful()) {
                $answer = $response->json()['answer'] ?? 'لم يتم العثور على إجابة.';
               return view('assistant.result', [
                            'question' => $question,
                            'answer' => $answer
                    ]);

            } else {
                return view('assistant.result', [
                    'answer' => '⚠️ حدث خطأ أثناء الاتصال بالمساعد القانوني.'
                ]);
            }
        } catch (\Exception $e) {
            return view('assistant.result', [
                'answer' => '❌ فشل الاتصال بالخادم: ' . $e->getMessage()
            ]);
        }
    }
}
