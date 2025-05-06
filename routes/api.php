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
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueRequestController;
use Illuminate\Support\Facades\Route;


// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', ForgotPasswordController::class);
Route::post('/reset-password', ResetPasswordController::class);
Route::post('/refresh', [AuthController::class, 'refreshToken']);

//  Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {

    //  Profile & Logout
    Route::post('/profiles/create/', [ProfileController::class, 'store']);
    Route::get('/profile/{id}', [ProfileController::class, 'show']);
    Route::get('/myprofile', [ProfileController::class, 'showMyProfile']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/getRole', [AuthController::class, 'getRole']);

    Route::get('/lawyers/{id}', [LawyerController::class, 'show']);
    Route::get('/lawyers', [LawyerController::class, 'index']);

    Route::get('/hiring-requests/show/{id}', [HiringRequestController::class, 'show']);
    Route::get('/hiring-requests', [HiringRequestController::class, 'index']);
    Route::get('/lawyer/profile', [LawyerController::class, 'profile']);

    Route::apiResource('issue-requests', IssueRequestController::class)->only(['store','update','destroy']);
    Route::apiResource('issue-requests', IssueRequestController::class)->only(['index','show']);
    Route::post('/job-applications/{id}', [JobApplicationController::class, 'store']);


    Route::middleware(['check.permission'])->group(function () {
        Route::put('/admin/issue-requests/{id}', [IssueRequestController::class, 'updateIssueRequestAdmin']);
        Route::post('/lawyers/create', [LawyerController::class, 'store']);
        //   employees managment
        Route::apiResource('/employees', EmployeeController::class);
        Route::apiResource('/users', AuthController::class);
        Route::post('/hiring-requests', [HiringRequestController::class, 'store']);
        Route::delete('/users/delete/{id}', [AuthController::class, 'destroy']);
        Route::put('/users/change-role/{id}', [AuthController::class, 'changeRole']);
        Route::apiResource('routes', RouteController::class);
        Route::get('permissions', [PermissionController::class,'index']);
        Route::post('permissions/{id}', [PermissionController::class,'store']);
        Route::delete('permissions', [PermissionController::class,'destroy']);
        Route::post('roles/{roleId}/permissions/{permissionId}', [RolePermissionController::class, 'assign']);
        Route::get('roles/{roleId}/permissions', [RolePermissionController::class, 'getPermissions']);
        Route::post('/employees/create/{id}', [EmployeeController::class, 'store']);
         //admin & lawyer & intern
        Route::get('/issues', [IssueController::class, 'index']);
        Route::get('/issues/{id}', [IssueController::class, 'show']);
        //admin
        Route::post('/issues/{user_id}', [IssueController::class, 'store']);
        Route::put('/issues/{id}', [IssueController::class, 'update']);
        Route::delete('/issues/{id}', [IssueController::class, 'destroy']);
    });





    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/unread', [NotificationController::class, 'unread']);
        Route::post('/mark-all', [NotificationController::class, 'markAll']);
        Route::post('/mark-one/{id}', [NotificationController::class, 'markOne']);
        Route::delete('/{id}', [NotificationController::class, 'destroy']);

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
    });

});

