<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProgramStudiSeeder::class, // Program studi harus ada sebelum mahasiswa
            UsersSeeder::class,        // Users harus ada sebelum mahasiswa
            MahasiswaSeeder::class,   // Mahasiswa bergantung pada program studi dan users
            DosenSeeder::class,       // Dosen tidak memiliki dependensi
            KompetisiSeeder::class,   // Kompetisi harus ada sebelum pendaftaran lomba
            PrestasiSeeder::class,    // Prestasi mungkin bergantung pada mahasiswa
            PendaftaranLombaSeeder::class, // Pendaftaran lomba bergantung pada kompetisi dan mahasiswa
            RekomendasiLombaSeeder::class, // Rekomendasi lomba mungkin bergantung pada pendaftaran lomba
            PeriodeSeeder::class,     // Periode tidak memiliki dependensi
            AdminSeeder::class,       // Admin tidak memiliki dependensi
        ]);
    }
}
