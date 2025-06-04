<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeahlianMahasiswaSeeder extends Seeder
{
    public function run()
    {
        // Contoh data keahlian mahasiswa
        DB::table('keahlian_mahasiswa')->insert([
            ['nim' => '2341720501', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720501', 'id_jenis' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720502', 'id_jenis' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720503', 'id_jenis' => 18, 'created_at' => now(), 'updated_at' => now()],
            // Tambah data lain sesuai kebutuhan
        ]);
    }
}
