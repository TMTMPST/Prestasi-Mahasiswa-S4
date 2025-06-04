<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('mahasiswa')->insert([
            [
                'nama' => 'Diana Rahmawati',
                'nim' => '2341720162',
                'angkatan' => 2023,
                'dosen_nip' => null,
                'level' => 'MHS',
                'password' => Hash::make('12345'),
                'poin_presma' => 8,
                'prestasi_tertinggi' => 'Juara 1 Lomba Programming',
                'prodi' => 'Teknik Informatika',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Tionusa Catur Pamungkas',
                'nim' => '2341720093',
                'angkatan' => 2023,
                'dosen_nip' => null,
                'level' => 'MHS',
                'password' => Hash::make('12345'),
                'poin_presma' => 7,
                'prestasi_tertinggi' => 'Finalis Lomba Karya Tulis Ilmiah',
                'prodi' => 'Teknik Informatika',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Varizky Naldiba Rimra',
                'nim' => '2341720243',
                'angkatan' => 2023,
                'dosen_nip' => null,
                'level' => 'MHS',
                'password' => Hash::make('12345'),
                'poin_presma' => 9,
                'prestasi_tertinggi' => 'Juara 2 Lomba Software Engineering',
                'prodi' => 'Teknik Informatika',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Vidi Joshubzky Saviola',
                'nim' => '2341720112',
                'angkatan' => 2023,
                'dosen_nip' => null,
                'level' => 'MHS',
                'password' => Hash::make('12345'),
                'poin_presma' => 6,
                'prestasi_tertinggi' => 'Peserta Seminar Nasional',
                'prodi' => 'Teknik Informatika',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
