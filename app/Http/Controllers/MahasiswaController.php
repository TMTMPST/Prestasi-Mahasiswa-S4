<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\DataPrestasi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Jenis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data lomba lengkap dengan relasi tingkat, kategori, dan jenis
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();

        // Ambil semua data mahasiswa, urutkan berdasarkan poin tertinggi
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

        // Get statistics data for current student
        $user = Session::get('user');
        $currentMahasiswa = null;
        $totalPrestasi = 0;
        $prestasiVerified = 0;
        $prestasiPending = 0;
        $prestasiRejected = 0;
        $prestasiByTingkat = collect();
        $prestasiByJenis = collect();
        $prestasiByPeringkat = collect();
        $rankingPosition = 0;
        $totalMahasiswaCount = 0;
        $prestasiTerbaru = collect();

        if ($user && Session::get('level') === 'MHS') {
            $currentMahasiswa = Mahasiswa::where('nim', $user->nim)->with('keahlian')->first();
            
            if ($currentMahasiswa) {
                // Total prestasi mahasiswa
                $totalPrestasi = DataPrestasi::where('nim', $user->nim)->count();

                // Total prestasi berdasarkan status verifikasi
                $prestasiVerified = DataPrestasi::where('nim', $user->nim)
                    ->where('verifikasi', 'Accepted')->count();
                $prestasiPending = DataPrestasi::where('nim', $user->nim)
                    ->where('verifikasi', 'Pending')->count();
                $prestasiRejected = DataPrestasi::where('nim', $user->nim)
                    ->where('verifikasi', 'Rejected')->count();

                // Prestasi berdasarkan tingkat lomba
                $prestasiByTingkat = DataPrestasi::where('nim', $user->nim)
                    ->join('data_lomba', 'data_prestasi.id_lomba', '=', 'data_lomba.id_lomba')
                    ->join('tingkat', 'data_lomba.tingkat', '=', 'tingkat.id_tingkat')
                    ->select('tingkat.nama_tingkat', DB::raw('count(*) as total'))
                    ->groupBy('tingkat.nama_tingkat')
                    ->get();

                // Prestasi berdasarkan jenis lomba
                $prestasiByJenis = DataPrestasi::where('nim', $user->nim)
                    ->join('data_lomba', 'data_prestasi.id_lomba', '=', 'data_lomba.id_lomba')
                    ->join('jenis', 'data_lomba.jenis', '=', 'jenis.id_jenis')
                    ->select('jenis.nama_jenis', DB::raw('count(*) as total'))
                    ->groupBy('jenis.nama_jenis')
                    ->get();

                // Prestasi berdasarkan peringkat
                $prestasiByPeringkat = DataPrestasi::where('nim', $user->nim)
                    ->select('peringkat', DB::raw('count(*) as total'))
                    ->groupBy('peringkat')
                    ->get();

                // Ranking mahasiswa
                $rankingPosition = Mahasiswa::where('poin_presma', '>', $currentMahasiswa->poin_presma)->count() + 1;
                $totalMahasiswaCount = Mahasiswa::count();

                // Prestasi terbaru (3 terakhir untuk dashboard)
                $prestasiTerbaru = DataPrestasi::where('nim', $user->nim)
                    ->with(['dataLomba.tingkatRelasi', 'dataLomba.jenisRelasi'])
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
            }
        }

        // Kirim data ke view dashboard mahasiswa
        return view('mahasiswa.dashboard', compact(
            'lombas', 
            'mahasiswa',
            'currentMahasiswa',
            'totalPrestasi',
            'prestasiVerified',
            'prestasiPending',
            'prestasiRejected',
            'prestasiByTingkat',
            'prestasiByJenis',
            'prestasiByPeringkat',
            'rankingPosition',
            'totalMahasiswaCount',
            'prestasiTerbaru'
        ));
    }

    // PRESTASIII

    public function prestasi()
    {
        $prestasi = DataPrestasi::select('id', 'peringkat', 'sertif', 'foto_bukti', 'verifikasi', 'poster_lomba', 'id_lomba')
            ->with('dataLomba')
            ->get();


        // Ambil semua data lomba dengan relasi jika diperlukan
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();

        // Tampilkan halaman data prestasi
        return view('mahasiswa.prestasi.index', compact('lombas', 'prestasi'));
    }

    public function create_prestasi()
    {
        // Tampilkan halaman tambah_prestasi
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();

        $prestasi = DataPrestasi::select('peringkat')->get();

        return view('mahasiswa.prestasi.tambah_prestasi', compact('lombas', 'prestasi'));
    }

    public function store_prestasi(Request $request)
    {
        $request->validate([
            'peringkat' => 'required',
            'id_lomba' => 'required',
            'sertif' => 'file|mimes:pdf,jpg,jpeg,png|max:2000',
            'foto_bukti' => 'file|mimes:jpg,jpeg,png|max:2000',
            'poster_lomba' => 'file|mimes:jpg,jpeg,png|max:2000',
        ]);

        $user = Session::get('user');

        if (!$user || Session::get('level') !== 'MHS') {
            return redirect()->back()->withErrors(['unauthorized' => 'Anda tidak memiliki akses.']);
        }

        $data = new DataPrestasi();
        $data->peringkat = $request->peringkat;
        $data->id_lomba = $request->id_lomba;
        $data->verifikasi = 'pending';
        $data->nim = $user->nim; 

        if ($request->hasFile('sertif')) {
            $sertif = $request->file('sertif');
            $sertifName = $sertif->getClientOriginalName();
            $sertif->storeAs('sertif', $sertifName, 'public');
            $data->sertif = 'sertif/' . $sertifName;
        }

        if ($request->hasFile('foto_bukti')) {
            $fotoBukti = $request->file('foto_bukti');
            $fotoBuktiName = $fotoBukti->getClientOriginalName();
            $fotoBukti->storeAs('foto_bukti', $fotoBuktiName, 'public');
            $data->foto_bukti = 'foto_bukti/' . $fotoBuktiName;
        }

        if ($request->hasFile('poster_lomba')) {
            $poster = $request->file('poster_lomba');
            $posterName = $poster->getClientOriginalName();
            $poster->storeAs('poster_lomba', $posterName, 'public');
            $data->poster_lomba = 'poster_lomba/' . $posterName;
        }

        $data->save();

        return redirect()->route('mahasiswa.prestasi.index')->with('success', 'Data berhasil disimpan.');
    }


    public function edit_prestasi($id)
    {
        $prestasi = DataPrestasi::findOrFail($id); // BUKAN get()
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();
        $dosen = dosen::all();

        return view('mahasiswa.prestasi.edit_prestasi', compact('prestasi', 'lombas', 'dosen'));
    }

    public function update_prestasi(Request $request, $id)
    {
        $request->validate([
            'peringkat' => 'required',
            'id_lomba' => 'required',
            'sertif' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'foto_bukti' => 'nullable|file|mimes:jpg,jpeg,png',
            'poster_lomba' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        $prestasi = DataPrestasi::findOrFail($id);
        $prestasi->peringkat = $request->peringkat;
        $prestasi->id_lomba = $request->id_lomba;

        if ($request->hasFile('sertif')) {
            $sertif = $request->file('sertif');
            $sertifName = $sertif->getClientOriginalName();
            $sertif->storeAs('sertif', $sertifName, 'public');
            $prestasi->sertif = 'sertif/' . $sertifName;
        }

        if ($request->hasFile('foto_bukti')) {
            $fotoBukti = $request->file('foto_bukti');
            $fotoBuktiName = $fotoBukti->getClientOriginalName();
            $fotoBukti->storeAs('foto_bukti', $fotoBuktiName, 'public');
            $prestasi->foto_bukti = 'foto_bukti/' . $fotoBuktiName;
        }

        if ($request->hasFile('poster_lomba')) {
            $poster = $request->file('poster_lomba');
            $posterName = $poster->getClientOriginalName();
            $poster->storeAs('poster_lomba', $posterName, 'public');
            $prestasi->poster_lomba = 'poster_lomba/' . $posterName;
        }

        $prestasi->save();

        return redirect()->route('mahasiswa.prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prestasi = DataPrestasi::findOrFail($id);
        $prestasi->delete();

        return redirect()->back()->with('success', 'Data prestasi berhasil dihapus.');
    }


    // BIMBINGANNN

    public function bimbingan()
    {
        $user = Session::get('user');
        if (!$user || Session::get('level') !== 'MHS') {
            return redirect()->back()->withErrors(['unauthorized' => 'Anda tidak memiliki akses.']);
        }

        $bimbingan = Bimbingan::select('id_bimbingan', 'id_lomba', 'nama_pengaju', 'nip','deskripsi_lomba', 'status')
            ->with('lomba', 'dosen')
            ->where('nim', $user->nim)
            ->get();
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();
        $dosen = dosen::all();
        $mahasiswas = Mahasiswa::all();

        // Tampilkan halaman data bimbingan 
        return view('mahasiswa.bimbingan.index', compact('bimbingan', 'lombas', 'dosen', 'mahasiswas'));
    }

    public function create_bimbingan()
    {
        $user = session('user'); // Ambil user dari session

        // Pastikan user ada dan level mahasiswa
        if (!$user || session('level') !== 'MHS') {
            return redirect()->back()->withErrors(['unauthorized' => 'Anda tidak memiliki akses.']);
        }

        $nim = $user->nim;

        // Ambil data mahasiswa berdasarkan nim
        $mahasiswas = Mahasiswa::where('nim', $nim)->first();

        $bimbingan = Bimbingan::where('nim', $nim)->get();   
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();
        $dosen = dosen::all();

        return view('mahasiswa.bimbingan.tambah_bimbingan', compact('lombas', 'dosen', 'mahasiswas'));
    }

    public function store_bimbingan(Request $request)
    {
        $request->validate([
            'id_lomba' => 'required',
            'nip' => 'required',
            'deskripsi_lomba' => 'required', 
        ]);

        $user = Session::get('user');

        if (!$user || Session::get('level') !== 'MHS') {
            return redirect()->back()->withErrors(['unauthorized' => 'Anda tidak memiliki akses.']);
        }

        // Ambil data mahasiswa dari NIM yang sedang login
        $mahasiswa = Mahasiswa::where('nim', $user->nim)->first();

        $bimbingan = new Bimbingan();
        $bimbingan->id_lomba = $request->id_lomba;
        $bimbingan->nim = $user->nim;
        $bimbingan->nama_pengaju = $mahasiswa ? $mahasiswa->nama : 'Tidak diketahui';
        $bimbingan->nip = $request->nip;
        $bimbingan->deskripsi_lomba = $request->deskripsi_lomba;
        $bimbingan->status = 'Pending';

        $bimbingan->save();

        return redirect()->route('mahasiswa.bimbingan.index')->with('success', 'Data bimbingan berhasil disimpan.');
    }


    public function edit_bimbingan($id)
    {
        $bimbingan = Bimbingan::findOrFail($id); 
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();
        $dosen = dosen::all();

        return view('mahasiswa.bimbingan.edit_bimbingan', compact('bimbingan', 'lombas', 'dosen'));
    }


    public function update_bimbingan(Request $request, $id)
    {
        $request->validate([
            'id_lomba' => 'required',
            'nim' => 'required',
            'deskripsi_lomba' => 'required',
            'nip' => 'required',
        ]);

        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->id_lomba = $request->id_lomba;
        $bimbingan->nama_pengaju = $request->nama_pengaju;
        $bimbingan->deskripsi_lomba = $request->deskripsi_lomba;
        $bimbingan->nip = $request->nip;

        $bimbingan->save();

        return redirect()->route('mahasiswa.bimbingan.index')->with('success', 'Data bimbingan berhasil diperbarui.');
    }

    public function destroy_bimbingan($id_bimbingan)
    {
        $bimbingan = Bimbingan::findOrFail($id_bimbingan);
        $bimbingan->delete();

        return redirect()->back()->with('success', 'Data bimbingan berhasil dihapus.');
    }


    // VERIFIKASIII

    public function verifikasi()
    {
        $prestasi = DataPrestasi::select('id', 'peringkat', 'sertif', 'foto_bukti', 'verifikasi', 'poster_lomba', 'id_lomba')
            ->with('dataLomba')
            ->get();

        // Ambil semua data lomba dengan relasi jika diperlukan
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])->get();

        // Tampilkan halaman data verifikasi 
        return view('mahasiswa.verifikasi.index', compact('lombas', 'prestasi'));
    }

    public function profile()
    {
        $mahasiswa = Mahasiswa::where('nim', session('user')->nim)->with('keahlian')->first();
        $jenis = Jenis::all(); // ambil semua jenis lomba
        return view('mahasiswa.profile.index', compact('mahasiswa', 'jenis'));
    }


    public function showUpdateProfile($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->with('keahlian')->firstOrFail();
        $jenis_lomba = Jenis::all(); // daftar jenis lomba
        return view('mahasiswa.profile.update_profile', compact('mahasiswa', 'jenis_lomba'));
    }

    public function updateProfileAction(Request $request, $nim)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'prestasi_tertinggi' => 'nullable|string|max:255',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $mahasiswa->update($request->only(['nama', 'prodi', 'prestasi_tertinggi']));

        return redirect()->route('mahasiswa.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}