<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;
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
        $request->validate([
            'level' => 'required|in:MHS,DSN,ADM',
            'nim_nip_username' => 'required|string|max:15|unique:mahasiswa,nim|unique:dosen,nip|unique:admin,username',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'angkatan' => 'nullable|integer',
            'prodi' => 'nullable|string|max:255',
        ]);

        switch ($request->input('level')) {
            case 'MHS':
                Mahasiswa::create([
                    'nim' => $request->input('nim_nip_username'),
                    'nama' => $request->input('nama'),
                    'password' => Hash::make($request->input('password')),
                    'angkatan' => $request->input('angkatan'),
                    'prodi' => $request->input('prodi'),
                    'level' => $request->input('level'),
                ]);
                break;

            case 'DSN':
                Dosen::create([
                    'nip' => $request->input('nim_nip_username'),
                    'nama' => $request->input('nama'),
                    'password' => Hash::make($request->input('password')),
                    'level' => $request->input('level'),
                ]);
                break;

            case 'ADM':
                echo 'Creating admin user with username';
                // Log the creation of an admin user
                Admin::create([
                    'username' => $request->input('nim_nip_username'),
                    'nama' => $request->input('nama'),
                    'password' => Hash::make($request->input('password')),
                    'level' => $request->input('level'),
                ]);
                break;

            default:
                return redirect()->back()->withErrors(['level' => 'Level tidak valid.']);
        }

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function deletePengguna($id)
    {
        // Hapus pengguna berdasarkan ID
        echo 'Deleting user with ID: ' . $id;
        $pengguna = Mahasiswa::find($id) ?? Dosen::find($id) ?? Admin::find($id);

        if ($pengguna) {
            $pengguna->delete();
            return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->route('admin.pengguna.index')->withErrors(['error' => 'Pengguna tidak ditemukan.']);
        }
    }
    public function editPengguna($id)
    {
        // Ambil pengguna berdasarkan ID
        $pengguna = Mahasiswa::find($id) ?? Dosen::find($id) ?? Admin::find($id);

        if (!$pengguna) {
            return redirect()->route('admin.pengguna.index')->withErrors(['error' => 'Pengguna tidak ditemukan.']);
        }

        // Ambil semua level untuk dropdown
        $levels = Level::all();

        // Tampilkan halaman edit pengguna
        return view('admin.Pengguna.editPengguna', compact('pengguna', 'levels'));
    }
    public function updatePengguna(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'level' => 'required|in:MHS,DSN,ADM',
            'nim_nip_username' => 'required|string|max:15|unique:mahasiswa,nim|unique:dosen,nip|unique:admin,username',
            'nama' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'angkatan' => 'nullable|integer',
            'prodi' => 'nullable|string|max:255',
        ]);

        // Update pengguna berdasarkan level
        switch ($request->input('level')) {
            case 'MHS':
                $pengguna = Mahasiswa::find($id);
                if (!$pengguna) {
                    return redirect()->back()->withErrors(['error' => 'Mahasiswa tidak ditemukan.']);
                }
                $pengguna->update([
                    'nim' => $request->input('nim_nip_username'),
                    'nama' => $request->input('nama'),
                    'angkatan' => $request->input('angkatan'),
                    'prodi' => $request->input('prodi'),
                    'level' => $request->input('level'),
                ]);
                break;

            case 'DSN':
                $pengguna = Dosen::find($id);
                if (!$pengguna) {
                    return redirect()->back()->withErrors(['error' => 'Dosen tidak ditemukan.']);
                }
                $pengguna->update([
                    'nip' => $request->input('nim_nip_username'),
                    'nama' => $request->input('nama'),
                    'level' => $request->input('level'),
                ]);
                break;

            case 'ADM':
                $pengguna = Admin::find($id);
                if (!$pengguna) {
                    return redirect()->back()->withErrors(['error' => 'Admin tidak ditemukan.']);
                }
                $pengguna->update([
                    'username' => $request->input('nim_nip_username'),
                    'nama' => $request->input('nama'),
                    'level' => $request->input('level'),
                ]);
                break;

            default:
                return redirect()->back()->withErrors(['level' => 'Level tidak valid.']);
        }

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }
}
