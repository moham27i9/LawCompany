<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Laravel\Sanctum\Sanctum;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AdminSeeder;

class ChangeUserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_change_admin_role()
    {
        $this->seed([
            RoleSeeder::class,
            AdminSeeder::class
        ]);

        $admin = User::where('email', 'admin@gmail.com')->first();
        Sanctum::actingAs($admin, ['*']); // عامل login كـ admin


        $response = $this->putJson("/api/users/change-role/{$admin->id}", [
            'role_name' => 'user',
        ]);

        $response->assertStatus(422); 
        $response->assertJson([
            'message' => 'لا يمكن تغيير دور الأدمن!',
        ]);
    }

    public function test_admin_can_change_user_role_successfully()
    {
        $this->seed([
            RoleSeeder::class,
            AdminSeeder::class
        ]);

        $admin = User::where('email', 'admin@gmail.com')->first();
        Sanctum::actingAs($admin, ['*']);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);

        $newRoleName = 'lawyer';

        $response = $this->putJson("/api/users/change-role/{$user->id}", [
            'role_name' => $newRoleName,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'تم تغيير الدور بنجاح',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role_id' => Role::where('name', $newRoleName)->value('id'),
        ]);
    }



    public function test_fails_when_role_does_not_exist()
    {
        $this->seed([
            RoleSeeder::class,
            AdminSeeder::class
        ]);

        $admin = User::where('email', 'admin@gmail.com')->first();
        Sanctum::actingAs($admin, ['*']);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);

        $response = $this->putJson("/api/users/change-role/{$user->id}", [
            'role_name' => 'invalid_role_name',
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'الدور غير موجود',
        ]);
    }

    public function test_same_role_returns_info()
    {
        $this->seed([
            RoleSeeder::class,
            AdminSeeder::class
        ]);

        $admin = User::where('email', 'admin@gmail.com')->first();
        Sanctum::actingAs($admin, ['*']);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'sameuser@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);

        $response = $this->putJson("/api/users/change-role/{$user->id}", [
            'role_name' => 'user',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'الدور الحالي هو نفسه',
        ]);
    }
}
