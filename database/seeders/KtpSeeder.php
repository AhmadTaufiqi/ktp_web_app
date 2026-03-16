<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ktp;
use Illuminate\Database\Eloquent\WithoutModelEvents;

class KtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Ktp::truncate();
        
        $ktps = [];

        // Generate 10k records with Faker (Indonesian locale)
        $faker = \Faker\Factory::create('id_ID');
        while (count($ktps) < 10000) {
            $ktps[] = [
                'nik' => $faker->unique()->numerify('31####' . $faker->year('1970', '2005') . $faker->numerify('####00')),
                'nama' => $faker->name,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeBetween('1970-01-01', '2005-12-31')->format('Y-m-d'),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->streetAddress . ', ' . $faker->city,
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'status_perkawinan' => $faker->randomElement(['Belum Kawin', 'Kawin']),
                'pekerjaan' => $faker->jobTitle,
                'kewarganegaraan' => 'Indonesia',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert in chunks to avoid MySQL placeholder limit
        $chunks = array_chunk($ktps, 1000);
        foreach ($chunks as $chunk) {
            Ktp::withoutEvents(function () use ($chunk) {
                Ktp::insert($chunk);
            });
        }

        $this->command->info('✅ 10,000 KTP records seeded successfully!');
    }
}

