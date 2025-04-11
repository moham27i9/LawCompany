<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//  Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {

    //  Profile & Logout
    Route::post('/profiles/create/', [ProfileController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

    
    Route::post('/forgot-password', ForgotPasswordController::class);
    Route::post('/reset-password', ResetPasswordController::class);
    


    //  Admin Only Routes
    Route::middleware('admin')->group(function () {

        //   employees managment 
        Route::apiResource('/employees', EmployeeController::class);
        Route::post('/employees/create/{id}', [EmployeeController::class, 'store']);
        Route::delete('/users/delete/{id}', [AuthController::class, 'destroy']);
        Route::apiResource('/users', AuthController::class);
        
        //   lawyers managment
        Route::apiResource('/lawyers', LawyerController::class);
        Route::post('/lawyers/create/{id}', [LawyerController::class, 'store']);
    });
});

