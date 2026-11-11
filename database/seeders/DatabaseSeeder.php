<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        // Jalankan Kategori Seeder terlebih dahulu
        $this->call([
            KategoriSeeder::class,
        ]);
    
        // Buat Akun Pembimbing Default
        \App\Models\User::firstOrCreate(
            ['email' => 'pembimbing@metanouva.com'],
            [
                'name' => 'Pembimbing PKL',
                'password' => bcrypt('password123'),
                'role' => 'pembimbing',
            ]
        );
    }
}