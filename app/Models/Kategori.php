<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $fillable = ['nama'];

    // Satu kategori memiliki banyak jurnal
    public function jurnals()
    {
        return $this->hasMany(Jurnal::class);
    }
}