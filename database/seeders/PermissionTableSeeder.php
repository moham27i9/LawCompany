<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['name' => 'show_all_permissions', 'app_route_id' => 29],
            ['name' => 'show_all_hiring_requests', 'app_route_id' => 30],
            ['name' => 'show_hiring_request', 'app_route_id' => 31],
            ['name' => 'add_hiring_request', 'app_route_id' => 32],
            //issues
            ['name' => 'show_all_issues', 'app_route_id' => 33],
            ['name' => 'show_issue', 'app_route_id' => 34],
            ['name' => 'add_issue', 'app_route_id' => 35],
            ['name' => 'update_issue', 'app_route_id' => 36],
            ['name' => 'delete_issue', 'app_route_id' => 37],
            ['name' => 'show_all_issue_requests', 'app_route_id' => 38],
            ['name' => 'show_issue_request', 'app_route_id' => 39],
            ['name' => 'update_issue_request', 'app_route_id' => 40],
            //sessions
            ['name' => 'show_all_sessions', 'app_route_id' => 41],
            ['name' => 'add_session', 'app_route_id' => 42],
            ['name' => 'show_session', 'app_route_id' => 43],
            ['name' => 'update_session', 'app_route_id' => 44],
            ['name' => 'delete_sessions', 'app_route_id' => 45],
            ['name' => 'add_new_role', 'app_route_id' => 46],
            ['name' => 'update_issue_priority', 'app_route_id' => 47],
            ['name' => 'assign_issue', 'app_route_id' => 48],
            ['name' => 'show_lawyers_in_issue', 'app_route_id' => 49],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [    'name' => $permission['name'], // استخدم name كمفتاح فريد
                    'app_route_id' => $permission['app_route_id'],
                ]
            );
        }

        $admin_permissions =[
            [ 'permission_id' => 9],
            [ 'permission_id' => 10],
            [ 'permission_id' => 12],
            [ 'permission_id' => 13],
            [ 'permission_id' => 14],
            [ 'permission_id' => 15],
            [ 'permission_id' => 16],
            [ 'permission_id' => 17],
            ['permission_id' =>18],
            ['permission_id' => 19],
            ['permission_id' => 20],
            ['permission_id' => 21],
            ['permission_id' =>22],
            ['permission_id' =>23],
            ['permission_id' => 24],
            ['permission_id' => 25],
            ['permission_id' => 29],
            ['permission_id' => 33],
            ['permission_id' => 34],
            ['permission_id' => 35],
            ['permission_id' => 36],
            ['permission_id' => 37],
            ['permission_id' => 38],
            ['permission_id' => 39],
            ['permission_id' => 40],
            ['permission_id' => 41],
            ['permission_id' => 42],
            ['permission_id' => 43],
            ['permission_id' => 44],
            ['permission_id' => 45],
            ['permission_id' => 46],
            ['permission_id' => 47],
            ['permission_id' => 48],
            ['permission_id' => 49],

        ];
        $hr_permissions =[
            [ 'permission_id' => 32],];

        $lawyer_permissions =[
            [ 'permission_id' => 26],
            [ 'permission_id' => 27],
            [ 'permission_id' => 28],
            ['permission_id' => 33],
            ['permission_id' => 34],

        ];
        $intern_permissions =[
            [ 'permission_id' => 26],
            [ 'permission_id' => 27],
            [ 'permission_id' => 28],
            ['permission_id' => 33],
            ['permission_id' => 34],

        ];

        foreach ($admin_permissions as $admin_permission) {

            DB::table('role_permissions')->insert([
                'role_id'=> 1,
                'permission_id'=> $admin_permission['permission_id'] ,
                ]);
        }
        foreach ($hr_permissions as $hr_permission) {

            DB::table('role_permissions')->insert([
                'role_id'=> 3,
                'permission_id'=> $hr_permission['permission_id'] ,
                ]);
        }
        foreach ($lawyer_permissions as $lawyer_permission) {

            DB::table('role_permissions')->insert([
                'role_id'=> 5,
                'permission_id'=> $lawyer_permission['permission_id'] ,
                ]);
        }
        foreach ($intern_permissions as $intern_permission) {

            DB::table('role_permissions')->insert([
                'role_id'=> 6,
                'permission_id'=> $intern_permission['permission_id'] ,
                ]);
        }

    }


}
