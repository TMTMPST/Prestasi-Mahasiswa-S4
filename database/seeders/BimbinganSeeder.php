<?php

namespace Database\Seeders;

use App\Models\Bimbingan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bimbingan::create([
            'id_lomba' => 1,
            'nama_anggota' => 'Diana, Jos, Variz, Tio',
            'nip' => '987654321098765',
            'status' => 'Pending',
        ]);
    }
}
