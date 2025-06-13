<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LevelSeeder::class,
            TingkatSeeder::class,
            JenisSeeder::class,
            ProgramStudiSeeder::class, // Add this line
            DosenSeeder::class,
            MahasiswaSeeder::class,
            KeahlianMahasiswaSeeder::class,
            AdminSeeder::class,
            DataLombaSeeder::class,
            DataPrestasiSeeder::class,
            BimbinganSeeder::class,
            
        ]);
    }
}
