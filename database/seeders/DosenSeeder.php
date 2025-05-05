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
                'nama' => 'Endah Septa Sintiya. SPd., M.Kom',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '987654321098765',
                'nama' => 'Irsyad Arif Mashudi, S.Kom., M.Kom',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
        ]);
    }
}
