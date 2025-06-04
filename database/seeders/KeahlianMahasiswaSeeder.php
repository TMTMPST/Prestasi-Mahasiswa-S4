<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeahlianMahasiswaSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        DB::table('keahlian_mahasiswa')->truncate();

        // Contoh data keahlian mahasiswa
        DB::table('keahlian_mahasiswa')->insert([
    ['nim' => '2341720162', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
    ['nim' => '2341720162', 'id_jenis' => 10, 'created_at' => now(), 'updated_at' => now()],
    ['nim' => '2341720093', 'id_jenis' => 4, 'created_at' => now(), 'updated_at' => now()],
    ['nim' => '2341720243', 'id_jenis' => 15, 'created_at' => now(), 'updated_at' => now()],
    ['nim' => '2341720112', 'id_jenis' => 7, 'created_at' => now(), 'updated_at' => now()],
    ]);
    }
}
