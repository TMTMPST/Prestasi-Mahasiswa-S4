<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataLombaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_lomba')->insert([
            [
                'nama_lomba' => 'Lomba IT Nasional',
                'tgl_dibuka' => '2025-01-01', // Tanggal pendaftaran dibuka
                'tgl_ditutup' => '2025-12-12', // Tanggal pendaftaran ditutup
                'tingkat' => 3, // Corresponds to id_tingkat in 'tingkat' table
                'jenis' => 1, // Corresponds to id_jenis in 'jenis' table
                'tingkat_penyelenggara' => 'Kampus Lain / Organisasi Mahasiswa Nasional',
                'penyelenggara' => 'Universitas Brawijaya',
                'alamat' => 'Jl. Veteran No. 1, Malang',
                'link_lomba' => 'https://lomba-it-nasional.com',
                'biaya' => 0, // Biaya pendaftaran (0 jika gratis)
                'hadiah' => 'Rp 10.000.000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Desain Grafis Kota',
                'tgl_dibuka' => '2025-01-01',
                'tgl_ditutup' => '2025-12-12',
                'tingkat' => 1, // Corresponds to id_tingkat in 'tingkat' table
                'jenis' => 19, // Corresponds to id_jenis in 'jenis' table
                'tingkat_penyelenggara' => 'Kampus Lain / Organisasi Mahasiswa Nasional',
                'penyelenggara' => 'Politeknik Negeri Malang',
                'alamat' => 'Jl. Soekarno Hatta No. 10, Malang',
                'link_lomba' => 'https://desain-grafis-kota.org',
                'biaya' => 0,
                'hadiah' => 'Rp 2.000.000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Hackathon Inovasi Digital Provinsi',
                'tgl_dibuka' => '2025-01-01',
                'tgl_ditutup' => '2025-12-12',
                'tingkat' => 2, // Corresponds to id_tingkat in 'tingkat' table
                'jenis' => 2, // Corresponds to id_jenis in 'jenis' table
                'tingkat_penyelenggara' => 'Kampus Lain / Organisasi Mahasiswa Nasional',
                'penyelenggara' => 'Dinas Kominfo Jawa Timur',
                'alamat' => 'Jl. A. Yani No. 20, Surabaya',
                'link_lomba' => 'https://hackathon-jatim.go.id',
                'biaya' => 0,
                'hadiah' => 'Rp 7.000.000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Olimpiade Sains Internasional',
                'tgl_dibuka' => '2025-01-01',
                'tgl_ditutup' => '2025-12-12',
                'tingkat' => 4, // Corresponds to id_tingkat in 'tingkat' table
                'jenis' => 5, // Corresponds to id_jenis in 'jenis' table
                'tingkat_penyelenggara' => 'Kampus Lain / Organisasi Mahasiswa Nasional',
                'penyelenggara' => 'ACM International',
                'alamat' => 'Online',
                'link_lomba' => 'https://olimpiade-sains-internasional.com',
                'biaya' => 0,
                'hadiah' => 'Medali & Pengakuan Internasional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Kompetisi Robotika Kampus',
                'tgl_dibuka' => '2025-01-01',
                'tgl_ditutup' => '2025-12-12',
                'tingkat' => 4, // Corresponds to id_tingkat in 'tingkat' table
                'jenis' => 10, // Corresponds to id_jenis in 'jenis' table
                'tingkat_penyelenggara' => 'Kampus Lain / Organisasi Mahasiswa Nasional',
                'penyelenggara' => 'UKM Robotika Universitas XYZ',
                'alamat' => 'Gedung Serbaguna Kampus XYZ',
                'link_lomba' => 'https://robotika-kampus.ac.id',
                'biaya' => 0,
                'hadiah' => 'Rp 1.500.000 & Piala',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Penulisan Esai Nasional',
                'tgl_dibuka' => '2025-01-01',
                'tgl_ditutup' => '2025-12-12',
                'tingkat' => 3, // Corresponds to id_tingkat in 'tingkat' table
                'jenis' => 25, // Corresponds to id_jenis in 'jenis' table
                'tingkat_penyelenggara' => 'Kampus Lain / Organisasi Mahasiswa Nasional',
                'penyelenggara' => 'Lembaga Ilmu Pengetahuan Indonesia (LIPI)',
                'alamat' => 'Online',
                'link_lomba' => 'https://esai-nasional.go.id',
                'biaya' => 0,
                'hadiah' => 'Rp 5.000.000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}