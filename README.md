# Sistem Informasi Prestasi Mahasiswa dengan DSS PROMETHEE

## Deskripsi Proyek
Sistem Informasi Prestasi Mahasiswa adalah aplikasi berbasis web yang dikembangkan untuk membantu mengelola dan menganalisis prestasi mahasiswa di lingkungan akademik Politeknik Negeri Malang. Sistem ini dilengkapi dengan Decision Support System (DSS) menggunakan metode PROMETHEE (Preference Ranking Organization Method for Enrichment Evaluation) yang memungkinkan pengambilan keputusan berdasarkan multi-kriteria untuk menentukan mahasiswa berprestasi.

## Teknologi yang Digunakan
- **Framework:** Laravel
- **Template Admin:** CoreUI
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Metode DSS:** PROMETHEE (Preference Ranking Organization Method for Enrichment Evaluation)

## Fitur Utama
- Manajemen data mahasiswa
- Pencatatan dan pengelolaan prestasi akademik dan non-akademik
- Visualisasi prestasi mahasiswa dalam bentuk grafik dan laporan
- Sistem pendukung keputusan PROMETHEE untuk menentukan mahasiswa berprestasi berdasarkan multi-kriteria
- Dashboard interaktif untuk memantau performa mahasiswa
- Manajemen pengguna dengan berbagai level akses (admin, dosen, mahasiswa)
- Sistem notifikasi
- Laporan dan ekspor data

## Instalasi

### Prasyarat
- PHP >= 8.0
- Composer
- Node.js dan NPM
- MySQL


## Struktur Database
Sistem ini memiliki beberapa tabel utama:
- Users
- Mahasiswa
- Prestasi
- Kriteria
- Penilaian
- dan tabel pendukung lainnya

## Implementasi Metode PROMETHEE
Metode PROMETHEE diimplementasikan untuk menentukan mahasiswa berprestasi dengan langkah-langkah:
1. Penentuan alternatif dan kriteria
2. Penentuan dominasi kriteria
3. Perhitungan nilai preferensi
4. Perhitungan indeks preferensi multikriteria
5. Perhitungan leaving flow dan entering flow
6. Perhitungan net flow
7. Penentuan rangking berdasarkan net flow

## Tim Pengembang
Proyek ini dikembangkan oleh tim dari kelas TI 2F Politeknik Negeri Malang:
1. DIANA RAHMAWATI
2. FAJAR ADITYA NUGRAHA
3. TIONUSA CATUR PAMUNGKAS
4. VARIZKY NALDIBA RIMRA
5. Vidi Joshubzky Saviola

## Screenshot Aplikasi
![Dashboard](/screenshots/dashboard.jpg)
![Penilaian](/screenshots/penilaian.jpg)
![Hasil PROMETHEE](/screenshots/hasil-promethee.jpg)

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE)

## Kontak
Untuk pertanyaan dan informasi lebih lanjut, silakan hubungi:
- Email: vidoelag@gmail.com
- Program Studi Teknik Informatika
- Politeknik Negeri Malang