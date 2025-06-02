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
            [
                'nim' => '2341720601',
                'angkatan' => 2023,
                'nama' => 'Rina Anggraini',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '987654321098765',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Juara 2 Lomba UI/UX'
            ],
            [
                'nim' => '2341720602',
                'angkatan' => 2023,
                'nama' => 'Andi Pratama',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '111111111111111',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara 3 Lomba Startup'
            ],
            [
                'nim' => '2341720603',
                'angkatan' => 2023,
                'nama' => 'Lestari Dewi',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '222222222222222',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Seminar Nasional'
            ],
            [
                'nim' => '2341720604',
                'angkatan' => 2023,
                'nama' => 'Bagus Santoso',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '333333333333333',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 1 Lomba Web Design'
            ],
            [
                'nim' => '2341720605',
                'angkatan' => 2023,
                'nama' => 'Putri Maharani',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '444444444444444',
                'level' => 'MHS',
                'poin_presma' => 10,
                'prestasi_tertinggi' => 'Juara 1 Lomba Mobile Apps'
            ],
            [
                'nim' => '2341720606',
                'angkatan' => 2023,
                'nama' => 'Fajar Nugroho',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '555555555555555',
                'level' => 'MHS',
                'poin_presma' => 5,
                'prestasi_tertinggi' => 'Peserta Lomba Hackathon'
            ],
            [
                'nim' => '2341720607',
                'angkatan' => 2023,
                'nama' => 'Siti Nurhaliza',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '666666666666666',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara 2 Lomba Infografis'
            ],
            [
                'nim' => '2341720608',
                'angkatan' => 2023,
                'nama' => 'Rizky Ramadhan',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '777777777777777',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Peserta Seminar Internasional'
            ],
            [
                'nim' => '2341720609',
                'angkatan' => 2023,
                'nama' => 'Dewi Sartika',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '888888888888888',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Juara 3 Lomba Essay'
            ],
            [
                'nim' => '2341720610',
                'angkatan' => 2023,
                'nama' => 'Galih Prakoso',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '999999999999999',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 1 Lomba Game Development'
            ],
            [
                'nim' => '2341720611',
                'angkatan' => 2023,
                'nama' => 'Intan Permata',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '101010101010101',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara 2 Lomba Business Plan'
            ],
            [
                'nim' => '2341720612',
                'angkatan' => 2023,
                'nama' => 'Yoga Saputra',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '121212121212121',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Peserta Workshop AI'
            ],
            [
                'nim' => '2341720613',
                'angkatan' => 2023,
                'nama' => 'Mega Lestari',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '131313131313131',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Juara 3 Lomba Animasi'
            ],
            [
                'nim' => '2341720614',
                'angkatan' => 2023,
                'nama' => 'Rendi Kurniawan',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '141414141414141',
                'level' => 'MHS',
                'poin_presma' => 10,
                'prestasi_tertinggi' => 'Juara 1 Lomba Robotik'
            ],
            [
                'nim' => '2341720615',
                'angkatan' => 2023,
                'nama' => 'Nadia Safitri',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '151515151515151',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 2 Lomba Akuntansi'
            ],
            [
                'nim' => '2341720616',
                'angkatan' => 2023,
                'nama' => 'Dimas Pratama',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '161616161616161',
                'level' => 'MHS',
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Peserta Lomba Cyber Security'
            ],
            [
                'nim' => '2341720617',
                'angkatan' => 2023,
                'nama' => 'Ayu Wulandari',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '171717171717171',
                'level' => 'MHS',
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Juara 3 Lomba Marketing'
            ],
            [
                'nim' => '2341720618',
                'angkatan' => 2023,
                'nama' => 'Fikri Maulana',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '181818181818181',
                'level' => 'MHS',
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Lomba IoT'
            ],
            [
                'nim' => '2341720619',
                'angkatan' => 2023,
                'nama' => 'Salsa Amelia',
                'password' => Hash::make('12345'),
                'prodi' => 'Sistem Informasi Bisnis',
                'dosen_nip' => '191919191919191',
                'level' => 'MHS',
                'poin_presma' => 10,
                'prestasi_tertinggi' => 'Juara 1 Lomba Public Speaking'
            ],
            [
                'nim' => '2341720620',
                'angkatan' => 2023,
                'nama' => 'Rizal Hakim',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'dosen_nip' => '202020202020202',
                'level' => 'MHS',
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 2 Lomba Software Engineering'
            ],
        ]);
    }
}
