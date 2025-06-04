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
            JenisSeeder::class,
            KeahlianMahasiswaSeeder::class,
            DosenSeeder::class,
            AdminSeeder::class,
            TingkatSeeder::class,
            DataLombaSeeder::class,
            DataPrestasiSeeder::class,
            BimbinganSeeder::class,
            
        ]);
    }
}
