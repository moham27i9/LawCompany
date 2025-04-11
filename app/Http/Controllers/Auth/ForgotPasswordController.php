<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Services\Auth\ForgotPasswordService;
use Illuminate\Http\JsonResponse;

class ForgotPasswordController extends Controller
{
    public function __construct(protected ForgotPasswordService $forgotPasswordService) {}

    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        $this->forgotPasswordService->handle($request->validated());

        return response()->json(['message' => 'تم إرسال رسالة إعادة التعيين إلى بريدك الإلكتروني.']);
    }
}

