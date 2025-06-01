<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataLombaSeeder extends Seeder
{
    public function run()
    {
        DB::table('data_lomba')->insert([
            [
                'nama_lomba' => 'Lomba IT Nasional',
                'tgl_dibuka' => '2025-01-01',
                'tgl_ditutup' => '2025-02-01',
                'tingkat' => 3,
                'kategori' => 1,
                'jenis' => 1, // Software Engineering / Product Design
                'penyelenggara' => 'Universitas Brawijaya',
                'alamat' => 'Jl. Veteran No. 1, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Desain Grafis Kota',
                'tgl_dibuka' => '2025-03-01',
                'tgl_ditutup' => '2025-04-01',
                'tingkat' => 1,
                'kategori' => 2,
                'jenis' => 19, // Poster Digital / Infografis
                'penyelenggara' => 'Politeknik Negeri Malang',
                'alamat' => 'Jl. Soekarno Hatta No. 10, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Hackathon Provinsi Jawa Timur',
                'tgl_dibuka' => '2025-02-10',
                'tgl_ditutup' => '2025-03-10',
                'tingkat' => 2,
                'kategori' => 1,
                'jenis' => 7, // Hackathon
                'penyelenggara' => 'Diskominfo Jatim',
                'alamat' => 'Jl. Pahlawan No. 110, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Olimpiade Matematika Regional',
                'tgl_dibuka' => '2025-04-15',
                'tgl_ditutup' => '2025-05-15',
                'tingkat' => 2,
                'kategori' => 1,
                'jenis' => 25, // Lomba Karya Tulis Ilmiah (LKTI)
                'penyelenggara' => 'Ikatan Matematika Indonesia',
                'alamat' => 'Jl. Diponegoro No. 20, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Business Plan Competition Nasional',
                'tgl_dibuka' => '2025-06-01',
                'tgl_ditutup' => '2025-07-01',
                'tingkat' => 3,
                'kategori' => 2,
                'jenis' => 6, // Startup Pitch / Technopreneurship
                'penyelenggara' => 'Universitas Indonesia',
                'alamat' => 'Jl. Salemba Raya No. 4, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Robotik SMA',
                'tgl_dibuka' => '2025-07-10',
                'tgl_ditutup' => '2025-08-10',
                'tingkat' => 1,
                'kategori' => 1,
                'jenis' => 17, // Internet of Things (IoT)
                'penyelenggara' => 'SMA Negeri 1 Malang',
                'alamat' => 'Jl. Tugu No. 1, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Cipta Puisi',
                'tgl_dibuka' => '2025-08-15',
                'tgl_ditutup' => '2025-09-15',
                'tingkat' => 2,
                'kategori' => 2,
                'jenis' => 25, // Lomba Karya Tulis Ilmiah (LKTI)
                'penyelenggara' => 'Balai Bahasa Jawa Timur',
                'alamat' => 'Jl. Raya Panjang Jiwo No. 48, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Fotografi Mahasiswa',
                'tgl_dibuka' => '2025-09-20',
                'tgl_ditutup' => '2025-10-20',
                'tingkat' => 3,
                'kategori' => 2,
                'jenis' => 22, // Fotografi / Videografi
                'penyelenggara' => 'Universitas Airlangga',
                'alamat' => 'Jl. Airlangga No. 4-6, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Debat Bahasa Inggris',
                'tgl_dibuka' => '2025-10-25',
                'tgl_ditutup' => '2025-11-25',
                'tingkat' => 2,
                'kategori' => 1,
                'jenis' => 24, // Pidato / Debat Bahasa Inggris / Indonesia
                'penyelenggara' => 'Universitas Negeri Malang',
                'alamat' => 'Jl. Semarang No. 5, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Karya Tulis Ilmiah',
                'tgl_dibuka' => '2025-11-30',
                'tgl_ditutup' => '2025-12-30',
                'tingkat' => 3,
                'kategori' => 1,
                'jenis' => 25, // Lomba Karya Tulis Ilmiah (LKTI)
                'penyelenggara' => 'Institut Teknologi Sepuluh Nopember',
                'alamat' => 'Jl. Raya ITS, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Tari Tradisional',
                'tgl_dibuka' => '2025-12-05',
                'tgl_ditutup' => '2026-01-05',
                'tingkat' => 1,
                'kategori' => 2,
                'jenis' => 23, // Senam Kreasi / Tari Tradisional
                'penyelenggara' => 'Dinas Kebudayaan Malang',
                'alamat' => 'Jl. Majapahit No. 2, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Startup Mahasiswa',
                'tgl_dibuka' => '2026-01-10',
                'tgl_ditutup' => '2026-02-10',
                'tingkat' => 3,
                'kategori' => 2,
                'jenis' => 6, // Startup Pitch / Technopreneurship
                'penyelenggara' => 'Startup Campus',
                'alamat' => 'Jl. Startup No. 1, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Poster Digital',
                'tgl_dibuka' => '2026-02-15',
                'tgl_ditutup' => '2026-03-15',
                'tingkat' => 2,
                'kategori' => 2,
                'jenis' => 19, // Poster Digital / Infografis
                'penyelenggara' => 'Universitas Negeri Surabaya',
                'alamat' => 'Jl. Ketintang, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Coding Junior',
                'tgl_dibuka' => '2026-03-20',
                'tgl_ditutup' => '2026-04-20',
                'tingkat' => 1,
                'kategori' => 1,
                'jenis' => 26, // Competitive Programming / Speed Programming
                'penyelenggara' => 'SMK Negeri 2 Malang',
                'alamat' => 'Jl. Veteran No. 17, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Film Pendek',
                'tgl_dibuka' => '2026-04-25',
                'tgl_ditutup' => '2026-05-25',
                'tingkat' => 2,
                'kategori' => 2,
                'jenis' => 21, // Short Movie / Film Pendek
                'penyelenggara' => 'Komunitas Film Malang',
                'alamat' => 'Jl. Ijen No. 12, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Esai Nasional',
                'tgl_dibuka' => '2026-05-30',
                'tgl_ditutup' => '2026-06-30',
                'tingkat' => 3,
                'kategori' => 1,
                'jenis' => 25, // Lomba Karya Tulis Ilmiah (LKTI)
                'penyelenggara' => 'Universitas Gadjah Mada',
                'alamat' => 'Jl. Bulaksumur, Yogyakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Musik Akustik',
                'tgl_dibuka' => '2026-06-05',
                'tgl_ditutup' => '2026-07-05',
                'tingkat' => 1,
                'kategori' => 2,
                'jenis' => 29, // Sport (atau bisa buat jenis baru jika ada Musik)
                'penyelenggara' => 'Komunitas Musik Malang',
                'alamat' => 'Jl. Kawi No. 8, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Animasi Digital',
                'tgl_dibuka' => '2026-07-10',
                'tgl_ditutup' => '2026-08-10',
                'tingkat' => 2,
                'kategori' => 2,
                'jenis' => 27, // AR/VR (atau bisa buat jenis baru jika ada Animasi)
                'penyelenggara' => 'Politeknik Elektronika Negeri Surabaya',
                'alamat' => 'Jl. Raya ITS, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Pidato Bahasa Indonesia',
                'tgl_dibuka' => '2026-08-15',
                'tgl_ditutup' => '2026-09-15',
                'tingkat' => 1,
                'kategori' => 1,
                'jenis' => 24, // Pidato / Debat Bahasa Inggris / Indonesia
                'penyelenggara' => 'SMA Negeri 3 Malang',
                'alamat' => 'Jl. Bandung No. 7, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Inovasi Teknologi',
                'tgl_dibuka' => '2026-09-20',
                'tgl_ditutup' => '2026-10-20',
                'tingkat' => 3,
                'kategori' => 1,
                'jenis' => 5, // Smart City Innovation
                'penyelenggara' => 'Kementerian Ristek',
                'alamat' => 'Jl. MH Thamrin No. 8, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Cerdas Cermat',
                'tgl_dibuka' => '2026-10-25',
                'tgl_ditutup' => '2026-11-25',
                'tingkat' => 2,
                'kategori' => 1,
                'jenis' => 25, // Lomba Karya Tulis Ilmiah (LKTI) (atau buat jenis baru jika ada Cerdas Cermat)
                'penyelenggara' => 'Dinas Pendidikan Jawa Timur',
                'alamat' => 'Jl. Gentengkali No. 33, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Startup Regional',
                'tgl_dibuka' => '2026-11-30',
                'tgl_ditutup' => '2026-12-30',
                'tingkat' => 2,
                'kategori' => 2,
                'jenis' => 6, // Startup Pitch / Technopreneurship
                'penyelenggara' => 'Startup Hub Surabaya',
                'alamat' => 'Jl. Basuki Rahmat No. 10, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Vlog Kreatif',
                'tgl_dibuka' => '2026-12-05',
                'tgl_ditutup' => '2027-01-05',
                'tingkat' => 1,
                'kategori' => 2,
                'jenis' => 22, // Fotografi / Videografi
                'penyelenggara' => 'Komunitas Vlogger Malang',
                'alamat' => 'Jl. Simpang Balapan No. 3, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba UI/UX Design',
                'tgl_dibuka' => '2027-01-10',
                'tgl_ditutup' => '2027-02-10',
                'tingkat' => 3,
                'kategori' => 1,
                'jenis' => 18, // UI/UX
                'penyelenggara' => 'Universitas Padjadjaran',
                'alamat' => 'Jl. Dipati Ukur No. 35, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Video Edukasi',
                'tgl_dibuka' => '2027-02-15',
                'tgl_ditutup' => '2027-03-15',
                'tingkat' => 2,
                'kategori' => 2,
                'jenis' => 22, // Fotografi / Videografi
                'penyelenggara' => 'Dinas Pendidikan Malang',
                'alamat' => 'Jl. Veteran No. 2, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Game Development',
                'tgl_dibuka' => '2027-03-20',
                'tgl_ditutup' => '2027-04-20',
                'tingkat' => 3,
                'kategori' => 1,
                'jenis' => 4, // Game Development
                'penyelenggara' => 'Universitas Telkom',
                'alamat' => 'Jl. Telekomunikasi No. 1, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lomba' => 'Lomba Menulis Cerpen',
                'tgl_dibuka' => '2027-04-25',
                'tgl_ditutup' => '2027-05-25',
                'tingkat' => 1,
                'kategori' => 2,
                'jenis' => 25, // Lomba Karya Tulis Ilmiah (LKTI)
                'penyelenggara' => 'Komunitas Penulis Malang',
                'alamat' => 'Jl. Soekarno Hatta No. 15, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
