<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::factory()->create([
            'nama' => 'Admin Delta',
            'nomor_telepon' => '+62895635090134',
            'role' => 'admin',
            'email' => 'delta@simsarpras.id',
            'password' => 'password',
        ]);

        Pengguna::factory()->create([
            'nama' => 'Admin Beta',
            'nomor_telepon' => '+62895635090134',
            'role' => 'admin',
            'email' => 'beta@simsarpras.id',
            'password' => 'password',
        ]);

        Pengguna::factory()->create([
            'nama' => 'Bapak Pimpinan',
            'nomor_telepon' => '+62895635090134',
            'role' => 'pimpinan',
            'email' =>  'pimpinan@simsarpras.id',
            'password' => 'password',
        ]);
    }
}
