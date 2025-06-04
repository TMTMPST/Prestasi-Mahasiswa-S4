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
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();
        $dosen = dosen::all();

        return view('mahasiswa.prestasi.edit_prestasi', compact('prestasi','lombas', 'dosen'));
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

    public function edit_bimbingan($id)
    {
        $bimbingan = Bimbingan::findOrFail($id); // BUKAN get()
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();
        $dosen = dosen::all();

        return view('mahasiswa.bimbingan.edit_bimbingan', compact('bimbingan','lombas', 'dosen'));
    }


    public function update_bimbingan(Request $request, $id)
    {
        $request->validate([
            'id_lomba' => 'required',
            'nama_anggota' => 'required',
            'nip' => 'required',
        ]);

        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->id_lomba = $request->id_lomba;
        $bimbingan->nama_anggota = $request->nama_anggota;
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
         $prestasi = DataPrestasi::select('id', 'peringkat', 'sertif', 'foto_bukti','verifikasi','poster_lomba','id_lomba')
        ->with('dataLomba')
        ->get();

        // Ambil semua data lomba dengan relasi jika diperlukan
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Tampilkan halaman data verifikasi 
        return view('mahasiswa.verifikasi.index', compact('lombas', 'prestasi'));
    }
}
