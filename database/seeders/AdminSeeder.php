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
                'username' => 'admin1',
                'nama' => 'Administrator 1',
                'level' => 'ADM',
                'password' => Hash::make('admin123'),
            ],
            [
                'username' => 'admin2',
                'nama' => 'Administrator 2',
                'level' => 'ADM',
                'password' => Hash::make('admin123'),
            ],
        ]);
    }
}
