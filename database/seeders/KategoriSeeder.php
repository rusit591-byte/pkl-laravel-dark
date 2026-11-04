<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Coding & Pengembangan'],
            ['nama' => 'Belajar & Riset Teknologi'],
            ['nama' => 'Meeting & Koordinasi'],
            ['nama' => 'Dokumentasi & Laporan'],
        ];

        foreach ($kategoris as $kat) {
            Kategori::firstOrCreate($kat);
        }
    }
}