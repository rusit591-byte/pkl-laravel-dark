<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'judul',
        'deskripsi',
        'status',
        'kendala',
    ];

    // Relasi: Setiap jurnal dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}