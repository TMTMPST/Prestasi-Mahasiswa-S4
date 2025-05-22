<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;
use App\Models\Tingkat;
use App\Models\Kategori;
use App\Models\Jenis;

class DosenController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data lomba lengkap dengan relasi tingkat, kategori, dan jenis
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Ambil semua data mahasiswa, urutkan berdasarkan poin tertinggi
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

        // Kirim data ke view dashboard dosen
        return view('dosen.dashboard', compact('lombas', 'mahasiswa'));
    }

    // LOMBA
    public function infoLomba()
{   
    $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

    return view('dosen.lomba.index', compact('lombas'));
}

    public function CreateInfoLomba()
{
    $tingkats = Tingkat::all();
    $kategoris = Kategori::all();
    $jeniss = Jenis::all();

    return view('dosen.lomba.create', compact('tingkats', 'kategoris', 'jeniss'));
}   

    public function DeleteInfoLomba($id)
    {
        // Hapus informasi lomba berdasarkan ID
        $lomba = DataLomba::findOrFail($id);
        $lomba->delete();

        // Redirect ke halaman dashboard dosen dengan pesan sukses
        return redirect()->route('dosen.dashboard')->with('success', 'Informasi lomba berhasil dihapus.');
    }

    public function storeInfoLomba(Request $request)
    {
        // Validasi data yang diterima dari form
            $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'required|exists:tingkats,id',
            'kategori' => 'required|exists:kategoris,id',
            'jenis' => 'required|exists:jenis_lombas,id',
            'penyelenggara' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

            DataLomba::create([
            'nama_lomba' => $request->input('nama_lomba'),
            'tingkat_id' => $request->input('tingkat'),
            'kategori_id' => $request->input('kategori'),
            'jenis_id' => $request->input('jenis'),
            'penyelenggara' => $request->input('penyelenggara'),
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
        ]);


        // Redirect ke halaman dashboard dosen dengan pesan sukses
        return redirect()->route('dosen.dashboard')->with('success', 'Informasi lomba berhasil ditambahkan.');
    }

    public function showLomba($id)
    {
        // Ambil detail lomba berdasarkan ID beserta relasinya
        $lomba = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->findOrFail($id);

        // Tampilkan view detail lomba
        return view('dosen.lomba.show', compact('lomba'));
    }
    // LOMBA

    public function Presma()
{
    // Ambil semua data mahasiswa, urutkan berdasarkan poin tertinggi
    $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

    // Tampilkan view presma (pastikan view 'dosen.presma.index' ada)
    return view('dosen.presma.index', compact('mahasiswa'));
}

    public function Bimbingan()
    {
        return view('dosen.bimbingan.index');
    }
    
}
