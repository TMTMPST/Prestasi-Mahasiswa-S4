<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendaftaranLombaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pendaftaran_lomba')->insert([
            [
                'mahasiswa_id'   => 1,
                'kompetisi_id'   => 1,
                'tanggal_daftar' => Carbon::now()->subDays(10)->toDateString(),
                'status'         => 'terdaftar',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'mahasiswa_id'   => 2,
                'kompetisi_id'   => 2,
                'tanggal_daftar' => Carbon::now()->subDays(5)->toDateString(),
                'status'         => 'lolos',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
