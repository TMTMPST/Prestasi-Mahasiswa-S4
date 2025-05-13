<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataLombaSeeder extends Seeder
{
    public function run()
    {
        DB::table('data_lomba')->insert([
            [
                'nama_lomba' => 'Lomba IT Nasional',
                'tgl_dibuka' => '2025-01-01',
                'tgl_ditutup' => '2025-02-01',
                'tingkat' => 3, // Nasional
                'kategori' => 1, // Akademik (kategori 1 sesuai dengan KategoriSeeder)
                'jenis' => 1, // Website
                'penyelenggara' => 'Universitas Brawijaya',
                'alamat' => 'Jl. Veteran No. 1, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Desain Grafis Kota',
                'tgl_dibuka' => '2025-03-01',
                'tgl_ditutup' => '2025-04-01',
                'tingkat' => 1, // Kota
                'kategori' => 2, // Non-Akademik (kategori 2 sesuai dengan KategoriSeeder)
                'jenis' => 2, // Mobile App
                'penyelenggara' => 'Politeknik Negeri Malang',
                'alamat' => 'Jl. Soekarno Hatta No. 10, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Hackathon Provinsi Jawa Timur',
                'tgl_dibuka' => '2025-02-10',
                'tgl_ditutup' => '2025-03-10',
                'tingkat' => 2, // Provinsi
                'kategori' => 1, // Akademik
                'jenis' => 2, // Mobile App
                'penyelenggara' => 'Diskominfo Jatim',
                'alamat' => 'Jl. Pahlawan No. 110, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Olimpiade Matematika Regional',
                'tgl_dibuka' => '2025-04-15',
                'tgl_ditutup' => '2025-05-15',
                'tingkat' => 2, // Provinsi
                'kategori' => 1, // Akademik
                'jenis' => 1, // Website
                'penyelenggara' => 'Ikatan Matematika Indonesia',
                'alamat' => 'Jl. Diponegoro No. 20, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Business Plan Competition Nasional',
                'tgl_dibuka' => '2025-06-01',
                'tgl_ditutup' => '2025-07-01',
                'tingkat' => 3, // Nasional
                'kategori' => 2, // Non-Akademik
                'jenis' => 2, // Mobile App
                'penyelenggara' => 'Universitas Indonesia',
                'alamat' => 'Jl. Salemba Raya No. 4, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
