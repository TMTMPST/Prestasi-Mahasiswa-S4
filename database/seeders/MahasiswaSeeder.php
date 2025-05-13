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
                'nim' => '2341720093',
                'angkatan' => 2023,
                'nama' => 'Tionusa Catur Pamungkas',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 10
            ],
            [
                'nim' => '9876543210',
                'angkatan' => 2023,
                'nama' => 'Vidi Joshubzky',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8
            ],
            [
                'nim' => '2341720094',
                'angkatan' => 2023,
                'nama' => 'Andi Pratama',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7
            ],
            [
                'nim' => '2341720095',
                'angkatan' => 2023,
                'nama' => 'Budi Santoso',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 12
            ],
            [
                'nim' => '2341720096',
                'angkatan' => 2023,
                'nama' => 'Citra Dewi',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9
            ],
            [
                'nim' => '2341720097',
                'angkatan' => 2023,
                'nama' => 'Dewi Lestari',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 11
            ],
            [
                'nim' => '2341720098',
                'angkatan' => 2023,
                'nama' => 'Eko Saputra',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 6
            ],
            [
                'nim' => '2341720099',
                'angkatan' => 2023,
                'nama' => 'Fajar Nugroho',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 13
            ],
            [
                'nim' => '2341720100',
                'angkatan' => 2023,
                'nama' => 'Gita Prameswari',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 5
            ],
            [
                'nim' => '2341720101',
                'angkatan' => 2023,
                'nama' => 'Hendra Wijaya',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 14
            ],
            [
                'nim' => '2341720102',
                'angkatan' => 2023,
                'nama' => 'Indah Permata',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 7
            ],
            [
                'nim' => '2341720103',
                'angkatan' => 2023,
                'nama' => 'Joko Susilo',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 10
            ],
            [
                'nim' => '2341720104',
                'angkatan' => 2023,
                'nama' => 'Kiki Amelia',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 8
            ],
            [
                'nim' => '2341720105',
                'angkatan' => 2023,
                'nama' => 'Lukman Hakim',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 9
            ],
            [
                'nim' => '2341720106',
                'angkatan' => 2023,
                'nama' => 'Maya Sari',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS',
                'poin_presma' => 12
            ],
        ]);
    }
}
