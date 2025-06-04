<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LevelSeeder::class,
            MahasiswaSeeder::class,
            KeahlianMahasiswaSeeder::class,
            DosenSeeder::class,
            AdminSeeder::class,
            TingkatSeeder::class,
            JenisSeeder::class,
            DataLombaSeeder::class,
            DataPrestasiSeeder::class,
            BimbinganSeeder::class,
            
        ]);
    }
}
