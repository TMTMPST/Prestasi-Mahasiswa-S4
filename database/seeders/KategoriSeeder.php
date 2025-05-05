<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Akademik'],
            ['id_kategori' => 2, 'nama_kategori' => 'Non-Akademik'],
        ]);
    }
}
