<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LegalAIController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-mail', [AuthController::class, 'testMail']);



Route::get('/payment', function () {
    return view('payment'); // عرض نموذج الدفع
});

// Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');


Route::get('/payment', function () {
    return view('payment'); // عرض نموذج الدفع
});

// Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::get('/uml', '\BeyondCode\LaravelUml\Http\Controllers\DiagramController@index');

// عرض صفحة الدردشة
Route::middleware(['auth:sanctum'])->get('/chat/{receiver_id}', [ChatController::class, 'index'])->name('chat.index');

Route::middleware(['web-api', 'auth:sanctum'])->group(function () {
    Route::post('/messages', [ChatController::class, 'send']);
    Route::get('/messages/{userId}', [ChatController::class, 'fetch']);
});


Route::view('/chat', 'chat'); // افتحها بـ http://localhost:8000/chat

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);



Route::get('/assistant', function () {
    return view('assistant.form');
})->name('assistant.form');

Route::post('/assistant/ask', [LegalAIController::class, 'askAssistant'])->name('assistant.ask');
