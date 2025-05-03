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
            ['name' => 'delete permission', 'path' => '/api/permissions', 'method' => 'DELETE'],
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
