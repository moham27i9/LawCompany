<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Database\Seeders\RoleSeeder;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_valid_credentials()
    {

        $this->seed(RoleSeeder::class);

        $roleId = Role::where('name', 'user')->value('id');

       
        $user = User::create([
            'name' => 'Rayyan Tester',
            'email' => 'rayyan@example.com',
            'password' => bcrypt('secret123'),
            'role_id' => $roleId,
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'rayyan@example.com',
            'password' => 'secret123',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('message', 'Login successful');

        $this->assertTrue(
            $response->json('token') !== null || $response->json('data.token') !== null
        );
    }

    public function test_login_fails_with_invalid_credentials()
    {
        $this->seed(RoleSeeder::class);

        $roleId = Role::where('name', 'user')->value('id');

        $user = User::create([
            'name' => 'Rayyan Tester',
            'email' => 'rayyan@example.com',
            'password' => bcrypt('secret123'),
            'role_id' => $roleId,
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'rayyan@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Invalid credentials',
        ]);
    }
}
