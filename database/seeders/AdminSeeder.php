<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ إنشاء حساب الأدمن
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('12345678'),
                'role_id' => Role::where('name', 'admin')->value('id')
            ]
        );

        // ✅ إنشاء البروفايل الخاص بالأدمن
        Profile::updateOrCreate(
            ['user_id' => $admin->id],
            [
                'address' => '982 Main St',
                'phone' => '0933333333',
                'scientificLevel' => 'Bachelor of Law',
                'age' => rand(25, 50),
            ]
        );
    }
}
