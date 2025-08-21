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
            //appointments
            ['name' => 'create_appointment', 'app_route_id' => 49],
            ['name' => 'show_appointments', 'app_route_id' => 50],
            ['name' => 'show_appointment', 'app_route_id' => 51],
            ['name' => 'update_appointment', 'app_route_id' => 52],
            ['name' => 'delete_appointment', 'app_route_id' => 53],
            //AttendDemand
            ['name' => 'create_AttendDemand', 'app_route_id' => 54],
            ['name' => 'show_AttendDemands', 'app_route_id' => 55],
            ['name' => 'show_AttendDemand', 'app_route_id' => 56],
            ['name' => 'update_AttendDemand', 'app_route_id' => 57],
            ['name' => 'delete_AttendDemand', 'app_route_id' => 58],
            ['name' => 'show_lawyers_in_issue', 'app_route_id' => 59],
            ['name' => 'update_issue_status', 'app_route_id' => 60],
            ['name' => 'show_all_session_types', 'app_route_id' => 61],
            ['name' => 'show_session_type', 'app_route_id' => 62],
            ['name' => 'add_session_type', 'app_route_id' => 63],
            ['name' => 'update_session_type', 'app_route_id' => 64],
            ['name' => 'delete_session_type', 'app_route_id' => 65],
            ['name' => 'sessions_calculate_amount', 'app_route_id' => 66],
            ['name' => 'show_consult_by_consultRequestId', 'app_route_id' => 67],
            ['name' => 'sessions_this_month', 'app_route_id' => 68],
            ['name' => 'clients_count', 'app_route_id' => 69],
            ['name' => 'open_issues_count', 'app_route_id' => 70],
            ['name' => 'issues_case_type_percentages', 'app_route_id' => 71],
            ['name' => 'add_common_consultations', 'app_route_id' => 72],
            ['name' => 'update_common_consultations', 'app_route_id' => 73],
            ['name' => 'delete_common_consultations', 'app_route_id' => 74],

    
            ['name' => 'update_permission', 'app_route_id' => 75],
            ['name' => 'show_employee_by_id', 'app_route_id' => 76],
            ['name' => 'delete_employee', 'app_route_id' => 77],
            ['name' => 'archive_issue', 'app_route_id' => 78],
            ['name' => 'unarchive_issue', 'app_route_id' => 79],
            ['name' => 'show_lawyer_issues', 'app_route_id' => 80],
            ['name' => 'show_Archived_issues', 'app_route_id' => 81],
            ['name' => 'show_selected_archived_issue', 'app_route_id' => 82],
            ['name' => 'show_amount_and_precentage_for_lawyer_in_issue', 'app_route_id' => 83],
            ['name' => 'show_all_roles', 'app_route_id' => 84],
            ['name' => 'DELETE_ROLE', 'app_route_id' => 85],
            ['name' => 'SHOW_ROLE', 'app_route_id' => 86],
     
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
            ['permission_id' => 50],
            ['permission_id' => 51],
            ['permission_id' => 52],
            ['permission_id' => 53],
            ['permission_id' => 54],
            ['permission_id' => 55],
            ['permission_id' => 56],
            ['permission_id' => 57],
            ['permission_id' => 58],
            ['permission_id' => 59],
            ['permission_id' => 60],
            ['permission_id' => 61],
            ['permission_id' => 62],
            ['permission_id' => 63],
            ['permission_id' => 64],
            ['permission_id' => 65],
            ['permission_id' => 66],
            ['permission_id' => 67],
            ['permission_id' => 68],
            ['permission_id' => 69],
            ['permission_id' => 70],
            ['permission_id' => 71],
            ['permission_id' => 72],
            ['permission_id' => 73],
            ['permission_id' => 74],
            ['permission_id' => 75],
            ['permission_id' => 76],
            ['permission_id' => 77],
            ['permission_id' => 78],
            ['permission_id' => 79],
            ['permission_id' => 80],
            ['permission_id' => 81],
            ['permission_id' => 82],
            ['permission_id' => 83],
            ['permission_id' => 84],
            ['permission_id' => 84],
            ['permission_id' => 85],
            ['permission_id' => 86],


        ];
        $hr_permissions =[
            [ 'permission_id' => 12],
            [ 'permission_id' => 32],
             ['permission_id' => 61],
            ['permission_id' => 62],
            ['permission_id' => 69],
            ['permission_id' => 76],
            ['permission_id' => 77],
             ['permission_id' => 80],
        
        ];

        $lawyer_permissions =[
            [ 'permission_id' => 26],
            [ 'permission_id' => 27],
            [ 'permission_id' => 28],
            ['permission_id' => 33],
            ['permission_id' => 34],
            ['permission_id' => 49],
            ['permission_id' => 50],
            ['permission_id' => 51],
            ['permission_id' => 52],
            ['permission_id' => 53],
            ['permission_id' => 54],
            ['permission_id' => 55],
            ['permission_id' => 56],
            ['permission_id' => 57],
            ['permission_id' => 58],
             ['permission_id' => 61],
            ['permission_id' => 62],
             ['permission_id' => 67],
             ['permission_id' => 81],
            ['permission_id' => 82],
        ];
        $intern_permissions =[
            [ 'permission_id' => 26],
            [ 'permission_id' => 27],
            [ 'permission_id' => 28],
            ['permission_id' => 33],
            ['permission_id' => 34],
             ['permission_id' => 49],
            ['permission_id' => 50],
            ['permission_id' => 51],
            ['permission_id' => 52],
            ['permission_id' => 53],
            ['permission_id' => 54],
            ['permission_id' => 55],
            ['permission_id' => 56],
            ['permission_id' => 57],
            ['permission_id' => 58],
            ['permission_id' => 61],
            ['permission_id' => 62],
             ['permission_id' => 67],
            ['permission_id' => 81],
            ['permission_id' => 82],

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
