<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_profile_page_displays_admin_view(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin Rilla',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee('Profil Admin');
        $response->assertSee('Admin');
    }

    public function test_pegawai_profile_page_displays_employee_view(): void
    {
        $user = User::factory()->create([
            'name' => 'Pegawai Rilla',
            'email' => 'pegawai@example.com',
            'role' => 'pegawai',
        ]);

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee('Profil Pegawai');
        $response->assertSee('Pegawai');
    }
}
