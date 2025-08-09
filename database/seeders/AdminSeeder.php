<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'admin')->value('id') 
        ]);
        User::create([
            'name' => 'Lawyer1',
            'email' => 'lawyer1@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 5 // Lawyer role
        ]);
        User::create([
            'name' => 'HR',
            'email' => 'hr1@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 3 // HR role
        ]);
        User::create([
            'name' => 'acountant',
            'email' => 'acc1@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 4 // acountant role
        ]);

                Employee::updateOrCreate(
            ['id' => 1], // لتفادي التكرار عند إعادة تشغيل seeder
            [
                'salary' => 500,
                'certificate' => 'app/sdd/ddlld/ldldl.pdf',
                'hire_date' => Carbon::now(),
                'user_id' => 3,
            ]
        );
                Employee::updateOrCreate(
            ['id' => 2], // لتفادي التكرار عند إعادة تشغيل seeder
            [
                'salary' => 1000,
                'certificate' => 'app/sdd/ddlld/acc.pdf',
                'hire_date' => Carbon::now(),
                'user_id' => 4,
            ]
        );
    }
}
