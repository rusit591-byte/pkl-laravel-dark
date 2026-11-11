<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurnal_id')->constrained('jurnals')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Pengguna yang menulis komentar (pembimbing/peserta)
            $table->text('isi'); // Isi catatan atau komentar
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
