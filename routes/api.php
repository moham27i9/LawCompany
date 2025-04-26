<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\HiringRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', ForgotPasswordController::class);
Route::post('/reset-password', ResetPasswordController::class);

//  Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {
    
    //  Profile & Logout
    Route::post('/profiles/create/', [ProfileController::class, 'store']);
    Route::get('/profile/{id}', [ProfileController::class, 'show']);
    Route::get('/myprofile', [ProfileController::class, 'showMyProfile']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
<<<<<<< HEAD
    
    Route::get('/getRole', [AuthController::class, 'getRole']);
    
    Route::post('/forgot-password', ForgotPasswordController::class);
    Route::post('/reset-password', ResetPasswordController::class);
    Route::get('/lawyers/{id}', [LawyerController::class, 'show']);
    Route::get('/lawyers', [LawyerController::class, 'index']);
    
    Route::get('/hiring-requests/show/{id}', [HiringRequestController::class, 'show']);
    Route::get('/hiring-requests', [HiringRequestController::class, 'index']);
    Route::get('/lawyer/profile', [LawyerController::class, 'profile']);
    
    

    
=======


    Route::get('/notifications', [NotificationController::class, 'getNotifications']);
    Route::get('/lawyers/{id}', [LawyerController::class, 'show']);
    Route::get('/lawyers', [LawyerController::class, 'index']);

>>>>>>> B_Rayyan
    Route::middleware(['applicant_only'])->group(function () {
        Route::post('/job-applications/{id}', [JobApplicationController::class, 'store']);
    });

    //  Admin Only Routes
    // Route::middleware('admin')->group(function () {

<<<<<<< HEAD
        
    // });
    
    // Route::middleware(['hr_only'])->group(function () {
        
    //     // Route::post('/hiring-requests', [HiringRequestController::class, 'store']);
    // });
    // Route::middleware(['justLawyers'])->group(function () {
    //     // Route::apiResource('/lawyers', LawyerController::class);
            
    // });
    
    Route::middleware(['check.permission'])->group(function () {
        Route::put('/lawyer/profile', [LawyerController::class, 'update']);
        Route::post('/lawyers/create', [LawyerController::class, 'store']);
=======
        //   employees managment
>>>>>>> B_Rayyan
        Route::apiResource('/employees', EmployeeController::class);
        Route::apiResource('/users', AuthController::class);
        Route::post('/hiring-requests', [HiringRequestController::class, 'store']); 
        Route::delete('/users/delete/{id}', [AuthController::class, 'destroy']);
        Route::put('/users/change-role/{id}', [AuthController::class, 'changeRole']);
<<<<<<< HEAD
        Route::apiResource('routes', RouteController::class);
        Route::get('permissions', [PermissionController::class,'index']);
        Route::post('permissions/{id}', [PermissionController::class,'store']);
        Route::delete('permissions', [PermissionController::class,'destroy']);
        Route::post('roles/{roleId}/permissions/{permissionId}', [RolePermissionController::class, 'assign']);
        Route::get('roles/{roleId}/permissions', [RolePermissionController::class, 'getPermissions']);
        Route::post('/employees/create/{id}', [EmployeeController::class, 'store']);
    });
    
    
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/unread', [NotificationController::class, 'unread']);
        Route::post('/mark-all', [NotificationController::class, 'markAll']);
        Route::post('/mark-one/{id}', [NotificationController::class, 'markOne']);
        Route::delete('/{id}', [NotificationController::class, 'destroy']);
=======

        // lawyers managment
    });

    Route::middleware(['hr_only'])->group(function () {

        Route::post('/employees/create/{id}', [EmployeeController::class, 'store']);
        Route::post('/hiring-requests', [HiringRequestController::class, 'store']);
    });
    Route::middleware(['justLawyers'])->group(function () {
        // Route::apiResource('/lawyers', LawyerController::class);

        Route::get('/lawyer/profile', [LawyerController::class, 'profile']);

        Route::delete('/lawyer/profile', [LawyerController::class, 'destroy']);

        Route::put('/lawyer/profile', [LawyerController::class, 'update']);

        Route::post('/lawyers/create', [LawyerController::class, 'store']);
>>>>>>> B_Rayyan
    });

});

