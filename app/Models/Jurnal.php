<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_id', 
        'judul',
        'deskripsi',
        'lampiran',    
        'tanggal',
        'status'
    ];

    // Jurnal milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Jurnal milik satu kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Satu jurnal bisa memiliki banyak komentar/catatan
    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['user_id'] ?? null, fn ($q, $v) => $q->where('user_id', $v))
            ->when($filters['search'] ?? null, fn ($q, $v) => $q->where('judul', 'like', '%' . $v . '%'))
            ->when($filters['kategori_id'] ?? null, fn ($q, $v) => $q->where('kategori_id', $v))
            ->when($filters['status'] ?? null, fn ($q, $v) => $q->where('status', $v))
            ->when($filters['tanggal'] ?? null, fn ($q, $v) => $q->where('tanggal', $v));
    }
}