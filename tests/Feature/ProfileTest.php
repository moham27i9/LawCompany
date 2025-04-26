<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function createUserWithRole(): array
    {
        $role = Role::create(['name' => 'user']);
        $user = User::factory()->create(['role_id' => $role->id]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function test_user_can_create_profile()
    {
        ['token' => $token] = $this->createUserWithRole();

        $response = $this->withToken($token)->postJson('/api/profiles/create', [
            'phone' => '0988776655',
            'address' => 'Aleppo',
            'age' => 25,
            'scientificLevel' => 'Bachelor'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Profile created successfully',
        ]);
    }

    public function test_user_can_view_profile()
    {
        ['token' => $token] = $this->createUserWithRole();

       
        $this->withToken($token)->postJson('/api/profiles/create', [
            'phone' => '0988776655',
            'address' => 'Aleppo',
            'age' => 25,
            'scientificLevel' => 'Bachelor'
        ]);

        $response = $this->withToken($token)->getJson('/api/profile');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'profile retrieved successfully',
        ]);
    }

    public function test_user_can_update_profile()
    {
        ['token' => $token] = $this->createUserWithRole();

        $this->withToken($token)->postJson('/api/profiles/create', [
            'phone' => '0988776655',
            'address' => 'Aleppo',
            'age' => 25,
            'scientificLevel' => 'Bachelor'
        ]);

        $response = $this->withToken($token)->putJson('/api/profile', [
            'phone' => '0911223344',
            'address' => 'Damascus',
            'age' => 30,
            'scientificLevel' => 'Master'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Profile updated successfully',
        ]);
    }

    public function test_user_can_delete_profile()
    {
        ['token' => $token] = $this->createUserWithRole();

        $this->withToken($token)->postJson('/api/profiles/create', [
            'phone' => '0988776655',
            'address' => 'Aleppo',
            'age' => 25,
            'scientificLevel' => 'Bachelor'
        ]);

        $response = $this->withToken($token)->deleteJson('/api/profile');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Profile deleted successfully ',
        ]);
    }
}
