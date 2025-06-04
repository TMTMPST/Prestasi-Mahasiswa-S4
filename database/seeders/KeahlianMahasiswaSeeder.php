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
            ['nim' => '2341720501', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720501', 'id_jenis' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720502', 'id_jenis' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720502', 'id_jenis' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720503', 'id_jenis' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720162', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720162', 'id_jenis' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720456', 'id_jenis' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720601', 'id_jenis' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720602', 'id_jenis' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720603', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720604', 'id_jenis' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720605', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720605', 'id_jenis' => 10, 'created_at' => now(), 'updated_at' => now()],
            // Add more entries for other students
            ['nim' => '2341720606', 'id_jenis' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720607', 'id_jenis' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720608', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720609', 'id_jenis' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720610', 'id_jenis' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720611', 'id_jenis' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720612', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720613', 'id_jenis' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720614', 'id_jenis' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720615', 'id_jenis' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720616', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720617', 'id_jenis' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720618', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720619', 'id_jenis' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['nim' => '2341720620', 'id_jenis' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
