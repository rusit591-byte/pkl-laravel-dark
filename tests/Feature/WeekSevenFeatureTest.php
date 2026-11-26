<?php

namespace Tests\Feature;

use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeekSevenFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_can_be_rendered_for_authenticated_user(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_peserta_cannot_access_pembimbing_jurnals(): void
    {
        $peserta = User::factory()->create(['role' => 'peserta']);

        $response = $this->actingAs($peserta)->get('/pembimbing/jurnals');

        $response->assertStatus(403);
    }

    public function test_pembimbing_can_add_komentar_and_update_status(): void
    {
        $peserta = User::factory()->create(['role' => 'peserta']);
        $pembimbing = User::factory()->create(['role' => 'pembimbing']);
        $kategori = Kategori::create(['nama' => 'Backend']);

        $jurnal = Jurnal::create([
            'user_id'     => $peserta->id,
            'kategori_id' => $kategori->id,
            'tanggal'     => '2026-11-26',
            'judul'       => 'Integrasi API',
            'deskripsi'   => 'Menyelesaikan endpoint dan pengujian.',
            'status'      => 'proses',
        ]);

        $this->actingAs($pembimbing)
            ->post(route('pembimbing.komentar', $jurnal), ['isi' => 'Sudah bagus, lanjutkan.'])
            ->assertRedirect();

        $this->actingAs($pembimbing)
            ->patch(route('pembimbing.status.update', $jurnal), ['status' => 'disetujui'])
            ->assertRedirect();

        $this->assertDatabaseHas('komentars', [
            'jurnal_id' => $jurnal->id,
            'user_id'   => $pembimbing->id,
            'isi'       => 'Sudah bagus, lanjutkan.',
        ]);

        $this->assertDatabaseHas('jurnals', [
            'id'     => $jurnal->id,
            'status' => 'disetujui',
        ]);
    }

    public function test_export_pdf_endpoint_responds_successfully(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);

        $response = $this->actingAs($user)->get(route('jurnals.export-pdf'));

        $response->assertStatus(200);
    }
}