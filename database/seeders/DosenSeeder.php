<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh: pastikan user dengan ID 1 sudah ada sebelum menjalankan seeder ini
        DB::table('dosen')->insert([
            [
                'user_id' => 1,
                'nama' => 'Dr. Andi Saputra',
                'nidn' => '1234567890',
                'bidang_minat' => 'Kecerdasan Buatan, Data Mining',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nama' => 'Prof. Budi Santoso',
                'nidn' => '0987654321',
                'bidang_minat' => 'Jaringan Komputer, Keamanan Siber',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
