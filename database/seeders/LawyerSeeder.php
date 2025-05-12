<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Lawyer;
use Illuminate\Support\Facades\Hash;

class LawyerSeeder extends Seeder
{
    public function run(): void
    {
        $lawyersData = [
            [
                'name' => 'Ahmed Ali',
                'email' => 'ahmed.lawyer@example.com',
                'license_number' => 'LAW-0093',
                'experience_years' => 7,
                'specialization' => 'Criminal Law',
                'salary' => 12000,
                'certificate' => 'uploads/certificates/law0093.pdf',
            ],
            [
                'name' => 'Mona Hassan',
                'email' => 'mona.hassan@example.com',
                'license_number' => 'LAW-0104',
                'experience_years' => 5,
                'specialization' => 'Family Law',
                'salary' => 10000,
                'certificate' => 'uploads/certificates/law0104.pdf',
            ],
            [
                'name' => 'Khaled Youssef',
                'email' => 'khaled.y@example.com',
                'license_number' => 'LAW-0071',
                'experience_years' => 9,
                'specialization' => 'Corporate Law',
                'salary' => 14000,
                'certificate' => 'uploads/certificates/law0071.pdf',
            ],
            [
                'name' => 'Salma Tarek',
                'email' => 'salma.t@example.com',
                'license_number' => 'LAW-0117',
                'experience_years' => 3,
                'specialization' => 'Intellectual Property',
                'salary' => 9000,
                'certificate' => 'uploads/certificates/law0117.pdf',
            ],
        ];

        foreach ($lawyersData as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('12345678'), // كلمة مرور افتراضية
                'role_id' => 5, // محامي
            ]);

            Lawyer::create([
                'user_id' => $user->id,
                'license_number' => $data['license_number'],
                'experience_years' => $data['experience_years'],
                'specialization' => $data['specialization'],
                'salary' => $data['salary'],
                'certificate' => $data['certificate'],
                'type' => 'lawyer',
            ]);
        }
    }
}
