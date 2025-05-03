<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periode')->insert([
            [
                'semester' => '2025/2026 Gasal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'semester' => '2025/2026 Genap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'semester' => '2024/2025 Gasal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
