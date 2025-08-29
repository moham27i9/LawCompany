<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Lawyer;
use App\Models\Profile;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class LawyerSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ باقي الحسابات (Lawyer1, HR, Accountant)
        $usersData = [

            [
                'name' => 'HR',
                'email' => 'hr1@gmail.com',
                'role_id' => 3, // HR role
                'address' => '309 Main St',
                'phone' => '0933333222',
            ],
            [
                'name' => 'Accountant',
                'email' => 'acc1@gmail.com',
                'role_id' => 4, // Accountant role
                'address' => '292 Main St',
                'phone' => '0933333555',
            ],
        ];

        foreach ($usersData as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('12345678'),
                    'role_id' => $data['role_id'],
                ]
            );

            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address' => $data['address'],
                    'phone' => $data['phone'],
                    'scientificLevel' => 'Bachelor of Law',
                    'age' => rand(25, 50),
                ]
            );

            // نضيف موظف إذا كان HR أو Accountant
            if (in_array($data['role_id'], [3, 4])) {
                Employee::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'salary' => $data['role_id'] == 3 ? 500 : 1000,
                        'certificate' => $data['role_id'] == 3
                            ? 'app/sdd/ddlld/ldldl.pdf'
                            : 'app/sdd/ddlld/acc.pdf',
                        'hire_date' => now(),
                    ]
                );
            }
        }

        // ✅ المحامين الإضافيين
        $lawyersData = [
            [
                'name' => 'Lawyer1',
                'email' => 'lawyer1@gmail.com',
                'license_number' => 'LAW-0099',
                'experience_years' => 3,
                'specialization' => 'Criminal Law',
                'salary' => 12000,
                'certificate' => 'uploads/certificates/law0099.pdf',
            ],

            [
                'name' => 'Ahmed Ali',
                'email' => 'ahmed@gmail.com',
                'license_number' => 'LAW-0093',
                'experience_years' => 7,
                'specialization' => 'Criminal Law',
                'salary' => 12000,
                'certificate' => 'uploads/certificates/law0093.pdf',
            ],
            [
                'name' => 'Mona Hassan',
                'email' => 'mona@gmail.com',
                'license_number' => 'LAW-0104',
                'experience_years' => 5,
                'specialization' => 'Family Law',
                'salary' => 10000,
                'certificate' => 'uploads/certificates/law0104.pdf',
            ],
            [
                'name' => 'Khaled Youssef',
                'email' => 'khaled@gmail.com',
                'license_number' => 'LAW-0071',
                'experience_years' => 9,
                'specialization' => 'Corporate Law',
                'salary' => 14000,
                'certificate' => 'uploads/certificates/law0071.pdf',
            ],
            [
                'name' => 'Salma Tarek',
                'email' => 'salma@gmail.com',
                'license_number' => 'LAW-0117',
                'experience_years' => 3,
                'specialization' => 'Intellectual Property',
                'salary' => 9000,
                'certificate' => 'uploads/certificates/law0117.pdf',
            ],
        ];

        foreach ($lawyersData as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('12345678'),
                    'role_id' => 5, // Lawyer role
                ]
            );

            $lawyer = Lawyer::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'license_number' => $data['license_number'],
                    'experience_years' => $data['experience_years'],
                    'specialization' => $data['specialization'],
                    'salary' => $data['salary'],
                    'certificate' => $data['certificate'],
                    'type' => 'lawyer',
                ]
            );

            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address' => '123 Main St',
                    'phone' => '0123456789',
                    'scientificLevel' => 'Bachelor of Law',
                    'age' => rand(25, 50),
                ]
            );

            Employee::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'salary' => $data['salary'],
                    'certificate' => $data['certificate'],
                    'hire_date' => now(),
                ]
            );
        }
    }
}
