<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalJaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengguna_id',
        'hari',
    ];

    protected $casts = [
        'hari' => 'array', // Mengonversi kolom 'hari' menjadi tipe data array
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
