<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis')->insert([
            ['id_jenis' => 1, 'nama_jenis' => 'Competitive Programming'],
            ['id_jenis' => 2, 'nama_jenis' => 'Cyber Security'],
            ['id_jenis' => 3, 'nama_jenis' => 'Software Development'],
            ['id_jenis' => 4, 'nama_jenis' => 'Coding Marathon'],
            ['id_jenis' => 5, 'nama_jenis' => 'Data Science'],
            ['id_jenis' => 6, 'nama_jenis' => 'Artificial Intelligence'],
            ['id_jenis' => 7, 'nama_jenis' => 'Interface Design'],
            ['id_jenis' => 8, 'nama_jenis' => 'Game Development'],
            ['id_jenis' => 9, 'nama_jenis' => 'Network Challenge'],
            ['id_jenis' => 10, 'nama_jenis' => 'Robotics Competition'],
            ['id_jenis' => 11, 'nama_jenis' => 'IoT Challenge'],
            ['id_jenis' => 12, 'nama_jenis' => 'Business Case'],
            ['id_jenis' => 13, 'nama_jenis' => 'Mobile Development'],
            ['id_jenis' => 14, 'nama_jenis' => 'Web Development'],
            ['id_jenis' => 15, 'nama_jenis' => 'Digital Animation'],
            ['id_jenis' => 16, 'nama_jenis' => 'Cloud Computing'],
            ['id_jenis' => 17, 'nama_jenis' => 'Digital Forensics'],
            ['id_jenis' => 18, 'nama_jenis' => 'Cryptography Challenge'],
            ['id_jenis' => 19, 'nama_jenis' => 'UI/UX Design'],
            ['id_jenis' => 20, 'nama_jenis' => 'Hackathon'],
            ['id_jenis' => 21, 'nama_jenis' => 'Startup Pitch'],
            ['id_jenis' => 22, 'nama_jenis' => 'Algorithm Design'],
            ['id_jenis' => 23, 'nama_jenis' => 'Machine Learning'],
            ['id_jenis' => 24, 'nama_jenis' => 'Augmented Reality'],
            ['id_jenis' => 25, 'nama_jenis' => 'Virtual Reality'],
            ['id_jenis' => 26, 'nama_jenis' => 'Blockchain Challenge'],
            ['id_jenis' => 27, 'nama_jenis' => 'App Innovation'],
            ['id_jenis' => 28, 'nama_jenis' => 'Database Design'],
            ['id_jenis' => 29, 'nama_jenis' => 'Digital Marketing'],
            ['id_jenis' => 30, 'nama_jenis' => 'E-Sports Tournament'],
        ]);
    }
}
