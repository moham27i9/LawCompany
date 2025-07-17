<?php

use App\Http\Controllers\AttendDemandController;
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
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommonConsultationController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ConsultationRequestController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FurloughRequestController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\IssueCategoryController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueRequestController;
use App\Http\Controllers\LawyerPointController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequiredDocumentController;
use App\Http\Controllers\SessionAppointmentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SessionTypeController;
use App\Models\Consultation;
use App\Models\RequiredDocument;
use Illuminate\Support\Facades\Route;


// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', ForgotPasswordController::class);
Route::post('/reset-password', ResetPasswordController::class);
Route::post('/refresh', [AuthController::class, 'refreshToken']);

//  Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {


  Route::post('/messages', [ChatController::class, 'send']);
    Route::get('/messages/{userId}', [ChatController::class, 'fetch']);

    Route::post('/save-fcm-token', [AuthController::class, 'saveFcmToken']);
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


    Route::put('/attendDemand/{id}/resault', [AttendDemandController::class, 'updateResault']);

    Route::post('required-documents/{id}/upload', [RequiredDocumentController::class, 'updateFile']);

    Route::get('/hiring-requests/show/{id}', [HiringRequestController::class, 'show']);
    Route::get('/hiring-requests', [HiringRequestController::class, 'index']);
    Route::get('/lawyer/profile', [LawyerController::class, 'profile']);

    Route::apiResource('issue-requests', IssueRequestController::class)->only(['store','update','destroy']);
    Route::apiResource('issue-requests', IssueRequestController::class)->only(['index','show']);
    Route::get('/myissue-requests', [IssueRequestController::class, 'myRequests']);
    Route::put('/myissue-requests/{id}', [IssueRequestController::class, 'updateMyRequest']);

    Route::post('/issue-requests/{id}/lock', [IssueRequestController::class, 'startReview']);
    Route::post('/issue-requests/{id}/unlock', [IssueRequestController::class, 'endReview']);


    Route::get('/issues/track/{id}', [IssueController::class, 'track']);
    Route::put('/sessions/{id}', [SessionController::class, 'update']);
    Route::get('/sessions/issue/{issue_id}', [SessionController::class, 'showByIssueId']);

    Route::get('/issues/client/show', [IssueController::class, 'showClientIssue']);
    Route::get('/issues/lawyer/show', [IssueController::class, 'showLawyerIssues']);
    Route::get('/sessions/client/show', [IssueController::class, 'showClientSession']);

    Route::get('/issues/{issueId}/lawyers', [IssueController::class, 'getIssueLawyers']);

  Route::prefix('furloughs')->group(function () {
            Route::get('/', [FurloughRequestController::class, 'index']);
            Route::post('/', [FurloughRequestController::class, 'store']);
            Route::get('/{id}', [FurloughRequestController::class, 'show']);
            Route::put('/{id}', [FurloughRequestController::class, 'update']);
            Route::put('/status/{id}', [FurloughRequestController::class, 'updateStatus']);
            Route::delete('/{id}', [FurloughRequestController::class, 'destroy']);
        });


            Route::prefix('consultation_requests')->group(function () {
            Route::get('/', [ConsultationRequestController::class, 'index']);
            Route::get('/showMyRequests', [ConsultationRequestController::class, 'showMyRequests']);
            Route::post('/', [ConsultationRequestController::class, 'store']);
            Route::get('/{id}', [ConsultationRequestController::class, 'show']);
            Route::put('/{id}', [ConsultationRequestController::class, 'update']);
            Route::put('/status/{id}', [ConsultationRequestController::class, 'updateStatus']);
            Route::delete('/{id}', [ConsultationRequestController::class, 'destroy']);
        });
            Route::prefix('consultations')->group(function () {
            Route::get('/', [ConsultationController::class, 'index']);
            Route::post('/{id}', [ConsultationController::class, 'store']);
            Route::get('/{id}', [ConsultationController::class, 'show']);
            Route::put('/{id}', [ConsultationController::class, 'update']);
            Route::delete('/{id}', [ConsultationController::class, 'destroy']);
              Route::post('/{id}/lock', [ConsultationRequestController::class, 'startReview']);
              Route::post('/{id}/unlock', [ConsultationRequestController::class, 'endReview']);
        });


           // documents
        Route::get('/sessions/documents', [DocumentController::class, 'index']);
        Route::post('/sessions/{session_id}/documents', [DocumentController::class, 'store']);
        Route::get('/sessions/{session_id}/documents/{id}', [DocumentController::class, 'show']);
        Route::delete('/sessions/{session_id}/documents/{id}', [DocumentController::class, 'destroy']);
        Route::post('/sessions/{session_id}/documents/{id}', [DocumentController::class, 'update']);


        // required documents
          Route::prefix('required-documents')->group(function () {
            Route::get('/', [RequiredDocumentController::class, 'index']);              // عرض كل المستندات
            Route::post('/{issue_id}', [RequiredDocumentController::class, 'store']);            // إنشاء مستند جديد
            Route::get('{id}', [RequiredDocumentController::class, 'show']);           // عرض مستند معين
            Route::put('{id}', [RequiredDocumentController::class, 'update']);         // تحديث مستند
            Route::delete('{id}', [RequiredDocumentController::class, 'destroy']);     // حذف مستند
    });
    Route::get('/users/{userId}/permissions', [PermissionController::class, 'getUserPermissions']);
     Route::apiResource('/users', AuthController::class);

   Route::prefix('common-consultations')->group(function () {
        Route::get('/', [CommonConsultationController::class, 'index']);
        Route::get('/{id}', [CommonConsultationController::class, 'show']);
    });

    Route::put('/employees', [EmployeeController::class, 'update']);

    Route::middleware(['check.permission'])->group(function () {
        Route::put('/admin/issue-requests/{id}', [IssueRequestController::class, 'updateIssueRequestAdmin']);
        Route::post('/lawyers/create', [LawyerController::class, 'store']);

        //   employees managment
        Route::get('/employees', [EmployeeController::class,'index']);
        Route::delete('/employees/{employee}', [EmployeeController::class,'destroy']);
        Route::get('/employees/{employee}', [EmployeeController::class,'show']);
        Route::post('/employees/create/{id}', [EmployeeController::class, 'store']);


        Route::post('/hiring-requests', [HiringRequestController::class, 'store']);
        Route::delete('/users/delete/{id}', [AuthController::class, 'destroy']);
        Route::put('/users/change-role/{id}', [AuthController::class, 'changeRole']);
        Route::apiResource('routes', RouteController::class);
        Route::get('permissions', [PermissionController::class,'index']);
        Route::put('permissions/{id}', [PermissionController::class,'update']);
        Route::post('permissions/{id}', [PermissionController::class,'store']);
        Route::delete('permissions/{id}', [PermissionController::class,'destroy']);
        Route::post('roles/{roleId}/permissions/{permissionId}', [RolePermissionController::class, 'assign']);
        Route::get('roles/{roleId}/permissions', [RolePermissionController::class, 'getPermissions']);
        Route::post('roles/create', [RolePermissionController::class, 'store']);

        Route::post('/employees/create/{id}', [EmployeeController::class, 'store']);

             //dashboard and statistics
        Route::get('/issues/case-type-percentages', [IssueController::class, 'caseTypePercentages']);
        Route::get('/issues/open/count', [IssueController::class, 'countOpenCases']);
        Route::get('/clients/count', [AuthController::class, 'getClientCount']);
        Route::get('/sessions/this-month', [SessionController::class, 'sessionsThisMonth']);

        //admin & lawyer & intern

        Route::get('/consult/consultRequest/{id}/show', [ConsultationController::class, 'showCousultByRequestId']);
        Route::get('/issues', [IssueController::class, 'index']);
        Route::get('/issues/{id}', [IssueController::class, 'show']);
        //admin
        Route::post('/issues/{user_id}', [IssueController::class, 'store']);
        Route::put('/issues/{id}', [IssueController::class, 'update']);
        Route::put('/issues/{id}/status', [IssueController::class, 'updateStatus']);
        Route::delete('/issues/{id}', [IssueController::class, 'destroy']);
        Route::post('/issues/{id}/priority', [IssueController::class, 'updatePriority']);
        Route::post('/issues/{issueId}/assign', [IssueController::class, 'assignIssue']);


   Route::prefix('common-consultations')->group(function () {
        Route::post('/', [CommonConsultationController::class, 'store']);
        Route::put('/{id}', [CommonConsultationController::class, 'update']);
        Route::delete('/{id}', [CommonConsultationController::class, 'destroy']);
    });



        // sessions managment
        Route::get('/sessions', [SessionController::class, 'index']);
        Route::post('/sessions/{issue_id}', [SessionController::class, 'store']);
        Route::get('/sessions/{id}', [SessionController::class, 'show']);
        Route::delete('/sessions/{id}', [SessionController::class, 'destroy']);

        //calculate session amount
        Route::get('sessions/calculate/{issueId}', [SessionController::class, 'calculateAmounts']);


        // sessions appointments
        Route::prefix('appointments')->group(function () {
        Route::get('/session/{session_id}', [SessionAppointmentController::class, 'index']); //  جلب كل المواعيد لجلسة معينة
        Route::post('/{session_id}', [SessionAppointmentController::class, 'store']);
        Route::get('/{appointment_id}', [SessionAppointmentController::class, 'show']);
        Route::put('/{appointment_id}', [SessionAppointmentController::class, 'update']);
        Route::delete('/{appointment_id}', [SessionAppointmentController::class, 'destroy']);
         });

            Route::prefix('session-types')->group(function () {
            Route::get('/', [SessionTypeController::class, 'index']);
            Route::post('/', [SessionTypeController::class, 'store']);
            Route::get('/{id}', [SessionTypeController::class, 'show']);
            Route::put('/{id}', [SessionTypeController::class, 'update']);
            Route::delete('/{id}', [SessionTypeController::class, 'destroy']);
        });



            Route::post('{id}/upload-file', [RequiredDocumentController::class, 'updateFile']);

            // قبول أو رفض الملف من قبل الأدمن
            Route::post('{id}/moderate', [RequiredDocumentController::class, 'moderate']);
        });


        // attend demand
        Route::prefix('AttendDemand')->group(function () {
            Route::get('/issue/{issue_id}', [AttendDemandController::class, 'index']);
            Route::post('/{issue_id}', [AttendDemandController::class, 'store']);
            Route::get('/{attendDemand_id}', [AttendDemandController::class, 'show']);
            Route::put('/{attendDemand_id}', [AttendDemandController::class, 'update']);
            Route::delete('/{attendDemand_id}', [AttendDemandController::class, 'destroy']);
            Route::get('/', [AttendDemandController::class, 'showMyDemands']);
        });



        Route::middleware(['verified.lawyer'])->group(function () {

        Route::get('/lawyer/profile', [LawyerController::class, 'profile']);
        Route::get('/lawyer/issues', [LawyerController::class, 'showMyIssue']);
        Route::get('/lawyerIssues/{id}', [LawyerController::class, 'showLawyerIssues']);
        Route::get('/lawyer/sessions', [LawyerController::class, 'showMySession']);

        Route::delete('/lawyer/profile', [LawyerController::class, 'destroy']);

        Route::post('/lawyer/profile', [LawyerController::class, 'update']);

        Route::post('/lawyers/create', [LawyerController::class, 'store']);

        Route::put('/lawyer/sessions/{sessionId}/attend', [SessionController::class, 'markAttendance']);

        Route::post('/lawyer/session-report', [SessionController::class, 'generateLawyerReport']);


     });

     Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/unread', [NotificationController::class, 'unread']);
        Route::post('/mark-all', [NotificationController::class, 'markAll']);
        Route::post('/mark-one/{id}', [NotificationController::class, 'markOne']);
        Route::delete('/{id}', [NotificationController::class, 'destroy']);

        // lawyers managment
     });

     Route::get('hiring-requests/published', [HiringRequestController::class, 'getPublished']);
     Route::middleware(['hr_only'])->group(function () {

         Route::post('/employees/create/{id}', [EmployeeController::class, 'store']);
         Route::post('/lawyers/{lawyer_id}/salary', [LawyerController::class, 'setSalary']);
         Route::prefix('hiring-requests')->group(function () {
             Route::post('/', [HiringRequestController::class, 'store']);
             Route::get('/', [HiringRequestController::class, 'index']);
             Route::get('/{id}', [HiringRequestController::class, 'show']);
             Route::delete('/{id}', [HiringRequestController::class, 'delete']);

             Route::post('/status/{id}', [HiringRequestController::class, 'updateStatus']);

            });

        });


     //job-applications
     Route::prefix('job-applications')->group(function () {

        Route::post('/{id}', [JobApplicationController::class, 'store']);
        Route::get('/', [JobApplicationController::class, 'showMyApplications']);
        Route::get('/{id}', [JobApplicationController::class, 'show']);

        Route::post('/update-status/{id}', [JobApplicationController::class, 'updateStatus']);
        Route::get('/by-hiring/{hiringRequestId}', [JobApplicationController::class, 'getByHiringRequest']);


     });

     Route::prefix('interviews')->group(function () {
         Route::get('/application/{jobAppId}', [InterviewController::class, 'index']);
         Route::post('/{jobAppId}', [InterviewController::class, 'store']);
         Route::get('/{id}', [InterviewController::class, 'show']);
         Route::post('update/{id}', [InterviewController::class, 'update']);
         Route::delete('/{id}', [InterviewController::class, 'destroy']);
        });

        Route::post('/interviews/result/{id}', [InterviewController::class, 'updateResult']);
        Route::post('/admin/lawyer-points/evaluate/{session_id}/{lawyer_id}', [LawyerPointController::class, 'addAdminEvaluation']);

        Route::get('/lawyer/points-summary/{lawyerId}', [LawyerPointController::class, 'getPointsSummary']);


        Route::get('/issue-categories', [IssueCategoryController::class, 'index']);
        Route::get('/issues/by-category/{categoryId}', [IssueController::class, 'getByCategory']);

        Route::get('/get_MyRequired_Doc_Up/{issue_id}', [RequiredDocumentController::class, 'getClientDocuments']);

            Route::prefix('reports')->group(function () {

            Route::post('/', [ReportController::class, 'store']);
            Route::get('/', [ReportController::class, 'index']);
            Route::get('/{id}', [ReportController::class, 'show']);
            Route::delete('/{id}', [ReportController::class, 'destroy']);
        });
        Route::get('/consultations_lawyer', [LawyerController::class, 'show_myconsultations_lawyer']);


        Route::post('/reports/financial', [ReportController::class, 'generateFinancial']);
        Route::post('/lawyer/report',[ReportController::class, 'lawyerSessionsReport']);
        Route::get('/session-report/{session_id}', [ReportController::class, 'generate_session_report']);
        Route::get('/issue-report/{issueId}', [ReportController::class, 'generate_issue_report']);
        Route::get('/user-report/{userId}', [ReportController::class, 'generate_user_report']);

    });



