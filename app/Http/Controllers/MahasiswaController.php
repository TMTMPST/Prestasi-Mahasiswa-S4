<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data lomba lengkap dengan relasi tingkat, kategori, dan jenis
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Ambil semua data mahasiswa, urutkan berdasarkan poin tertinggi
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

        // Kirim data ke view dashboard dosen
        return view('mahasiswa.dashboard', compact('lombas', 'mahasiswa'));
    }

    // PRESTASIII

    public function prestasi()
    {   
        // Ambil semua data lomba dengan relasi jika diperlukan
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Tampilkan halaman data prestasi
        return view('mahasiswa.prestasi.index', compact('lombas'));
    }

    public function create_prestasi()
    {   
        // Tampilkan halaman tambah_prestasi
        return view('mahasiswa.prestasi.tambah_prestasi');
    }

    // BIMBINGANNN

    public function bimbingan()
    {   
        // Tampilkan halaman data bimbingan 
        return view('mahasiswa.bimbingan.index');
    }

    public function create_bimbingan()
    {   
        // Tampilkan halaman tambah_bimbingan
        return view('mahasiswa.bimbingan.tambah_bimbingan');
    }


    // VERIFIKASIII

    public function verifikasi()
    {   
        // Tampilkan halaman data verifikasi 
        return view('mahasiswa.verifikasi.index');
    }
}
