<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengguna_yang_belum_login_diarahkan_ke_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_login_dengan_password_salah_gagal(): void
    {
        $user = User::factory()->create([
            'email' => 'pengguna@gmail.com',
            'password' => Hash::make('passwordbenar'),
        ]);

        $response = $this->post('/login', [
            'email' => 'pengguna@gmail.com',
            'password' => 'passwordsalah',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_dengan_password_benar_berhasil(): void
    {
        $user = User::factory()->create([
            'email' => 'pengguna@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'pengguna@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_logout_mengakhiri_sesi_pengguna(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
