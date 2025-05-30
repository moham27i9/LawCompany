<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-mail', [AuthController::class, 'testMail']);

use App\Http\Controllers\PaymentController;

Route::get('/payment', function () {
    return view('payment'); // عرض نموذج الدفع
});

Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

