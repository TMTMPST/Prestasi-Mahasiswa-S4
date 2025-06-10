<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run()
    {
        DB::table('dosen')->insert([
            [
                'nip' => '123456789012345',
                'nama' => 'Bunga Janarti F. SPd., M.Kom',
                'email' => 'bunga.janarti@example.com', // tambahkan email di sini
                'password' => Hash::make('12345'),
                'level' => 'DSN',
                'bidangMinat' => 1, // id_jenis yang valid dari tabel jenis
            ],
        ]);
    }
}
