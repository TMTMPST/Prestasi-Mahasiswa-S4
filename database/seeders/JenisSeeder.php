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
            ['id_jenis' => 1, 'nama_jenis' => 'Software Engineering / Product Design'],
            ['id_jenis' => 2, 'nama_jenis' => 'Web Development'],
            ['id_jenis' => 3, 'nama_jenis' => 'Mobile App Development'],
            ['id_jenis' => 4, 'nama_jenis' => 'Game Development'],
            ['id_jenis' => 5, 'nama_jenis' => 'Smart City Innovation'],
            ['id_jenis' => 6, 'nama_jenis' => 'Startup Pitch / Technopreneurship'],
            ['id_jenis' => 7, 'nama_jenis' => 'Hackathon'],
            ['id_jenis' => 8, 'nama_jenis' => 'Design Thinking Challenge'],
            ['id_jenis' => 9, 'nama_jenis' => 'Artificial Intelligence (AI)'],
            ['id_jenis' => 10, 'nama_jenis' => 'Machine Learning (ML)'],
            ['id_jenis' => 11, 'nama_jenis' => 'Big Data'],
            ['id_jenis' => 12, 'nama_jenis' => 'Data Science Challenge'],
            ['id_jenis' => 13, 'nama_jenis' => 'Ethical Hacking'],
            ['id_jenis' => 14, 'nama_jenis' => 'CTF (Capture The Flag)'],
            ['id_jenis' => 15, 'nama_jenis' => 'Digital Forensics'],
            ['id_jenis' => 16, 'nama_jenis' => 'Cloud Computing'],
            ['id_jenis' => 17, 'nama_jenis' => 'Internet of Things (IoT)'],
            ['id_jenis' => 18, 'nama_jenis' => 'UI/UX'],
            ['id_jenis' => 19, 'nama_jenis' => 'Poster Digital / Infografis'],
            ['id_jenis' => 20, 'nama_jenis' => 'Board Game Design'],
            ['id_jenis' => 21, 'nama_jenis' => 'Short Movie / Film Pendek'],
            ['id_jenis' => 22, 'nama_jenis' => 'Fotografi / Videografi'],
            ['id_jenis' => 23, 'nama_jenis' => 'Senam Kreasi / Tari Tradisional'],
            ['id_jenis' => 24, 'nama_jenis' => 'Pidato / Debat Bahasa Inggris / Indonesia'],
            ['id_jenis' => 25, 'nama_jenis' => 'Lomba Karya Tulis Ilmiah (LKTI)'],
            ['id_jenis' => 26, 'nama_jenis' => 'Competitive Programming / Speed Programming'],
            ['id_jenis' => 27, 'nama_jenis' => 'Augmented Reality / Virtual Reality (AR/VR)'],
            ['id_jenis' => 28, 'nama_jenis' => 'E-sport'],
            ['id_jenis' => 29, 'nama_jenis' => 'Sport'],
        ]);
    }
}
