<?php

namespace Tests\Feature;

use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PembimbingApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_pembimbing_can_list_update_status_and_comment_jurnal(): void
    {
        $pembimbing = User::factory()->create(['role' => 'pembimbing']);
        $peserta = User::factory()->create(['role' => 'peserta']);
        $kategori = Kategori::create(['nama' => 'Backend']);

        $jurnal = Jurnal::create([
            'user_id' => $peserta->id,
            'kategori_id' => $kategori->id,
            'tanggal' => '2026-11-27',
            'judul' => 'Implementasi API Pembimbing',
            'deskripsi' => 'Membuat endpoint approval dan komentar',
            'status' => 'proses',
        ]);

        $this->actingAs($pembimbing)
            ->getJson('/api/pembimbing/jurnals')
            ->assertStatus(200);

        $this->actingAs($pembimbing)
            ->patchJson("/api/pembimbing/jurnals/{$jurnal->id}/status", [
                'status' => 'disetujui',
            ])
            ->assertStatus(200)
            ->assertJsonPath('data.status', 'disetujui');

        $this->actingAs($pembimbing)
            ->postJson("/api/pembimbing/jurnals/{$jurnal->id}/komentar", [
                'isi' => 'Dokumentasi endpoint sudah lengkap.',
            ])
            ->assertStatus(201);

        $this->assertDatabaseHas('jurnals', [
            'id' => $jurnal->id,
            'status' => 'disetujui',
        ]);

        $this->assertDatabaseHas('komentars', [
            'jurnal_id' => $jurnal->id,
            'user_id' => $pembimbing->id,
        ]);
    }

    public function test_non_pembimbing_cannot_access_pembimbing_endpoints(): void
    {
        $peserta = User::factory()->create(['role' => 'peserta']);

        $this->actingAs($peserta)
            ->getJson('/api/pembimbing/jurnals')
            ->assertStatus(403);
    }
}