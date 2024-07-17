<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('id_ID');

        return [
            'kode_barang' => strtoupper(Str::random(5)),
            'nama_barang' => $this->faker->randomElement([
                'Kursi Kuliah',
                'Papan Tulis',
                'Proyektor',
                'Komputer Lab',
                'Meja Dosen',
                'Printer',
                'Scanner'
            ]),
            'lokasi_barang' => $this->faker->randomElement([
                'Ruang Kelas A',
                'Ruang Kelas B',
                'Laboratorium Komputer',
                'Ruang Dosen',
                'Ruang Administrasi'
            ]),
            'kondisi_barang' => $this->faker->randomElement(['bagus', 'rusak']),
            'keterangan' => $this->faker->sentence,
        ];
    }
}
