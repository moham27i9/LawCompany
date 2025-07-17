<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppRoute;

class RoutesTableSeeder extends Seeder
{
    public function run(): void
    {
        $routes = [
            // Profile & Auth
            ['name' => 'create profile', 'path' => '/api/profiles/create', 'method' => 'POST'],
            ['name' => 'show profile', 'path' => '/api/profile', 'method' => 'GET'],
            ['name' => 'update profile', 'path' => '/api/profile', 'method' => 'PUT'],
            ['name' => 'delete profile', 'path' => '/api/profile', 'method' => 'DELETE'],
            ['name' => 'logout', 'path' => '/api/logout', 'method' => 'POST'],
            ['name' => 'forgot password', 'path' => '/api/forgot-password', 'method' => 'POST'],
            ['name' => 'reset password','path' => '/api/reset-password', 'method' => 'POST'],
            ['name' => 'show notifications', 'path' => '/api/notifications', 'method' => 'GET'],

            // Lawyers
            ['name' => 'show lawyer', 'path' => '/api/lawyers/{id}', 'method' => 'GET'],
            ['name' => 'show all lawyers ', 'path' => '/api/lawyers', 'method' => 'GET'],

            // Applicant
            ['name' => 'job applications', 'path' => '/api/job-applications/{id}', 'method' => 'POST'],

            // Admin - Users & Employees
            ['name' => 'show employees', 'path' => '/api/employees', 'method' => 'GET'],
            ['name' => 'add employee', 'path' => '/api/employees/create/{id}', 'method' => 'POST'],
            ['name' => 'show users', 'path' => '/api/users', 'method' => 'GET'],
            ['name' => 'change role', 'path' => '/api/users/change-role/{id}', 'method' => 'PUT'],
            ['name' => 'delete user', 'path' => '/api/users/delete/{id}', 'method' => 'DELETE'],

            // Admin - Permissions & Roles
            ['name' => 'show routes', 'path' => '/api/routes', 'method' => 'GET'],
            ['name' => 'add routes', 'path' => '/api/routes', 'method' => 'POST'],
            ['name' => 'update routes', 'path' => '/api/routes/{id}', 'method' => 'PUT'],
            ['name' => 'delete routes', 'path' => '/api/routes/{id}', 'method' => 'DELETE'],
            ['name' => 'show permissions', 'path' => '/api/permissions', 'method' => 'GET'],
            ['name' => 'add permission', 'path' => '/api/permissions/{id}', 'method' => 'POST'],
            ['name' => 'delete permission', 'path' => '/api/permissions/{id}', 'method' => 'DELETE'],
            ['name' => 'assign permission to role', 'path' => '/api/roles/{roleId}/permissions/{permissionId}', 'method' => 'POST'],
            ['name' => 'show permissions for role', 'path' => '/api/roles/{roleId}/permissions', 'method' => 'GET'],

            // Lawyer-specific
            ['name' => 'show profile as lawyer', 'path' => '/api/lawyer/profile', 'method' => 'GET'],//26
            ['name' => 'update lawyer profile ', 'path' => '/api/lawyer/profile', 'method' => 'PUT'],//27
            ['name' => 'add lawyer profile', 'path' => '/api/lawyers/create', 'method' => 'POST'],//28
            ['name' => 'show all permissions', 'path' => '/api/permissions', 'method' => 'GET'],//29
            ['name' => 'show all hiring requests', 'path' => '/api/hiring-requests', 'method' => 'GET'],
            ['name' => 'show hiring request', 'path' => '/api/hiring-requests/show/{id}', 'method' => 'GET'],
            ['name' => 'add hiring request', 'path' => '/api/hiring-requests', 'method' => 'POST'],//32
            //issues
            ['name' => 'show all issues', 'path' => '/api/issues', 'method' => 'GET'],//33
            ['name' => 'show issue', 'path' => '/api/issues/{id}', 'method' => 'GET'],//34
            ['name' => 'add issue', 'path' => '/api/issues/{user_id}', 'method' => 'POST'],//35
            ['name' => 'update issue', 'path' => '/api/issues/{id}', 'method' => 'PUT'],//36
            ['name' => 'delete issue', 'path' => '/api/issues/{id}', 'method' => 'DELETE'],//37
            ['name' => 'show all issue requests', 'path' => '/api/issue-requests', 'method' => 'GET'],//38
            ['name' => 'show issue request', 'path' => '/api/issue-requests/{issue_request}', 'method' => 'GET'],//39
            ['name' => 'update issue request', 'path' => '/api/admin/issue-requests/{id}', 'method' => 'PUT'],//40
            //sessions
            ['name' => 'show all sessions', 'path' => '/api/sessions', 'method' => 'GET'],//41
            ['name' => 'add session', 'path' => '/api/sessions/{issue_id}', 'method' => 'POST'],//42
            ['name' => 'show session', 'path' => '/api/sessions/{id}', 'method' => 'GET'],//43
            ['name' => 'update session', 'path' => '/api/sessions/{id}', 'method' => 'PUT'],//44
            ['name' => 'delete sessions', 'path' => '/api/sessions/{id}', 'method' => 'DELETE'],//45
            ['name' => 'add new role', 'path' => '/api/roles/create', 'method' => 'POST'],//46
            ['name' => 'update issue priority', 'path' => '/api/issues/{id}/priority', 'method' => 'POST'],//47
             ['name' => 'assign issue', 'path' => '/api/issues/{issueId}/assign', 'method' => 'POST'],//48            //appointments
            ['name' => 'create appointment','path' => '/api/appointments/{session_id}','method' => 'POST'],//49
            ['name' => 'show appointments','path' => '/api/appointments/session/{session_id}','method' => 'GET'],//50
            ['name' => 'show appointment','path' => '/api/appointments/{appointment_id}','method' => 'GET'],//51
            ['name' => 'update appointment','path' => '/api/appointments/{appointment_id}','method' => 'PUT',],//52
            ['name' => 'delete appointment','path' => '/api/appointments/{appointment_id}','method' => 'DELETE'],//53


            //AttendDemand
            ['name' => 'create AttendDemand','path' => '/api/AttendDemand/{issue_id}','method' => 'POST'],//54
            ['name' => 'show AttendDemands','path' => '/api/AttendDemand/issue/{issue_id}','method' => 'GET'],//55
            ['name' => 'show AttendDemand','path' => '/api/AttendDemand/{attendDemand_id}','method' => 'GET'],//56
            ['name' => 'update AttendDemand','path' => '/api/AttendDemand/{attendDemand_id}','method' => 'PUT'],//57
            ['name' => 'delete AttendDemand','path' => '/api/AttendDemand/{attendDemand_id}','method' => 'DELETE'],//58

            ['name' => 'show lawyer in issue', 'path' => '/api/issues/{issueId}/lawyers', 'method' => 'GET'],//59
            ['name' => 'update issue status', 'path' => '/api/issues/{id}/status', 'method' => 'PUT'],//60

            ['name' => 'show all session types', 'path' => '/api/session-types', 'method' => 'GET'],//61
            ['name' => 'show session type', 'path' => '/api/session-types/{id}', 'method' => 'GET'],//62
            ['name' => 'add session type', 'path' => '/api/session-types', 'method' => 'POST'],//63
            ['name' => 'update session type', 'path' => '/api/session-types/{id}', 'method' => 'PUT'],//64
            ['name' => 'delete session type', 'path' => '/api/session-types/{id}', 'method' => 'DELETE'],//65
            ['name' => 'sessions calculate amount', 'path' => '/api/sessions/calculate/{issueId}', 'method' => 'GET'],//66
            ['name' => 'show consult by consultRequestId', 'path' => '/api/consult/consultRequest/{id}/show', 'method' => 'GET'],//67
            ['name' => 'sessions this month', 'path' => '/api/sessions/this-month', 'method' => 'GET'],//68
            ['name' => 'clients count', 'path' => '/api/clients/count', 'method' => 'GET'],//69
            ['name' => 'open issues count', 'path' => '/api/issues/open/count', 'method' => 'GET'],//70
            ['name' => 'issues case-type-percentages', 'path' => '/api/issues/case-type-percentages', 'method' => 'GET'],//71
            ['name' => 'add common consultations', 'path' => '/api/common-consultations', 'method' => 'POST'],//72
            ['name' => 'update common consultations', 'path' => '/api/common-consultations/{id}', 'method' => 'PUT'],//73
            ['name' => 'delete common consultations', 'path' => '/api/common-consultations/{id}', 'method' => 'DELETE'],//74
            ['name' => 'update permission', 'path' => '/api/permissions/{id}', 'method' => 'PUT'],//75
             ['name' => 'show employee by id', 'path' => '/api/employees/{employee}', 'method' => 'GET'],//76
             ['name' => 'delete employee', 'path' => '/api/employees/{employee}', 'method' => 'DELETE'],//77
                        

        ];

        foreach ($routes as $route) {
            AppRoute::updateOrCreate(
                ['name' => $route['name']], // استخدم name كمفتاح فريد
                [
                    'path' => $route['path'],
                    'method' => $route['method']
                ]
            );
        }
    }
}
