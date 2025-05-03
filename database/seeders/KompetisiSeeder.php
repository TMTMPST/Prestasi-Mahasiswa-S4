<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KompetisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kompetisi')->insert([
            [
                'nama' => 'Gemastik XV',
                'kategori' => 'Kompetisi Mahasiswa',
                'bidang_keahlian' => 'Kecerdasan Buatan, Pengembangan Aplikasi',
                'penyelenggara' => 'Kemdikbud',
                'tingkat' => 'nasional',
                'tanggal_mulai' => '2025-06-10',
                'tanggal_akhir' => '2025-06-12',
                'link_pendaftaran' => 'https://gemastik.kemdikbud.go.id',
                'status_verifikasi' => 'disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'International Collegiate Programming Contest (ICPC)',
                'kategori' => 'Kompetisi Pemrograman',
                'bidang_keahlian' => 'Algoritma, Struktur Data',
                'penyelenggara' => 'ICPC Foundation',
                'tingkat' => 'internasional',
                'tanggal_mulai' => '2025-09-01',
                'tanggal_akhir' => '2025-09-05',
                'link_pendaftaran' => 'https://icpc.global',
                'status_verifikasi' => 'disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Lomba UI/UX Mahasiswa TI',
                'kategori' => 'Desain Antarmuka',
                'bidang_keahlian' => 'UI/UX Design',
                'penyelenggara' => 'Jurusan TI',
                'tingkat' => 'lokal',
                'tanggal_mulai' => '2025-04-15',
                'tanggal_akhir' => '2025-04-20',
                'link_pendaftaran' => null,
                'status_verifikasi' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
