<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ktp;

class KtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ktps = [
            [
                'nik' => '3174010203050001',
                'nama' => 'Ahmad Wijaya',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3175012304080002',
                'nama' => 'Siti Nurhaliza',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3273011506030003',
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Asia Afrika No. 20, Bandung',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3174015609100004',
                'nama' => 'Dewi Lestari',
                'alamat' => 'Jl. Thamrin No. 78, Jakarta Pusat',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3277010101250005',
                'nama' => 'Rudi Hermawan',
                'alamat' => 'Jl. Ahmad Yani No. 33, Bekasi',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3175027802200006',
                'nama' => 'Lisa Amelia',
                'alamat' => 'Jl. Margonda No. 55, Depok',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3174011111220007',
                'nama' => 'Eko Prasetyo',
                'alamat' => 'Jl. Gatot Subroto No. 12, Jakarta Selatan',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3175023333440008',
                'nama' => 'Rina Susanti',
                'alamat' => 'Jl. Palmerah Barat No. 67, Jakarta Barat',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3276015555660009',
                'nama' => 'Joko Widodo',
                'alamat' => 'Jl. Raya Bogor Km 28, Jakarta Timur',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3174037777880010',
                'nama' => 'Fitriani',
                'alamat' => 'Jl. Fatmawati No. 89, Jakarta Selatan',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Ktp::insert($ktps);
    }
}

