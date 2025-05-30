<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Level;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data lomba lengkap dengan relasi tingkat, kategori, dan jenis
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Ambil semua data mahasiswa, urutkan berdasarkan poin tertinggi
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

        // Kirim data ke view dashboard dosen
        return view('admin.dashboard', compact('lombas', 'mahasiswa'));
    }

    public function showPengguna()
    {
        $mahasiswa = Mahasiswa::select('level', 'nama', 'nim')->get();
        $dosen = Dosen::select('level', 'nama', 'nip')->get();
        $admin = Admin::select('level', 'nama', 'username')->get();

        // Gabungkan data mahasiswa, dosen, dan admin
        $pengguna = $mahasiswa->merge($dosen)->merge($admin);
        // Urutkan berdasarkan level
        $pengguna = $pengguna->sortByDesc('level');
        // Ambil data mahasiswa saja
        $mahasiswa = $pengguna->where('level', 'mahasiswa')->values();
        // Ambil data dosen saja
        $dosen = $pengguna->where('level', 'dosen')->values();
        // Ambil data admin saja
        $admin = $pengguna->where('level', 'admin')->values();
        // Ambil data level
        $levels = Level::all();

        // Kirim data ke view pengguna
        return view('admin.Pengguna.index', compact('pengguna', 'mahasiswa', 'dosen', 'admin', 'levels'));
    }

    public function createPengguna()
    {
        // Ambil semua level untuk dropdown
        $levels = Level::all();

        // Tampilkan halaman tambah pengguna
        return view('admin.Pengguna.tambahPengguna', compact('levels'));
    }
    public function storePengguna(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'level' => 'required|in:MHS,DSN,ADM',
            'nim_nip_username' => 'required|string|max:15|unique:mahasiswa,nim|unique:dosen,nip|unique:admin,username',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'angkatan' => 'nullable|integer',
            'prodi' => 'nullable|string|max:255',
        ]);
        
        switch ($validated['level']) {
            case 'MHS':
                // Simpan data mahasiswa
                Mahasiswa::create([
                    'nim' => $validated['nim_nip_username'],
                    'nama' => $validated['nama'],
                    'password' => bcrypt($validated['password']),
                    'angkatan' => $validated['angkatan'],
                    'prodi' => $validated['prodi'],
                    'level' => $validated['level'],
                ]);
                break;
                
            case 'DSN':
                // Simpan data dosen
                Dosen::create([
                    'nip' => $validated['nim_nip_username'],
                    'nama' => $validated['nama'],
                    'password' => bcrypt($validated['password']),
                    'level' => $validated['level'],
                ]);
                break;

            case 'ADM':
                // Simpan data admin
                Admin::create([
                    'username' => $validated['nim_nip_username'],
                    'nama' => $validated['nama'],
                    'password' => bcrypt($validated['password']),
                    'level' => $validated['level'],
                ]);
                break;

            default:
                return redirect()->back()->withErrors(['level' => 'Level tidak valid.']);
        }

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }
}
