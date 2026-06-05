<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * DUPL-AUT-01: Pengujian Login Pengguna dengan Username dan Password benar
     * 
     * Buka halaman login, masukkan username (email) dan password pengguna yang valid, 
     * lalu klik tombol login.
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'role' => 'customer',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('landing'));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * DUPL-AUT-02: Pengujian Login Admin dengan Username dan Password benar
     * 
     * Buka halaman login, masukkan username (email) dan password admin yang valid, 
     * lalu klik tombol login.
     */
    public function test_admin_can_login_with_valid_credentials(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => $admin->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }
}
