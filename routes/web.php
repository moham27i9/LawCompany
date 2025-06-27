<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatViewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-mail', [AuthController::class, 'testMail']);


// عرض صفحة الدردشة
Route::middleware(['auth:sanctum'])->get('/chat/{receiver_id}', [ChatController::class, 'index'])->name('chat.index');

Route::middleware(['web-api', 'auth:sanctum'])->group(function () {
    Route::post('/messages', [ChatController::class, 'send']);
    Route::get('/messages/{userId}', [ChatController::class, 'fetch']);
});



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);