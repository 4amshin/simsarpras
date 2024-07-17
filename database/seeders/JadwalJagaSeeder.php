<?php

namespace Database\Seeders;

use App\Models\JadwalJaga;
use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalJagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil 3 pengguna (admin)
        $penggunas = Pengguna::take(3)->get();

        // Data jadwal untuk setiap admin
        $jadwals = [
            ['Senin', 'Rabu'],
            ['Selasa', 'Kamis'],
            ['Jumat', 'Sabtu'],
        ];

        // Iterasi untuk menambahkan data jadwal jaga
        foreach ($penggunas as $key => $pengguna) {
            JadwalJaga::create([
                'pengguna_id' => $pengguna->id,
                'hari' => $jadwals[$key], // Mengambil hari dari array $jadwals
            ]);
        }
    }
}
