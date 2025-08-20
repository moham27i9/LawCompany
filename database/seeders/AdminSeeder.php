<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Profile;
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
        User::updateOrCreate([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'admin')->value('id')
        ]);
        Profile::updateOrCreate([
            'user_id' => 1,
            'address' => '982 Main St',
            'phone' => '0933333333',
            'scientificLevel' => 'Bachelor of Law',
            'age' => rand(25, 50),
        ]);
        User::updateOrCreate([
            'name' => 'Lawyer1',
            'email' => 'lawyer1@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 5 // Lawyer role
        ]);
        Profile::updateOrCreate([
            'user_id' => 2,
            'address' => '789 Main St',
            'phone' => '0933333300',
            'scientificLevel' => 'Bachelor of Law',
            'age' => rand(25, 50),
        ]);
        User::updateOrCreate([
            'name' => 'HR',
            'email' => 'hr1@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 3 // HR role
        ]);
        Profile::updateOrCreate([
            'user_id' => 3,
            'address' => '309 Main St',
            'phone' => '0933333222',
            'scientificLevel' => 'Bachelor of Law',
            'age' => rand(25, 50),
        ]);
        User::updateOrCreate([
            'name' => 'acountant',
            'email' => 'acc1@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 4 // acountant role
        ]);

        Profile::updateOrCreate([
            'user_id' => 4,
            'address' => '292 Main St',
            'phone' => '0933333555',
            'scientificLevel' => 'Bachelor of Law',
            'age' => rand(25, 50),
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
