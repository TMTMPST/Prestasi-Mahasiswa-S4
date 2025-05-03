<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('program_studi')->insert([
            ['nama' => 'Teknik Informatika', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sistem Informasi Bisnis', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
