<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;
use App\Models\Admin;
use App\Models\DataPrestasi;
use App\Models\Dosen;
use App\Models\Jenis;
use App\Models\Level;
use App\Models\Tingkat;
use App\Models\Bimbingan;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data lomba lengkap dengan relasi tingkat, kategori, dan jenis
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();

        // Ambil semua data mahasiswa, urutkan berdasarkan poin tertinggi
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

        // Get comprehensive statistics for admin
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalLomba = DataLomba::count();
        $totalPrestasi = DataPrestasi::count();

        // Prestasi yang perlu verifikasi
        $prestasiPendingVerifikasi = DataPrestasi::where('verifikasi', 'Pending')->count();
        $prestasiVerified = DataPrestasi::where('verifikasi', 'Accepted')->count();
        $prestasiRejected = DataPrestasi::where('verifikasi', 'Rejected')->count();

        // Lomba yang perlu verifikasi
        $lombaPendingVerifikasi = DataLomba::where('verifikasi', 'Pending')->count();
        $lombaVerified = DataLomba::where('verifikasi', 'Accepted')->count();

        // Bimbingan statistics
        $totalBimbingan = Bimbingan::count();
        $bimbinganPending = Bimbingan::where('status', 'Pending')->count();
        $bimbinganAccepted = Bimbingan::where('status', 'Accepted')->count();

        // Prestasi berdasarkan tingkat lomba
        $prestasiByTingkat = DataPrestasi::join('data_lomba', 'data_prestasi.id_lomba', '=', 'data_lomba.id_lomba')
            ->join('tingkat', 'data_lomba.tingkat', '=', 'tingkat.id_tingkat')
            ->select('tingkat.nama_tingkat', DB::raw('count(*) as total'))
            ->groupBy('tingkat.nama_tingkat')
            ->get();

        // Prestasi berdasarkan jenis lomba
        $prestasiByJenis = DataPrestasi::join('data_lomba', 'data_prestasi.id_lomba', '=', 'data_lomba.id_lomba')
            ->join('jenis', 'data_lomba.jenis', '=', 'jenis.id_jenis')
            ->select('jenis.nama_jenis', DB::raw('count(*) as total'))
            ->groupBy('jenis.nama_jenis')
            ->get();

        // Prestasi berdasarkan peringkat
        $prestasiByPeringkat = DataPrestasi::select('peringkat', DB::raw('count(*) as total'))
            ->groupBy('peringkat')
            ->get();

        // Prestasi berdasarkan status verifikasi
        $prestasiByVerifikasi = DataPrestasi::select('verifikasi', DB::raw('count(*) as total'))
            ->groupBy('verifikasi')
            ->get();

        // Top mahasiswa berdasarkan prestasi
        $topMahasiswa = Mahasiswa::leftJoin('data_prestasi', 'mahasiswa.nim', '=', 'data_prestasi.nim')
            ->select('mahasiswa.*', DB::raw('COUNT(data_prestasi.nim) as total_prestasi'))
            ->groupBy('mahasiswa.nim', 'mahasiswa.nama', 'mahasiswa.angkatan', 'mahasiswa.password', 'mahasiswa.prodi', 'mahasiswa.dosen_nip', 'mahasiswa.level', 'mahasiswa.poin_presma', 'mahasiswa.prestasi_tertinggi', 'mahasiswa.created_at', 'mahasiswa.updated_at')
            ->orderByDesc('total_prestasi')
            ->limit(5)
            ->get();

        // Prestasi terbaru yang perlu verifikasi
        $prestasiTerbaruPending = DataPrestasi::where('verifikasi', 'Pending')
            ->with(['dataLomba.tingkatRelasi', 'dataLomba.jenisRelasi', 'nimMahasiswa'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Trend registrasi per bulan (6 bulan terakhir)
        $trendRegistrasi = Mahasiswa::where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('MONTH(created_at) as bulan, YEAR(created_at) as tahun, COUNT(*) as total')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        // User distribution
        $userDistribution = [
            ['level' => 'Mahasiswa', 'total' => $totalMahasiswa],
            ['level' => 'Dosen', 'total' => $totalDosen],
            ['level' => 'Admin', 'total' => Admin::count()]
        ];

        // Kirim data ke view dashboard admin
        return view('admin.dashboard', compact(
            'lombas', 
            'mahasiswa',
            'totalMahasiswa',
            'totalDosen',
            'totalLomba',
            'totalPrestasi',
            'prestasiPendingVerifikasi',
            'prestasiVerified',
            'prestasiRejected',
            'lombaPendingVerifikasi',
            'lombaVerified',
            'totalBimbingan',
            'bimbinganPending',
            'bimbinganAccepted',
            'prestasiByTingkat',
            'prestasiByJenis',
            'prestasiByPeringkat',
            'prestasiByVerifikasi',
            'topMahasiswa',
            'prestasiTerbaruPending',
            'trendRegistrasi',
            'userDistribution'
        ));
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

    public function showPeriodeMahasiswa(Request $request)
    {
        $angkatan = $request->input('angkatan');
        // Ambil daftar angkatan untuk dropdown filter
        $filter = Mahasiswa::select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'DESC')
            ->get();
        // Jika ada filter angkatan, ambil data mahasiswa berdasarkan angkatan
        if ($angkatan) {
            $mahasiswa = Mahasiswa::where('angkatan', $angkatan)->get();
        } else {
            // Jika tidak ada filter, ambil semua data mahasiswa
            $mahasiswa = Mahasiswa::all();
        }
        // Kirim data ke view periode mahasiswa
        return view('admin.Periode.index', compact('mahasiswa', 'filter'));
    }

    public function createPengguna()
    {
        // Ambil semua level untuk dropdown
        $levels = Level::all();
        // Ambil semua program studi untuk dropdown
        $prodi = ProgramStudi::all();

        // Tampilkan halaman tambah pengguna
        return view('admin.Pengguna.tambahPengguna', compact('levels', 'prodi'));
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
        $prodi = ProgramStudi::all();

        $selectedProdi = $pengguna->prodi ?? '';

        // Tampilkan halaman edit pengguna
        return view('admin.Pengguna.editPengguna', compact('pengguna', 'levels', 'prodi', 'selectedProdi'));
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
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get()->sortBy('verifikasi');

        // Kirim data ke view lomba
        return view('admin.Lomba.index', compact('lombas'));
    }

    public function createLomba()
    {
        // Ambil semua tingkat, kategori, dan jenis untuk dropdown
        $tingkats = Tingkat::all();
        $jeniss = Jenis::all();

        // Tampilkan halaman tambah lomba
        return view('admin.Lomba.tambahLomba', compact('tingkats', 'jeniss'));
    }

    public function storeLomba(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'required|exists:tingkat,id_tingkat',
            'jenis' => 'required|exists:jenis,id_jenis',
            'tingkat_penyelenggara' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'link_lomba' => 'required|string|max:255',
            'biaya' => 'int|nullable',
            'hadiah' => 'string|max:255|nullable',
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
        $lomba = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->findOrFail($id);

        // Ambil semua tingkat, kategori, dan jenis untuk dropdown
        $tingkats = Tingkat::all();
        $jeniss = Jenis::all();

        // Tampilkan halaman edit lomba
        return view('admin.Lomba.editLomba', compact('lomba', 'tingkats', 'jeniss'));
    }

    public function updateLomba(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'required|exists:tingkat,id_tingkat',
            'jenis' => 'required|exists:jenis,id_jenis',
            'tingkat_penyelenggara' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'link_lomba' => 'required|string|max:255',
            'biaya' => 'int|nullable',
            'hadiah' => 'string|max:255|nullable',
            'tgl_dibuka' => 'required|date',
            'tgl_ditutup' => 'required|date|after_or_equal:tgl_dibuka',
            'verifikasi' => 'required|in:Pending,Accepted,Rejected',
        ]);

        // Update data lomba
        $lomba = DataLomba::findOrFail($id);
        $lomba->update($request->all());

        // Redirect ke halaman lomba dengan pesan sukses
        return redirect()->route('admin.lomba.index')->with('success', 'Lomba berhasil diperbarui.');
    }

    public function updateStatusLomba(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'verifikasi' => 'required|in:Pending,Accepted,Rejected',
        ]);

        // Update status verifikasi lomba
        $lomba = DataLomba::findOrFail($id);
        $lomba->verifikasi = $request->input('verifikasi');
        $lomba->save();

        // Redirect ke halaman lomba dengan pesan sukses
        return redirect()->route('admin.lomba.index')->with('success', 'Status lomba berhasil diperbarui.');
    }

    public function deleteLomba($id)
    {
        // Hapus data lomba berdasarkan ID
        $lomba = DataLomba::findOrFail($id);
        $lomba->delete();

        // Redirect ke halaman lomba dengan pesan sukses
        return redirect()->route('admin.lomba.index')->with('success', 'Lomba berhasil dihapus.');
    }

    // Menampilkan daftar presma
    public function showPresma()
    {
        // Ambil semua data presma
        $presmas = DataPrestasi::with('dataLomba', 'nimMahasiswa')->get()->sortByDesc('updated_at');

        // Kirim data ke view presma
        return view('admin.Presma.index', compact('presmas'));
    }
    public function createPresma()
    {
        // Ambil semua data lomba untuk dropdown
        $lombas = DataLomba::select('id_lomba', 'nama_lomba')->get()->sortBy('nama_lomba');
        // Ambil semua data mahasiswa untuk dropdown
        $mahasiswa = Mahasiswa::select('nim', 'nama')->get()->sortBy('nama');

        // Tampilkan halaman tambah presma
        return view('admin.Presma.tambahPresma', compact('lombas', 'mahasiswa'));
    }
    public function storePresma(Request $request)
    {
        // Validasi input
        $request->validate([
            // 'mahasiswa' => 'required|exists:mahasiswa,nim',
            'peringkat' => 'required|in:Juara 1,Juara 2,Juara 3,Harapan 1,Harapan 2,Harapan 3',
            'id_lomba' => 'required|exists:data_lomba,id_lomba',
            'sertif' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_bukti' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'poster_lomba' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'verifikasi' => 'required|in:Pending',
        ]);

        // Simpan data presma
        DataPrestasi::create($request->all());

        // Redirect ke halaman presma dengan pesan sukses
        return redirect()->route('admin.presma.index')->with('success', 'Presma berhasil ditambahkan.');
    }
    public function editPresma($id)
    {
        // Ambil data presma berdasarkan ID
        $presma = DataPrestasi::with('dataLomba', 'nimMahasiswa')->findOrFail($id);
        // Ambil semua lomba untuk dropdown
        $lombas = DataLomba::select('id_lomba', 'nama_lomba')->get()->sortBy('nama_lomba');
        // Ambil semua mahasiswa untuk dropdown
        $mahasiswa = Mahasiswa::select('nim', 'nama')->get()->sortBy('nama');

        // Tampilkan halaman edit presma
        return view('admin.Presma.editPresma', compact('presma', 'lombas', 'mahasiswa'));
    }
    public function updatePresma(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // 'mahasiswa' => 'required|exists:mahasiswa,nim',
            'peringkat' => 'required|in:Juara 1,Juara 2,Juara 3,Harapan 1,Harapan 2,Harapan 3',
            'id_lomba' => 'required|exists:data_lomba,id_lomba',
            'sertif' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_bukti' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'poster_lomba' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'verifikasi' => 'required|in:Pending',
        ]);

        // Update data presma
        $presma = DataPrestasi::findOrFail($id);
        $presma->update($request->all());

        // Redirect ke halaman presma dengan pesan sukses
        return redirect()->route('admin.presma.index')->with('success', 'Presma berhasil diperbarui.');
    }
    public function deletePresma($id)
    {
        // Hapus data presma berdasarkan ID
        $presma = DataPrestasi::findOrFail($id);
        $presma->delete();

        // Redirect ke halaman presma dengan pesan sukses
        return redirect()->route('admin.presma.index')->with('success', 'Presma berhasil dihapus.');
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
        $verifikasi->keterangan = $request->keterangan;
        $verifikasi->updated_by = session('user')->username; // Set username admin yang mengupdate
        $verifikasi->save();

        // Redirect ke halaman verifikasi dengan pesan sukses
        return redirect()->route('admin.verifikasi.index')->with('success', 'Status verifikasi berhasil diperbarui.');
    }

    // Program Studi Management
    public function showProgramStudi()
    {
        $programStudi = ProgramStudi::orderBy('nama_prodi')->get();
        return view('admin.ProgramStudi.index', compact('programStudi'));
    }

    public function createProgramStudi()
    {
        return view('admin.ProgramStudi.tambahProgramStudi');
    }

    public function storeProgramStudi(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:program_studi,kode_prodi',
            'nama_prodi' => 'required|string|max:100',
            'jenjang' => 'required|string|max:20',
            'fakultas' => 'required|string|max:100',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'deskripsi' => 'nullable|string'
        ]);

        ProgramStudi::create($request->all());

        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi berhasil ditambahkan!');
    }

    public function editProgramStudi($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        return view('admin.ProgramStudi.editProgramStudi', compact('programStudi'));
    }

    public function updateProgramStudi(Request $request, $id)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:program_studi,kode_prodi,' . $id . ',id_prodi',
            'nama_prodi' => 'required|string|max:100',
            'jenjang' => 'required|string|max:20',
            'fakultas' => 'required|string|max:100',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'deskripsi' => 'nullable|string'
        ]);

        $programStudi = ProgramStudi::findOrFail($id);
        $programStudi->update($request->all());

        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi berhasil diperbarui!');
    }

    public function deleteProgramStudi($id)
    {
        try {
            $programStudi = ProgramStudi::findOrFail($id);
            $programStudi->delete();
            return redirect()->route('admin.prodi.index')->with('success', 'Program Studi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.prodi.index')->with('error', 'Gagal menghapus Program Studi. Data masih digunakan di tabel lain.');
        }
    }
}
