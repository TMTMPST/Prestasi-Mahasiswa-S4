<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;
use App\Models\Tingkat;
use App\Models\Jenis;
use App\Models\Dosen;
use App\Models\Bimbingan;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data lomba lengkap dengan relasi tingkat, kategori, dan jenis
        $lombas = DataLomba::with(['tingkatRelasi','jenisRelasi'])->get();

        // Ambil semua data mahasiswa, urutkan berdasarkan poin tertinggi
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

        // Kirim data ke view dashboard dosen
        return view('dosen.dashboard', compact('lombas', 'mahasiswa'));
    }

    // LOMBA
    public function infoLomba()
{   
    $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();

    return view('dosen.lomba.index', compact('lombas'));
}

    public function CreateInfoLomba()
{
    $tingkats = Tingkat::all();
    $jeniss = Jenis::all();

    return view('dosen.lomba.create', compact('tingkats', 'jeniss'));
}   

    

public function storeInfoLomba(Request $request)
{
    $request->validate([
        'nama_lomba' => 'required|string|max:255',
        'tingkat' => 'required|exists:tingkats,id',
        'jenis' => 'required|exists:jenis_lombas,id',
        'penyelenggara' => 'required|string|max:255',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    DataLomba::create([
        'nama_lomba' => $request->input('nama_lomba'),
        'tingkat_id' => $request->input('tingkat'),
        'jenis_id' => $request->input('jenis'),
        'penyelenggara' => $request->input('penyelenggara'),
        'tanggal_mulai' => $request->input('tanggal_mulai'),
        'tanggal_selesai' => $request->input('tanggal_selesai'),
        'status' => 'menunggu', // Status default menunggu verifikasi
        'dosen_id' => Auth::id(), // Mengambil ID user yang login sebagai dosen
    ]);

    return redirect()->route('dosen.dashboard')->with('success', 'Informasi lomba berhasil dikirim ke admin untuk diverifikasi.');
}


    public function showLomba($id)
    {
        // Ambil detail lomba berdasarkan ID beserta relasinya
        $lomba = DataLomba::with(['tingkatRelasi','jenisRelasi'])->findOrFail($id);

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
    $dosen = session('user');

    if (!$dosen) {
        return redirect()->route('login')->withErrors('Session dosen tidak ditemukan.');
    }

    $bimbingan = Bimbingan::where('nip', $dosen->nip)->get();   
    $mahasiswa = Mahasiswa::where('dosen_nip', $dosen->nip)->get();
    

    return view('dosen.Bimbingan.index', compact('mahasiswa', 'bimbingan'));
}

public function showPrestasiMhs($nim)
{
    $mahasiswa = Mahasiswa::with('prestasis')->where('nim', $nim)->firstOrFail();
    return view('dosen.Bimbingan.prestasi', compact('mahasiswa'));
}

public function profile()
{
    // $dosen = session('user');
    // Jika ingin ambil dari model:
    $dosen = Dosen::where('nip', session('user')->nip)->first();
    return view('dosen.Profile.index', compact('dosen'));
}

public function showUpdateProfile($nip)
{
    $dosen = Dosen::where('nip', $nip)->firstOrFail();
    return view('dosen.Profile.update_profile', compact('dosen'));
}

public function updateProfileAction(Request $request, $nip)
{
    $dosen = Dosen::where('nip', $nip)->firstOrFail();
    $dosen->update($request->only(['nama', 'email', 'bidangMinat']));
    return redirect()->route('dosen.profile.index')->with('success', 'Profil berhasil diperbarui.');
}
}
