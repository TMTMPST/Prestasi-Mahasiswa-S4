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
            [
                'nip' => '111111111111111',
                'nama' => 'Budi Santoso, M.Pd',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '222222222222222',
                'nama' => 'Siti Aminah, S.Pd., M.Pd',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '333333333333333',
                'nama' => 'Agus Prasetyo, M.Kom',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '444444444444444',
                'nama' => 'Dewi Lestari, S.Kom., M.Kom',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '555555555555555',
                'nama' => 'Rizky Hidayat, M.Pd',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '666666666666666',
                'nama' => 'Nurul Fadilah, S.Pd., M.Pd',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '777777777777777',
                'nama' => 'Ahmad Fauzi, M.Kom',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '888888888888888',
                'nama' => 'Lina Marlina, S.Kom., M.Kom',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '999999999999999',
                'nama' => 'Yusuf Maulana, M.Pd',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
            [
                'nip' => '101010101010101',
                'nama' => 'Sri Wahyuni, S.Pd., M.Pd',
                'password' => Hash::make('12345'),
                'level' => 'DOS'
            ],
        ]);
    }
}
