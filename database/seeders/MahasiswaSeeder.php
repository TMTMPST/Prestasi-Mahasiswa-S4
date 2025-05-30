<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('mahasiswa')->insert([
            [
                'nim' => '2341720501',
                'angkatan' => 2023,
                'nama' => 'Yusuf Hidayat',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '123456789012345',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara 1 Lomba Data Science'
            ],
            [
                'nim' => '2341720502',
                'angkatan' => 2023,
                'nama' => 'Sari Melati',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '123456789012345',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Finalis Lomba Karya Tulis Ilmiah'
            ],
            [
                'nim' => '2341720503',
                'angkatan' => 2023,
                'nama' => 'Bambang Setiawan',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '123456789012345',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Workshop Cloud Computing'
            ],
            [
                'nim' => '2341720162',
                'angkatan' => 2023,
                'nama' => 'Diana Rahmawati',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '123456789012345',
                'level' => 'MHS',
                'poin_presma' => 10,
                'prestasi_tertinggi' => 'Juara 1 Lomba Coding Nasional'
            ],
            [
                'nim' => '2341720456',
                'angkatan' => 2023,
                'nama' => 'Tasya Putri',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '123456789012345',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 1 Lomba Poster'
            ],
        ]);
    }
}
