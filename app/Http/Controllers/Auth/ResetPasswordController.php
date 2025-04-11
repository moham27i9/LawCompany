<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Auth\ResetPasswordService;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    public function __construct(protected ResetPasswordService $resetPasswordService) {}

    public function __invoke(ResetPasswordRequest $request): JsonResponse
    {
        $this->resetPasswordService->handle($request->validated());

        return response()->json(['message' => 'تم إعادة تعيين كلمة المرور بنجاح.']);
    }
}
