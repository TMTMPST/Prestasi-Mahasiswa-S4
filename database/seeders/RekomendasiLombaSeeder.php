<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekomendasiLombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rekomendasi_lomba')->insert([
            [
                'mahasiswa_id'    => 1,   // pastikan Mahasiswa dengan ID 1 ada
                'kompetisi_id'    => 1,   // pastikan Kompetisi dengan ID 1 ada
                'skor_kecocokan'  => 0.85,
                'alasan'          => 'Profil sesuai bidang teknologi dan tingkat nasional',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'mahasiswa_id'    => 2,
                'kompetisi_id'    => 2,
                'skor_kecocokan'  => 0.65,
                'alasan'          => 'Minat desain UI/UX cocok untuk kompetisi lokal',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
