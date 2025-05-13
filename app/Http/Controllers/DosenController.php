<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Mahasiswa;

class DosenController extends Controller
{
    public function dashboard()
    {
        // Ambil semua data lomba lengkap dengan relasi tingkat, kategori, dan jenis
        $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

        // Ambil semua data mahasiswa, urutkan berdasarkan poin tertinggi
        $mahasiswa = Mahasiswa::orderByDesc('poin_presma')->get();

        // Kirim data ke view dashboard dosen
        return view('dosen.dashboard', compact('lombas', 'mahasiswa'));
    }

    public function infoLomba()
    {   
    // Ambil semua data lomba dengan relasi jika diperlukan
    $lombas = DataLomba::with(['tingkatRelasi', 'kategoriRelasi', 'jenisRelasi'])->get();

    // Tampilkan halaman informasi lomba
    return view('dosen.lomba.index', compact('lombas'));
    }

    public function CreateInfoLomba()
    {
        // Tampilkan form untuk menambahkan informasi lomba
        return view('dosen.create_info_lomba');
    }   

    public function DeleteInfoLomba($id)
    {
        // Hapus informasi lomba berdasarkan ID
        $lomba = DataLomba::findOrFail($id);
        $lomba->delete();

        // Redirect ke halaman dashboard dosen dengan pesan sukses
        return redirect()->route('dosen.dashboard')->with('success', 'Informasi lomba berhasil dihapus.');
    }

    public function storeInfoLomba(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'required|exists:tingkats,id',
            'kategori' => 'required|exists:kategoris,id',
            'jenis' => 'required|exists:jenis_lombas,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Simpan informasi lomba baru ke database
        DataLomba::create([
            'nama_lomba' => $request->input('nama_lomba'),
            'tingkat_id' => $request->input('tingkat'),
            'kategori_id' => $request->input('kategori'),
            'jenis_id' => $request->input('jenis'),
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
        ]);

        // Redirect ke halaman dashboard dosen dengan pesan sukses
        return redirect()->route('dosen.dashboard')->with('success', 'Informasi lomba berhasil ditambahkan.');
    }

    public function editInfoLomba($id)
    {
        // Ambil informasi lomba berdasarkan ID
        $lomba = DataLomba::findOrFail($id);

        // Tampilkan form untuk mengedit informasi lomba
        return view('dosen.edit_info_lomba', compact('lomba'));
    }
    public function DosenPembimbing()
    {
    // Isi logika yang dibutuhkan, misalnya ambil data pembimbing
    return view('dosen.dospem.index'); // Pastikan view ini ada
    }

}
