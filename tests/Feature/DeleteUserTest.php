<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Database\Seeders\AdminSeeder;
use Database\Seeders\RoleSeeder;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_user_successfully()
    {
        $this->seed();
        // 1. نحصل على الـ Admin الحقيقي من seeder
        $admin = User::where('email', 'admin@gmail.com')->first();

        // 2. ننشئ مستخدم عادي ليتم حذفه
        $userToDelete = User::create([
            'name' => 'User To Delete',
            'email' => 'delete_me@example.com',
            'password' => bcrypt('user123'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);

        // 3. ننشئ توكن للإدمن
        $token = $admin->createToken('auth_token')->plainTextToken;

        // 4. نرسل طلب الحذف
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->deleteJson('/api/users/delete/' . $userToDelete->id);

        // 5. نتحقق من النتيجة
        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'message', 'code']);


        $this->assertDatabaseMissing('users', [
            'id' => $userToDelete->id,
        ]);
    }

    public function test_non_admin_cannot_delete_users()
    {
        $this->seed(RoleSeeder::class);
        // 1. ننشئ مستخدم عادي
        $regularUser = User::create([
            'name' => 'Normal Guy',
            'email' => 'user@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);

        // 2. ننشئ مستخدم ثاني (ضحية الحذف)
        $targetUser = User::create([
            'name' => 'Victim',
            'email' => 'victim@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);

        $token = $regularUser->createToken('auth_token')->plainTextToken;

        // 3. نرسل الطلب
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->deleteJson('/api/users/delete/' . $targetUser->id);

        // 4. نتحقق من الرد
        $response->assertStatus(403); // أو 401 حسب الـ middleware
    }
}
