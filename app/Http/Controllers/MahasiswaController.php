<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\DataPrestasi;
use App\Models\Dosen;
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
        $prestasi = DataPrestasi::select('id', 'peringkat', 'sertif', 'foto_bukti','verifikasi','poster_lomba','id_lomba')
        ->with('dataLomba')
        ->get();


        // Ambil semua data lomba dengan relasi jika diperlukan
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Tampilkan halaman data prestasi
        return view('mahasiswa.prestasi.index', compact('lombas', 'prestasi'));
    }

    public function create_prestasi()
    {   
        // Tampilkan halaman tambah_prestasi
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        $prestasi = DataPrestasi::select('peringkat')->get();

        return view('mahasiswa.prestasi.tambah_prestasi', compact('lombas', 'prestasi'));
    }

    public function store_prestasi(Request $request)
    {
        // dd($request->all(), $request->id_lomba, $request->has('id_lomba'));

        $request->validate([
            'peringkat' => 'required',
            'id_lomba' => 'required',
            'sertif' => 'file|mimes:pdf,jpg,jpeg,png|max:2000',
            'foto_bukti' => 'file|mimes:jpg,jpeg,png|max:2000',
            'poster_lomba' => 'file|mimes:jpg,jpeg,png|max:2000',
        ]);

        $data = new DataPrestasi();
        $data->peringkat = $request->peringkat;
        $data->id_lomba = $request->id_lomba;
        $data->verifikasi = 'pending';

        if ($request->hasFile('sertif')) {
            $data->sertif = $request->file('sertif')->store('sertif', 'public');
        }
        if ($request->hasFile('foto_bukti')) {
            $data->foto_bukti = $request->file('foto_bukti')->store('foto_bukti', 'public');
        }
        if ($request->hasFile('poster_lomba')) {
            $data->poster_lomba = $request->file('poster_lomba')->store('poster_lomba', 'public');
        }

        $data->save();

        return redirect()->route('mahasiswa.prestasi.index')->with('success', 'Data berhasil disimpan.');
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
        $bimbingan = Bimbingan::select('id_bimbingan', 'id_lomba', 'nama_anggota', 'nip','status')
        ->with('lomba', 'dosen')
        ->get();
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();
        $dosen = dosen::all();
        
        // Tampilkan halaman data bimbingan 
        return view('mahasiswa.bimbingan.index', compact('bimbingan','lombas', 'dosen'));
    }

    public function create_bimbingan()
    {   
        // Tampilkan halaman tambah_bimbingan
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();
        $dosen = dosen::all();
        return view('mahasiswa.bimbingan.tambah_bimbingan',compact('lombas', 'dosen'));
    }

    public function store_bimbingan(Request $request)
    {
        $request->validate([
            'id_lomba' => 'required',
            'nama_anggota' => 'required',
            'nip' => 'required',
        ]);

        $bimbingan = new Bimbingan();
        $bimbingan->id_lomba = $request->id_lomba;
        $bimbingan->nama_anggota = $request->nama_anggota;
        $bimbingan->nip = $request->nip;
        $bimbingan->status = 'Pending'; // default status

        $bimbingan->save();

        return redirect()->route('mahasiswa.bimbingan.index')->with('success', 'Data bimbingan berhasil disimpan.');
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
         $prestasi = DataPrestasi::select('id', 'peringkat', 'sertif', 'foto_bukti','verifikasi','poster_lomba','id_lomba')
        ->with('dataLomba')
        ->get();

        // Ambil semua data lomba dengan relasi jika diperlukan
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Tampilkan halaman data verifikasi 
        return view('mahasiswa.verifikasi.index', compact('lombas', 'prestasi'));
    }
}
