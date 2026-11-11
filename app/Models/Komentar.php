<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentars';
    protected $fillable = ['jurnal_id', 'user_id', 'isi'];

    // Komentar milik satu jurnal
    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class);
    }

    // Komentar ditulis oleh satu user (pembimbing/peserta)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
