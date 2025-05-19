<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('mahasiswa')->insert([
            [
                'nim' => '2341720162',
                'angkatan' => 2023,
                'nama' => 'Diana Rahmawati',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis', // diubah
                'level' => 'MHS',
                'poin_presma' => 10,
                'prestasi_tertinggi' => 'Juara 1 Lomba Coding Nasional'
            ],
            [
                'nim' => '2341720093',
                'angkatan' => 2023,
                'nama' => 'Tionusa Catur Pamungkas',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 10,
                'prestasi_tertinggi' => 'Finalis Hackathon Regional'
            ],
            [
                'nim' => '2341720243',
                'angkatan' => 2023,
                'nama' => 'Varizky Naldiba Rimra',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara 2 UI/UX Competition'
            ],
            [
                'nim' => '2341720112',
                'angkatan' => 2023,
                'nama' => 'Vidi Joshubzky Saviola',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis', // diubah
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Peserta Seminar Nasional'
            ],
            [
                'nim' => '2341720155',
                'angkatan' => 2023,
                'nama' => 'Rizky Maulana',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 3 Lomba Robotik'
            ],
            [
                'nim' => '2341720188',
                'angkatan' => 2023,
                'nama' => 'Siti Nurhaliza',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Workshop AI'
            ],
            [
                'nim' => '2341720201',
                'angkatan' => 2023,
                'nama' => 'Andi Pratama',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis', // diubah
                'level' => 'MHS',
                'poin_presma' => 5,
                'prestasi_tertinggi' => 'Peserta Lomba Web Design'
            ],
            [
                'nim' => '2341720222',
                'angkatan' => 2023,
                'nama' => 'Budi Santoso',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara Harapan Lomba IT'
            ],
            [
                'nim' => '2341720255',
                'angkatan' => 2023,
                'nama' => 'Citra Dewi',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Peserta Seminar Internasional'
            ],
            [
                'nim' => '2341720277',
                'angkatan' => 2023,
                'nama' => 'Dewi Lestari',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis', // diubah
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Lomba Poster'
            ],
            // ... sisanya tetap
            [
                'nim' => '2341720301',
                'angkatan' => 2023,
                'nama' => 'Eka Saputra',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 1 Lomba Startup'
            ],
            [
                'nim' => '2341720312',
                'angkatan' => 2023,
                'nama' => 'Fajar Nugroho',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara 2 Lomba Animasi'
            ],
            [
                'nim' => '2341720323',
                'angkatan' => 2023,
                'nama' => 'Gita Prameswari',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Peserta Lomba Esai'
            ],
            [
                'nim' => '2341720334',
                'angkatan' => 2023,
                'nama' => 'Hadi Wijaya',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Lomba Infografis'
            ],
            [
                'nim' => '2341720345',
                'angkatan' => 2023,
                'nama' => 'Indah Permata',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 5,
                'prestasi_tertinggi' => 'Peserta Lomba Poster'
            ],
            [
                'nim' => '2341720356',
                'angkatan' => 2023,
                'nama' => 'Joko Susilo',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 2 Lomba IT'
            ],
            [
                'nim' => '2341720367',
                'angkatan' => 2023,
                'nama' => 'Kiki Amelia',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara Harapan Lomba Coding'
            ],
            [
                'nim' => '2341720378',
                'angkatan' => 2023,
                'nama' => 'Lina Marlina',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Peserta Lomba Startup'
            ],
            [
                'nim' => '2341720389',
                'angkatan' => 2023,
                'nama' => 'Miko Pratama',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Lomba UI/UX'
            ],
            [
                'nim' => '2341720390',
                'angkatan' => 2023,
                'nama' => 'Nina Kurnia',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 5,
                'prestasi_tertinggi' => 'Peserta Lomba Animasi'
            ],
            [
                'nim' => '2341720401',
                'angkatan' => 2023,
                'nama' => 'Oki Setiawan',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 1 Lomba IT'
            ],
            [
                'nim' => '2341720412',
                'angkatan' => 2023,
                'nama' => 'Putri Ayu',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara 2 Lomba Startup'
            ],
            [
                'nim' => '2341720423',
                'angkatan' => 2023,
                'nama' => 'Qori Rahman',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Peserta Lomba Coding'
            ],
            [
                'nim' => '2341720434',
                'angkatan' => 2023,
                'nama' => 'Rina Sari',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Lomba IT'
            ],
            [
                'nim' => '2341720445',
                'angkatan' => 2023,
                'nama' => 'Sandy Prakoso',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 5,
                'prestasi_tertinggi' => 'Peserta Lomba Startup'
            ],
            [
                'nim' => '2341720456',
                'angkatan' => 2023,
                'nama' => 'Tasya Putri',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 1 Lomba Poster'
            ],
        ]);
    }
}
