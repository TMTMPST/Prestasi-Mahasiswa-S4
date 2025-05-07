<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TingkatSeeder extends Seeder
{
    public function run()
    {
        DB::table('tingkat')->insert([
            ['id_tingkat' => 1, 'nama_tingkat' => 'Kota'],
            ['id_tingkat' => 2, 'nama_tingkat' => 'Provinsi'],
            ['id_tingkat' => 3, 'nama_tingkat' => 'Nasional'],
            ['id_tingkat' => 4, 'nama_tingkat' => 'Internasional'],
        ]);
    }
}
