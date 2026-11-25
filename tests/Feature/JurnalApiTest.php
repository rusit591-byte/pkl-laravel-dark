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

    public function test_user_cannot_login_with_wrong_password()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'salahpassword'
        ]);

        $response->assertStatus(401);
    }

    public function test_unauthenticated_user_cannot_access_jurnals()
    {
        $response = $this->getJson('/api/jurnals');
        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_crud_jurnals()
    {
        $user = User::factory()->create();
        $kategori = Kategori::forceCreate([
            'nama' => 'Pengembangan Web',
        ]);

        $response = $this->actingAs($user)->postJson('/api/jurnals', [
            'tanggal' => '2026-11-18',
            'judul' => 'Belajar API',
            'kategori_id' => $kategori->id,
            'deskripsi' => 'Membuat REST API Laravel Sanctum'
        ]);
        $response->assertStatus(201);
        $jurnalId = $response->json('data.id');

        $this->actingAs($user)->getJson('/api/jurnals')->assertStatus(200);

        $this->actingAs($user)->putJson("/api/jurnals/{$jurnalId}", [
            'tanggal' => '2026-11-18',
            'judul' => 'Update Judul API',
            'kategori_id' => $kategori->id,
            'deskripsi' => 'Update deskripsi'
        ])->assertStatus(200);

        $this->actingAs($user)->deleteJson("/api/jurnals/{$jurnalId}")->assertStatus(200);
    }

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

        $response = $this->actingAs($otherUser)->getJson("/api/jurnals/{$jurnal->id}");
        $response->assertStatus(403);
    }

    public function test_create_jurnal_fails_validation_when_required_fields_missing()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/jurnals', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['kategori_id', 'judul', 'deskripsi', 'tanggal']);
    }

    public function test_owner_can_view_own_jurnal_detail()
    {
        $user = User::factory()->create();
        $kategori = Kategori::forceCreate([
            'nama' => 'Pengembangan Web',
        ]);

        $jurnal = Jurnal::create([
            'user_id' => $user->id,
            'tanggal' => '2026-11-25',
            'judul' => 'Detail Jurnal Saya',
            'kategori_id' => $kategori->id,
            'deskripsi' => 'Isi detail jurnal',
            'status' => 'proses'
        ]);

        $response = $this->actingAs($user)->getJson("/api/jurnals/{$jurnal->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('data.judul', 'Detail Jurnal Saya');
    }

    public function test_user_cannot_update_other_users_jurnal()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $kategori = Kategori::forceCreate([
            'nama' => 'Pengembangan Web',
        ]);

        $jurnal = Jurnal::create([
            'user_id' => $owner->id,
            'tanggal' => '2026-11-25',
            'judul' => 'Jurnal Asli Owner',
            'kategori_id' => $kategori->id,
            'deskripsi' => 'Deskripsi asli',
            'status' => 'proses'
        ]);

        $response = $this->actingAs($otherUser)->putJson("/api/jurnals/{$jurnal->id}", [
            'tanggal' => '2026-11-25',
            'judul' => 'Diubah Orang Lain',
            'kategori_id' => $kategori->id,
            'deskripsi' => 'Percobaan edit ilegal'
        ]);

        $response->assertStatus(403);
    }

    public function test_user_cannot_delete_other_users_jurnal()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $kategori = Kategori::forceCreate([
            'nama' => 'Pengembangan Web',
        ]);

        $jurnal = Jurnal::create([
            'user_id' => $owner->id,
            'tanggal' => '2026-11-25',
            'judul' => 'Jurnal Tidak Boleh Dihapus',
            'kategori_id' => $kategori->id,
            'deskripsi' => 'Data penting',
            'status' => 'proses'
        ]);

        $response = $this->actingAs($otherUser)->deleteJson("/api/jurnals/{$jurnal->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('jurnals', ['id' => $jurnal->id]);
    }

    public function test_user_can_logout_and_revoke_token()
    {
        $user = User::factory()->create([
            'email' => 'logout@example.com',
            'password' => bcrypt('password123')
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
                        ->postJson('/api/logout');

        $response->assertStatus(200);
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }
}