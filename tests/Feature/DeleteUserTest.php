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

        $admin = User::where('email', 'admin@gmail.com')->first();


        $userToDelete = User::create([
            'name' => 'User To Delete',
            'email' => 'delete_me@example.com',
            'password' => bcrypt('user123'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);


        $token = $admin->createToken('auth_token')->plainTextToken;


        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->deleteJson('/api/users/delete/' . $userToDelete->id);


        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'message', 'code']);


        $this->assertDatabaseMissing('users', [
            'id' => $userToDelete->id,
        ]);
    }

    public function test_non_admin_cannot_delete_users()
    {
        $this->seed(RoleSeeder::class);

        $regularUser = User::create([
            'name' => 'Normal Guy',
            'email' => 'user@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);


        $targetUser = User::create([
            'name' => 'Victim',
            'email' => 'victim@example.com',
            'password' => bcrypt('12345678'),
            'role_id' => Role::where('name', 'user')->value('id'),
        ]);

        $token = $regularUser->createToken('auth_token')->plainTextToken;


        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->deleteJson('/api/users/delete/' . $targetUser->id);


        $response->assertStatus(403); 
    }
}
