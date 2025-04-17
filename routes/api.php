<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\HiringRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\NotificationController;
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
    Route::get('/notifications', [NotificationController::class, 'getNotifications']);
    Route::get('/lawyers/{id}', [LawyerController::class, 'show']);
    Route::get('/lawyers', [LawyerController::class, 'index']);
    
    Route::middleware(['applicant_only'])->group(function () {
        Route::post('/job-applications/{id}', [JobApplicationController::class, 'store']);

        //
    });

    //  Admin Only Routes
    Route::middleware('admin')->group(function () {

        //   employees managment 
        Route::apiResource('/employees', EmployeeController::class);
        Route::delete('/users/delete/{id}', [AuthController::class, 'destroy']);
        Route::apiResource('/users', AuthController::class);
        Route::put('/users/change-role/{id}', [AuthController::class, 'changeRole']);
       
        // lawyers managment
    });
    
    Route::middleware(['hr_only'])->group(function () {
        
        Route::post('/employees/create/{id}', [EmployeeController::class, 'store']);
        Route::post('/hiring-requests', [HiringRequestController::class, 'store']);
    });
    Route::middleware(['justLawyers'])->group(function () {
        // Route::apiResource('/lawyers', LawyerController::class);

        Route::get('/lawyer/profile', [LawyerController::class, 'profile']);

        Route::put('/lawyer/profile', [LawyerController::class, 'update']);

        Route::post('/lawyers/create', [LawyerController::class, 'store']);
    });
    
});

