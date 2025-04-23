<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Profile & Auth
            ['name' => 'create_profile', 'app_route_id' => 1],
            ['name' => 'show_profile', 'app_route_id' => 2],
            ['name' => 'update_profile', 'app_route_id' => 3],
            ['name' => 'delete_profile', 'app_route_id' =>4],
            ['name' => 'logout', 'app_route_id' => 5],
            ['name' => 'forgot_password', 'app_route_id' => 6],
            ['name' => 'reset_password','app_route_id' => 7],
            ['name' => 'show_notifications', 'app_route_id' =>8],

            // Lawyers
            ['name' => 'show_lawyer', 'app_route_id' => 9],
            ['name' => 'show_all_lawyers ', 'app_route_id' => 10],

            // Applicant
            ['name' => 'job_applications', 'app_route_id' =>11],

            // Admin - Users & Employees
            ['name' => 'show_employees', 'app_route_id' => 12],
            ['name' => 'add_employee', 'app_route_id' =>13],
            ['name' => 'show_users', 'app_route_id' =>14],
            ['name' => 'change_role', 'app_route_id' => 15],
            ['name' => 'delete_user', 'app_route_id' => 16],

            // Admin - Permissions & Roles
            ['name' => 'show_routes', 'app_route_id' => 17],
            ['name' => 'add_routes', 'app_route_id' =>18],
            ['name' => 'update_routes', 'app_route_id' => 19],
            ['name' => 'delete_routes', 'app_route_id' => 20],
            ['name' => 'show_permissions', 'app_route_id' => 21],
            ['name' => 'add_permission', 'app_route_id' =>22],
            ['name' => 'delete_permission', 'app_route_id' =>23],
            ['name' => 'assign_permission_to_role', 'app_route_id' => 24],
            ['name' => 'show_permissions_for_role', 'app_route_id' => 25],

            // Lawyer-specific
            ['name' => 'show_profile_as_lawyer', 'app_route_id' => 26],
            ['name' => 'update_lawyer_profile ', 'app_route_id' => 27],
            ['name' => 'add_lawyer_profile', 'app_route_id' => 28],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [    'name' => $permission['name'], // استخدم name كمفتاح فريد
                    'app_route_id' => $permission['app_route_id'],
                ]
            );
        }
    }
}
