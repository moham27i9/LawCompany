<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Mail\ResetPasswordMail;
use App\Models\Role;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_can_request_password_reset()
    {
        Mail::fake();
        Log::shouldReceive('info'); // لمنع الطباعة الفعلية في اللوغ
        $roleId = Role::create(['name' => 'user'])->id;
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'role_id' => $roleId,
        ]);

        $response = $this->postJson('/api/forgot-password', [
            'email' => 'testuser@example.com',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'تم إرسال رسالة إعادة التعيين إلى بريدك الإلكتروني.',
        ]);

        $this->assertDatabaseHas('password_resets', [
            'email' => 'testuser@example.com',
        ]);

        Mail::assertSent(ResetPasswordMail::class);
    }

    public function test_user_can_reset_password_with_valid_token()
    {

        $roleId = Role::create(['name' => 'user'])->id;
        $user = User::factory()->create([
            'email' => 'resetme@example.com',
            'role_id' => $roleId,
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => 'resetme@example.com',
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $response = $this->postJson('/api/reset-password', [
            'email' => 'resetme@example.com',
            'token' => $token,
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'تم إعادة تعيين كلمة المرور بنجاح.',
        ]);

        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
        $this->assertDatabaseMissing('password_resets', [
            'email' => 'resetme@example.com',
        ]);
    }

    public function test_reset_fails_with_invalid_token()
    {

        $roleId = Role::create(['name' => 'user'])->id;
        $user = User::factory()->create([
            'email' => 'resetme@example.com',
            'role_id' => $roleId, 
        ]);

        $response = $this->postJson('/api/reset-password', [
            'email' => 'resetme@example.com',
            'token' => 'invalidtoken',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['token']);
    }
}
