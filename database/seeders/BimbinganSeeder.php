<?php

namespace Database\Seeders;

use App\Models\Bimbingan;
use Illuminate\Database\Seeder;

class BimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bimbingan::create([
            'id_bimbingan' => 1,
            'id_lomba' => 1,
            'nama_pengaju' => 'Varizky Naldiba Rimra',
            'nip' => '123456789012345',
            'nim' => '2341720243',
            'deskripsi_lomba' => 'Lomba Karya Tulis Ilmiah Nasional',
            'status' => 'Pending',
        ]);

        Bimbingan::create([
            'id_bimbingan' => 2,
            'id_lomba' => 2,
            'nama_pengaju' => 'Diana Rahmawati',
            'nip' => '123456789012345',
            'nim' => '2341720162',
            'deskripsi_lomba' => 'Lomba Inovasi Teknologi Mahasiswa',
            'status' => 'Accepted',
        ]);

        Bimbingan::create([
            'id_bimbingan' => 3,
            'id_lomba' => 3,
            'nama_pengaju' => 'Vidi Joshubzky Saviola',
            'nip' => '123456789012345',
            'nim' => '2341720112',
            'deskripsi_lomba' => 'Lomba Debat Bahasa Inggris',
            'status' => 'Rejected',
        ]);
    }
}
