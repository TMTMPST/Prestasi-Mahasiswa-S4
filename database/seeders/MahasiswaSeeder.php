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
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 10
            ],
            [
                'nim' => '2341720093',
                'angkatan' => 2023,
                'nama' => 'Tionusa Catur Pamungkas',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 10
            ],
            [
                'nim' => '2341720243',
                'angkatan' => 2023,
                'nama' => 'Varizky Naldiba Rimra',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8
            ],
            [
                'nim' => '2341720112',
                'angkatan' => 2023,
                'nama' => 'Vidi Joshubzky Saviola',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7
            ],
            [
                'nim' => '2341720155',
                'angkatan' => 2023,
                'nama' => 'Rizky Maulana',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9
            ],
            [
                'nim' => '2341720188',
                'angkatan' => 2023,
                'nama' => 'Siti Nurhaliza',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6
            ],
            [
                'nim' => '2341720201',
                'angkatan' => 2023,
                'nama' => 'Andi Pratama',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 5
            ],
            [
                'nim' => '2341720222',
                'angkatan' => 2023,
                'nama' => 'Budi Santoso',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8
            ],
            [
                'nim' => '2341720255',
                'angkatan' => 2023,
                'nama' => 'Citra Dewi',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7
            ],
            [
                'nim' => '2341720277',
                'angkatan' => 2023,
                'nama' => 'Dewi Lestari',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6
            ],
            [
                'nim' => '2341720301',
                'angkatan' => 2023,
                'nama' => 'Eka Saputra',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9
            ],
            [
                'nim' => '2341720312',
                'angkatan' => 2023,
                'nama' => 'Fajar Nugroho',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8
            ],
            [
                'nim' => '2341720323',
                'angkatan' => 2023,
                'nama' => 'Gita Prameswari',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7
            ],
            [
                'nim' => '2341720334',
                'angkatan' => 2023,
                'nama' => 'Hadi Wijaya',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6
            ],
            [
                'nim' => '2341720345',
                'angkatan' => 2023,
                'nama' => 'Indah Permata',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 5
            ],
            [
                'nim' => '2341720356',
                'angkatan' => 2023,
                'nama' => 'Joko Susilo',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9
            ],
            [
                'nim' => '2341720367',
                'angkatan' => 2023,
                'nama' => 'Kiki Amelia',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8
            ],
            [
                'nim' => '2341720378',
                'angkatan' => 2023,
                'nama' => 'Lina Marlina',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7
            ],
            [
                'nim' => '2341720389',
                'angkatan' => 2023,
                'nama' => 'Miko Pratama',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6
            ],
            [
                'nim' => '2341720390',
                'angkatan' => 2023,
                'nama' => 'Nina Kurnia',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 5
            ],
            [
                'nim' => '2341720401',
                'angkatan' => 2023,
                'nama' => 'Oki Setiawan',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9
            ],
            [
                'nim' => '2341720412',
                'angkatan' => 2023,
                'nama' => 'Putri Ayu',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8
            ],
            [
                'nim' => '2341720423',
                'angkatan' => 2023,
                'nama' => 'Qori Rahman',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7
            ],
            [
                'nim' => '2341720434',
                'angkatan' => 2023,
                'nama' => 'Rina Sari',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6
            ],
            [
                'nim' => '2341720445',
                'angkatan' => 2023,
                'nama' => 'Sandy Prakoso',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 5
            ],
            [
                'nim' => '2341720456',
                'angkatan' => 2023,
                'nama' => 'Tasya Putri',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9
            ],
        ]);
    }
}
