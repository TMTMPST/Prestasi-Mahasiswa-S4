<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    public function run()
    {
        DB::table('program_studi')->insert([
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'Teknik Informatika',
                'jenjang' => 'D4',
                'fakultas' => 'Teknologi Informasi',
                'status' => 'Aktif',
                'deskripsi' => 'Program studi yang mempelajari teknologi informasi dan komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_prodi' => 'SIB',
                'nama_prodi' => 'Sistem Informasi Bisnis',
                'jenjang' => 'D4',
                'fakultas' => 'Teknologi Informasi',
                'status' => 'Aktif',
                'deskripsi' => 'Program studi yang menggabungkan teknologi informasi dengan bisnis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
