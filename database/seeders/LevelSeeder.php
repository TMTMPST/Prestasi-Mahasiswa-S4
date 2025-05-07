<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    public function run()
    {
        DB::table('level')->insert([
            ['id_level' => 'ADM', 'keterangan' => 'Administrator'],
            ['id_level' => 'MHS', 'keterangan' => 'Mahasiswa'],
            ['id_level' => 'DOS', 'keterangan' => 'Dosen'],
        ]);
    }
}
