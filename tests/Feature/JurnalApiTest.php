<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Jurnal;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JurnalApiTest extends TestCase
{
    use RefreshDatabase;

    // Test 1: Berhasil Login & Mendapatkan Token
    public function test_user_can_login_and_get_token()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token']);
    }

    // Test 2: Gagal Login dengan Password Salah
    public function test_user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'salahpassword'
        ]);

        $response->assertStatus(401);
    }

    // Test 3: Akses Endpoint Jurnal Tanpa Token Ditolak (401)
    public function test_unauthenticated_user_cannot_access_jurnals()
    {
        $response = $this->getJson('/api/jurnals');
        $response->assertStatus(401);
    }

   // Test 4: Pengguna Authenticated Bisa Melakukan CRUD Jurnal
   public function test_authenticated_user_can_crud_jurnals()
   {
       $user = User::factory()->create();
       $kategori = Kategori::forceCreate([
           'nama' => 'Pengembangan Web',
       ]);

       // Create
       $response = $this->actingAs($user)->postJson('/api/jurnals', [
           'tanggal' => '2026-11-18',
           'judul' => 'Belajar API',
           'kategori_id' => $kategori->id,
           'deskripsi' => 'Membuat REST API Laravel Sanctum'
       ]);
       $response->assertStatus(201);
       $jurnalId = $response->json('data.id');

       // Read
       $this->actingAs($user)->getJson('/api/jurnals')->assertStatus(200);

       // Update
       $this->actingAs($user)->putJson("/api/jurnals/{$jurnalId}", [
           'tanggal' => '2026-11-18',
           'judul' => 'Update Judul API',
           'kategori_id' => $kategori->id,
           'deskripsi' => 'Update deskripsi'
       ])->assertStatus(200);

       // Delete
       $this->actingAs($user)->deleteJson("/api/jurnals/{$jurnalId}")->assertStatus(200);
   }

   // Test 5: Pengguna Tidak Bisa Mengakses Jurnal Milik Orang Lain (403 Forbidden)
   public function test_user_cannot_access_other_users_jurnal()
   {
       $owner = User::factory()->create();
       $otherUser = User::factory()->create();
       $kategori = Kategori::forceCreate([
           'nama' => 'Pengembangan Web',
       ]);

       $jurnal = Jurnal::create([
           'user_id' => $owner->id,
           'tanggal' => '2026-11-18',
           'judul' => 'Jurnal Punya Owner',
           'kategori_id' => $kategori->id,
           'deskripsi' => 'Rahasia',
           'status' => 'proses'
       ]);

       // User lain mencoba mengakses jurnal milik owner
       $response = $this->actingAs($otherUser)->getJson("/api/jurnals/{$jurnal->id}");
       $response->assertStatus(403);
   }
}