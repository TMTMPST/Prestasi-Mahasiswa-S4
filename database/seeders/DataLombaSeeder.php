<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataLombaSeeder extends Seeder
{
    public function run()
    {
        DB::table('data_lomba')->insert([
            [
                'nama_lomba' => 'Lomba IT Nasional',
                'tgl_dibuka' => '2025-01-01',
                'tgl_ditutup' => '2025-02-01',
                'tingkat' => 3,
                'kategori' => 1,
                'jenis' => 1,
                'penyelenggara' => 'Universitas Brawijaya',
                'alamat' => 'Jl. Veteran No. 1, Malang'
            ],
            [
                'nama_lomba' => 'Lomba Desain Grafis Kota',
                'tgl_dibuka' => '2025-03-01',
                'tgl_ditutup' => '2025-04-01',
                'tingkat' => 1,
                'kategori' => 2,
                'jenis' => 2,
                'penyelenggara' => 'Politeknik Negeri Malang',
                'alamat' => 'Jl. Soekarno Hatta No. 10, Malang'
            ],
        ]);
    }
}
