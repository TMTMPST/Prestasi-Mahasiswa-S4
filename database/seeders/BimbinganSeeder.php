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
    'id_bimbingan' => 1,
    'id_lomba' => 1,
    'nama_anggota' => 'Var',
    'nip' => '123456789012345',
    'nim' => '220401010001', // contoh
    'status' => 'Pending',
]);


    }
}
