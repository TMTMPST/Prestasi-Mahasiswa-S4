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
                'level' => 'MHS'
            ],
            [
                'nim' => '9876543210',
                'angkatan' => 2023,
                'nama' => 'Vidi Joshubzky',
                'password' => Hash::make('12345'),
                'prodi' => 'Teknik Informatika',
                'level' => 'MHS'
            ],
        ]);
    }
}
