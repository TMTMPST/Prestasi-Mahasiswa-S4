<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;
use App\Models\Tingkat;
use App\Models\Jenis;
use App\Models\Dosen;
use App\Models\Bimbingan;
use App\Models\DataPrestasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function dashboard()
    {
        $sessionUser = session('user');
        $dosen = Dosen::where('nip', $sessionUser->nip)->first();
        
        // Get competitions filtered by dosen's field of interest
        $lombas = DataLomba::with(['tingkatRelasi', 'jenisRelasi'])
            ->when($dosen && $dosen->bidangMinat, function ($query) use ($dosen) {
                $query->where('jenis', $dosen->bidangMinat);
            })
            ->get();
        
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

        // Get statistics data for dosen
        $totalMahasiswaBimbingan = 0;
        $totalBimbinganPending = 0;
        $totalBimbinganAccepted = 0;
        $totalPrestasiMahasiswa = 0;
        $bimbinganByStatus = collect();
        $mahasiswaTerbimbingan = collect();
        $trendBimbingan = collect();

        if ($dosen) {
            // Total mahasiswa yang dibimbing (accepted)
            $totalMahasiswaBimbingan = Bimbingan::where('nip', $dosen->nip)
                ->where('status', 'Accepted')
                ->distinct('nim')
                ->count('nim');

            // Total bimbingan pending dan accepted
            $totalBimbinganPending = Bimbingan::where('nip', $dosen->nip)
                ->where('status', 'Pending')->count();
            $totalBimbinganAccepted = Bimbingan::where('nip', $dosen->nip)
                ->where('status', 'Accepted')->count();

            // Total prestasi dari mahasiswa yang dibimbing
            $mahasiswaDibimbing = Bimbingan::where('nip', $dosen->nip)
                ->where('status', 'Accepted')
                ->pluck('nim');
            
            $totalPrestasiMahasiswa = DataPrestasi::whereIn('nim', $mahasiswaDibimbing)->count();

            // Bimbingan berdasarkan status
            $bimbinganByStatus = Bimbingan::where('nip', $dosen->nip)
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get();

            // Mahasiswa yang request bimbingan (pending)
            $bimbinganRequests = Bimbingan::where('nip', $dosen->nip)
                ->where('status', 'Pending')
                ->with(['mahasiswa', 'lomba'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Mahasiswa terbimbingan dengan prestasi terbaru - using direct query instead of relationship
            $mahasiswaTerbimbingan = Mahasiswa::whereIn('mahasiswa.nim', $mahasiswaDibimbing)
                ->leftJoin('data_prestasi', 'mahasiswa.nim', '=', 'data_prestasi.nim')
                ->select('mahasiswa.*', DB::raw('COUNT(data_prestasi.nim) as total_prestasi'))
                ->groupBy('mahasiswa.nim', 'mahasiswa.nama', 'mahasiswa.angkatan', 'mahasiswa.password', 'mahasiswa.prodi', 'mahasiswa.dosen_nip', 'mahasiswa.level', 'mahasiswa.poin_presma', 'mahasiswa.prestasi_tertinggi', 'mahasiswa.created_at', 'mahasiswa.updated_at')
                ->orderByDesc('total_prestasi')
                ->limit(5)
                ->get();

            // Trend bimbingan per bulan (6 bulan terakhir)
            $trendBimbingan = Bimbingan::where('nip', $dosen->nip)
                ->where('created_at', '>=', now()->subMonths(6))
                ->selectRaw('MONTH(created_at) as bulan, YEAR(created_at) as tahun, COUNT(*) as total')
                ->groupBy('tahun', 'bulan')
                ->orderBy('tahun', 'desc')
                ->orderBy('bulan', 'desc')
                ->get();
        }

        return view('dosen.dashboard', compact(
            'lombas', 
            'mahasiswa',
            'dosen',
            'totalMahasiswaBimbingan',
            'totalBimbinganPending',
            'totalBimbinganAccepted',
            'totalPrestasiMahasiswa',
            'bimbinganByStatus',
            'bimbinganRequests',
            'mahasiswaTerbimbingan',
            'trendBimbingan'
        ));
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
            'file_lomba' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file_lomba')) {
            $file = $request->file('file_lomba');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('lomba_files', $filename, 'public');
            $data['file_lomba'] = $path;
        }

        DataLomba::create($data);

        return redirect()->route('dosen.lomba.index')->with('success', 'Lomba berhasil ditambahkan!');
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
        $bimbingan->delete();

        return back()->with('success', 'Bimbingan ditolak dan dihapus dari daftar.');
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
        $jeniss = \App\Models\Jenis::all();
        return view('dosen.Profile.update_profile', compact('dosen', 'jeniss'));
    }

    public function updateProfileAction(Request $request, $nip)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bidangMinat' => 'nullable|exists:jenis,id_jenis',
        ]);
        $dosen = Dosen::where('nip', $nip)->firstOrFail();
        $dosen->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'bidangMinat' => $request->bidangMinat,
        ]);
        return redirect()->route('dosen.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
