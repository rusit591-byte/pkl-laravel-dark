<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jurnals', function (Blueprint $table) {
            // Relasi ke tabel kategoris (bisa nullable dulu agar data jurnal lama tidak error)
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->nullOnDelete()->after('user_id');
            // Kolom untuk menyimpan path file lampiran/screenshot
            $table->string('lampiran')->nullable()->after('deskripsi');
        });
    }
    
    public function down(): void
    {
        Schema::table('jurnals', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn(['kategori_id', 'lampiran']);
        });
    }
};
