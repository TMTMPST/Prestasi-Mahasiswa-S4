<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPrestasiSeeder extends Seeder
{
    public function run()
    {
        DB::table('data_prestasi')->insert([
            [
                'peringkat' => 'Juara 1',
                'id_lomba' => 1,
                'sertif' => 'sertifikat_1.pdf',
                'foto_bukti' => 'foto_1.jpg',
                'verifikasi' => 'Accepted',
                'poster_lomba' => 'poster_1.jpg'
            ],
            [
                'peringkat' => 'Juara 2',
                'id_lomba' => 2,
                'sertif' => 'sertifikat_2.pdf',
                'foto_bukti' => 'foto_2.jpg',
                'verifikasi' => 'Pending',
                'poster_lomba' => 'poster_2.jpg'
            ],
        ]);
    }
}
