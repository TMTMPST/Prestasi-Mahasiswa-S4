<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis')->insert([
            ['id_jenis' => 1, 'nama_jenis' => 'Website'],
            ['id_jenis' => 2, 'nama_jenis' => 'Mobile App'],
            ['id_jenis' => 3, 'nama_jenis' => 'Game'],
            ['id_jenis' => 4, 'nama_jenis' => 'Desktop App'],
            ['id_jenis' => 5, 'nama_jenis' => 'IoT'],
            ['id_jenis' => 6, 'nama_jenis' => 'Lainnya'],
        ]);
    }
}
