<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prestasi')->insert([
            [
                'mahasiswa_id' => 1, // Pastikan mahasiswa_id ada pada tabel mahasiswa
                'kategori' => 'teknologi',
                'nama_prestasi' => 'Juara 1 Lomba IoT Nasional',
                'penyelenggara' => 'Universitas XYZ',
                'status_verifikasi' => 'disetujui',
                'tahun' => 2023,
                'tingkat' => 'nasional',
                'bukti_file' => 'prestasi/iot_2023.pdf',
                'catatan_admin' => 'Bagus, sesuai kriteria.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mahasiswa_id' => 2, // Pastikan mahasiswa_id ada pada tabel mahasiswa
                'kategori' => 'akademik',
                'nama_prestasi' => 'IPK Cumlaude',
                'penyelenggara' => 'Polinema',
                'status_verifikasi' => 'pending',
                'tahun' => 2024,
                'tingkat' => 'lokal',
                'bukti_file' => 'prestasi/ipk_cumlaude_2024.pdf',
                'catatan_admin' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
