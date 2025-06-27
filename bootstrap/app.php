<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // 🟩 ✅ ميدلوير خاص للطلبات القادمة من المتصفح فقط
        $middleware->group('web-api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        // ✅ باقي مجموعات الصلاحيات
        $middleware->group('admin', [App\Http\Middleware\AdminMiddleware::class]);
        $middleware->group('applicant_only', [App\Http\Middleware\EnsureUserIsApplicant::class]);
        $middleware->group('hr_only', [App\Http\Middleware\CheckRole::class . ':HR']);
        $middleware->group('verified.lawyer', [App\Http\Middleware\JustLawyers::class]);
        $middleware->group('verified.employee', [App\Http\Middleware\VerifiedEmployee::class]);
        $middleware->group('justClient', [App\Http\Middleware\JustClient::class]);
        $middleware->group('check.permission', [App\Http\Middleware\CheckPermission::class]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
