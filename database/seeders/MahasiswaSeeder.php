<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            [
                'user_id' => 1, // Pastikan user_id yang digunakan ada pada tabel users
                'nama' => 'Andi Saputra',
                'nim' => '1234567890',
                'prodi_id' => 1, // Pastikan prodi_id ada pada tabel program_studi
                'angkatan' => 2021,
                'minat' => 'Teknologi Informasi',
                'keahlian' => 'IoT, Data Science',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nama' => 'Budi Santoso',
                'nim' => '0987654321',
                'prodi_id' => 2,
                'angkatan' => 2022,
                'minat' => 'Sistem Informasi',
                'keahlian' => 'Jaringan Komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
