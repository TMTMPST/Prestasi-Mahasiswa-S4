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
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();
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
            'status' => 'menunggu',
            'dosen_id' => Auth::id(),
        ]);

        return redirect()->route('dosen.dashboard')->with('success', 'Informasi lomba berhasil dikirim ke admin untuk diverifikasi.');
    }

    public function showLomba($id)
    {
        $lomba = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->findOrFail($id);
        return view('dosen.lomba.show', compact('lomba'));
    }
    // END LOMBA

    public function Presma()
    {
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();
        return view('dosen.presma.index', compact('mahasiswa'));
    }

    public function Bimbingan()
{
    $sessionUser = session('user');
    if (!$sessionUser) {
        return redirect()->route('login')->withErrors('Session dosen tidak ditemukan.');
    }

    $dosen = Dosen::where('nip', $sessionUser->nip)->first();
    if (!$dosen) {
        return redirect()->route('login')->withErrors('Dosen tidak ditemukan.');
    }

    // Pisahkan request dan accepted
    $bimbinganRequest = Bimbingan::where('nip', $dosen->nip)->where('status', 'Pending')->get();
    $bimbinganAccepted = Bimbingan::where('nip', $dosen->nip)->where('status', 'Accepted')->get();

    return view('dosen.Bimbingan.index', compact('bimbinganRequest', 'bimbinganAccepted'));
}

    public function acceptBimbingan($nim)
    {
        $bimbingan = Bimbingan::where('nim', $nim)->firstOrFail();
        $bimbingan->status = 'Accepted'; // Sesuai enum di DB
        $bimbingan->save();

        // Update dosen_nip pada mahasiswa jika belum diisi
        $mahasiswa = Mahasiswa::where('nim', $bimbingan->nim)->first();
        if ($mahasiswa && empty($mahasiswa->dosen_nip)) {
            $mahasiswa->dosen_nip = $bimbingan->nip;
            $mahasiswa->save();
        }

        return back()->with('success', 'Bimbingan diterima.');
    }

    public function rejectBimbingan($nim)
    {
        $bimbingan = Bimbingan::where('nim', $nim)->firstOrFail();
        $bimbingan->status = 'Rejected'; // Sesuai enum di DB
        $bimbingan->save();

        return back()->with('success', 'Bimbingan ditolak.');
    }

    public function showPrestasiMhs($nim)
    {
        $mahasiswa = Mahasiswa::with('prestasis')->where('nim', $nim)->firstOrFail();
        return view('dosen.Bimbingan.prestasi', compact('mahasiswa'));
    }

    public function profile()
    {
        $sessionUser = session('user');
        $dosen = Dosen::where('nip', $sessionUser->nip)->first();
        return view('dosen.Profile.index', compact('dosen'));
    }

    public function showUpdateProfile($nip)
    {
        $dosen = Dosen::where('nip', $nip)->firstOrFail();
        return view('dosen.Profile.update_profile', compact('dosen'));
    }

    public function updateProfileAction(Request $request, $nip)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bidangMinat' => 'nullable|string|max:255',
        ]);
        $dosen = Dosen::where('nip', $nip)->firstOrFail();
        $dosen->update($request->only(['nama', 'email', 'bidangMinat']));
        return redirect()->route('dosen.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}