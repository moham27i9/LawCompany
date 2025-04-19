<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Role;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_successfully()
    {
        $this->seed(\Database\Seeders\RoleSeeder::class);
        $roleId = Role::where('name', 'user')->value('id');

        $response = $this->postJson('/api/register', [
            'name' => 'Rayyan Tester',
            'email' => 'rayyan@gmail.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role_id' => $roleId,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'message', 'code']);

        $this->assertDatabaseHas('users', [
            'email' => 'rayyan@gmail.com',
        ]);
    }

    public function test_registration_fails_if_required_fields_are_missing()
    {
        $this->seed(\Database\Seeders\RoleSeeder::class);

        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }
}
