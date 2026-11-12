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
    
        // Akun Pembimbing dari Sekolah (Pak Andi)
        \App\Models\User::firstOrCreate(
            ['email' => 'pak.andi@sekolah.com'],
            [
                'name' => 'Pak Andi (Pembimbing Sekolah)',
                'password' => bcrypt('password123'),
                'role' => 'pembimbing',
            ]
        ); 
        
        // Akun pembimbing Tempat PKL (pak Febrian)
        \App\Models\User::firstOrCreate(
            ['email' => 'pak.febrian@metanouva.com'],
            [
                'name' => 'Pak Febrian (Pembimbing Industri)',
                'password' => bcrypt('password123'),
                'role' => 'pembimbing',
            ]
        );

        // Akun Siswa PKL (Rosyid)
        \App\Models\User::firstOrCreate(
            ['email' => 'rusit591@gmail.com'],
            [
                'name' => 'Rosyid Prastyo Jisriansyah',
                'password' => bcrypt('password123'),
                'role' => 'peserta',
            ]
        );
    }
}