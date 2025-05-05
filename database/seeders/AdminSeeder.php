<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin')->insert([
            [
                'nip' => '12345',
                'nama' => 'Administrator 1',
                'level' => 'ADM',
                'password' => Hash::make('admin123'),
            ],
            [
                'nip' => '54321',
                'nama' => 'Administrator 2',
                'level' => 'ADM',
                'password' => Hash::make('admin123'),
            ],
        ]);
    }
}
