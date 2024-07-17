<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'pengguna_id',
        'tanggal_pengajuan',
        'jenis_pengajuan',
        'status_pengajuan',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
