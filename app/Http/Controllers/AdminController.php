<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;
use App\Models\Admin;
use App\Models\DataPrestasi;
use App\Models\Dosen;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Level;
use App\Models\Tingkat;
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

    public function profile()
    {
        // $dosen = session('user');
        // Jika ingin ambil dari model:
        $admin = Admin::where('username', session('user')->username)->first();
        return view('admin.Profile.index', compact('admin'));
    }

    public function showUpdateProfile($id)
    {
        // Ambil data admin berdasarkan ID
        $admin = Admin::findOrFail($id);
        return view('admin.Profile.updateProfile', compact('admin'));
    }
    public function updateProfile(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:admin,username,' . $id . ',username',
            'password' => 'nullable|string|min:8',
        ]);

        // Ambil data admin berdasarkan ID
        $admin = Admin::findOrFail($id);

        // Update data admin
        $admin->nama = $request->input('nama');
        $admin->username = $request->input('username');

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        // Redirect ke halaman profile dengan pesan sukses
        return redirect()->route('admin.profile.index')->with('success', 'Profile berhasil diperbarui.');
    }

    /**
     * Menampilkan daftar pengguna (mahasiswa, dosen, admin)
     *
     * @return \Illuminate\View\View
     */
    public function showPengguna()
    {
        $mahasiswa = Mahasiswa::select('level', 'nama', 'nim')->get();
        $dosen = Dosen::select('level', 'nama', 'nip')->get();
        $admin = Admin::select('level', 'nama', 'username')->get();

        // Gabungkan data mahasiswa, dosen, dan admin
        $pengguna = $mahasiswa->merge($dosen)->merge($admin)
            ->sortByDesc('level'); // Urutkan berdasarkan level

        // Kirim data ke view pengguna
        return view('admin.Pengguna.index', compact('pengguna'));
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
            'nim_nip_username' => 'required|string|max:15|unique:mahasiswa,nim,' . $id . ',nim|unique:dosen,nip,' . $id . ',nip|unique:admin,username,' . $id . ',username',
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

    // Menampilkan daftar lomba
    public function showLomba()
    {
        // Ambil semua data lomba lengkap dengan relasi tingkat, kategori, dan jenis
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Kirim data ke view lomba
        return view('admin.Lomba.index', compact('lombas'));
    }

    public function createLomba()
    {
        // Ambil semua tingkat, kategori, dan jenis untuk dropdown
        $tingkats = Tingkat::all();
        $kategoris = Kategori::all();
        $jeniss = Jenis::all();

        // Tampilkan halaman tambah lomba
        return view('admin.Lomba.tambahLomba', compact('tingkats', 'kategoris', 'jeniss'));
    }

    public function storeLomba(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'required|exists:tingkat,id_tingkat',
            'kategori' => 'required|exists:kategori,id_kategori',
            'jenis' => 'required|exists:jenis,id_jenis',
            'penyelenggara' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tgl_dibuka' => 'required|date',
            'tgl_ditutup' => 'required|date|after_or_equal:tgl_dibuka',
        ]);

        // Simpan data lomba
        DataLomba::create($request->all());

        // Redirect ke halaman lomba dengan pesan sukses
        return redirect()->route('admin.lomba.index')->with('success', 'Lomba berhasil ditambahkan.');
    }

    public function editLomba($id)
    {
        // Ambil data lomba berdasarkan ID
        $lomba = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->findOrFail($id);

        // Ambil semua tingkat, kategori, dan jenis untuk dropdown
        $tingkats = Tingkat::all();
        $kategoris = Kategori::all();
        $jeniss = Jenis::all();

        // Tampilkan halaman edit lomba
        return view('admin.Lomba.editLomba', compact('lomba', 'tingkats', 'kategoris', 'jeniss'));
    }

    public function updateLomba(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'required|exists:tingkat,id_tingkat',
            'kategori' => 'required|exists:kategori,id_kategori',
            'jenis' => 'required|exists:jenis,id_jenis',
            'penyelenggara' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tgl_dibuka' => 'required|date',
            'tgl_ditutup' => 'required|date|after_or_equal:tgl_dibuka',
        ]);

        // Update data lomba
        $lomba = DataLomba::findOrFail($id);
        $lomba->update($request->all());

        // Redirect ke halaman lomba dengan pesan sukses
        return redirect()->route('admin.lomba.index')->with('success', 'Lomba berhasil diperbarui.');
    }

    public function deleteLomba($id)
    {
        // Hapus data lomba berdasarkan ID
        $lomba = DataLomba::findOrFail($id);
        $lomba->delete();

        // Redirect ke halaman lomba dengan pesan sukses
        return redirect()->route('admin.lomba.index')->with('success', 'Lomba berhasil dihapus.');
    }

    // Menampilkan daftar Verifikasi
    public function showVerifikasi()
    {
        // Ambil semua data verifikasi prestasi
        $verifikasis = DataPrestasi::with('dataLomba')->where('verifikasi', 'Pending')->get();

        // Kirim data ke view verifikasi
        return view('admin.Verifikasi.index', compact('verifikasis'));
    }

    public function updateVerifikasi(Request $request, $id)
    {
        // Update status verifikasi
        $verifikasi = DataPrestasi::findOrFail($id);
        $verifikasi->verifikasi = $request->status;
        $verifikasi->save();

        // Redirect ke halaman verifikasi dengan pesan sukses
        return redirect()->route('admin.verifikasi.index')->with('success', 'Status verifikasi berhasil diperbarui.');
    }
}
