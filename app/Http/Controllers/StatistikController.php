<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPrestasi;
use App\Models\DataLomba;
use App\Models\Mahasiswa;
use App\Models\Jenis;
use App\Models\Tingkat;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        // Check if mahasiswa is logged in via session
        if (Session::get('level') !== 'MHS') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai mahasiswa terlebih dahulu');
        }

        $user = Session::get('user');
        $mahasiswa = Mahasiswa::where('nim', $user->nim)->with('keahlian')->first();

        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        // First, let's check what columns exist in data_prestasi table
        try {
            // Try different possible column names that might exist
            $testQuery = DB::table('data_prestasi')->limit(1)->get();
            
            // If the table exists but nim column doesn't, let's try other possible column names
            $possibleColumns = ['nim', 'mahasiswa_nim', 'student_id', 'mahasiswa_id'];
            $actualColumn = 'nim'; // default
            
            foreach ($possibleColumns as $column) {
                try {
                    DB::table('data_prestasi')->where($column, $user->nim)->limit(1)->get();
                    $actualColumn = $column;
                    break;
                } catch (\Exception $e) {
                    continue;
                }
            }
            
        } catch (\Exception $e) {
            // If table doesn't exist or other error, return with error
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Tabel data prestasi tidak ditemukan');
        }

        // Total prestasi mahasiswa - using the found column name
        $totalPrestasi = DataPrestasi::where($actualColumn, $user->nim)->count();

        // Total prestasi berdasarkan status verifikasi
        $prestasiVerified = DataPrestasi::where($actualColumn, $user->nim)
            ->where('verifikasi', 'Accepted')->count();
        $prestasiPending = DataPrestasi::where($actualColumn, $user->nim)
            ->where('verifikasi', 'Pending')->count();
        $prestasiRejected = DataPrestasi::where($actualColumn, $user->nim)
            ->where('verifikasi', 'Rejected')->count();

        // Prestasi berdasarkan tingkat lomba
        $prestasiByTingkat = DataPrestasi::where($actualColumn, $user->nim)
            ->join('data_lomba', 'data_prestasi.id_lomba', '=', 'data_lomba.id_lomba')
            ->join('tingkat', 'data_lomba.tingkat', '=', 'tingkat.id_tingkat')
            ->select('tingkat.nama_tingkat', DB::raw('count(*) as total'))
            ->groupBy('tingkat.nama_tingkat')
            ->get();

        // Prestasi berdasarkan jenis lomba
        $prestasiByJenis = DataPrestasi::where($actualColumn, $user->nim)
            ->join('data_lomba', 'data_prestasi.id_lomba', '=', 'data_lomba.id_lomba')
            ->join('jenis', 'data_lomba.jenis', '=', 'jenis.id_jenis')
            ->select('jenis.nama_jenis', DB::raw('count(*) as total'))
            ->groupBy('jenis.nama_jenis')
            ->get();

        // Prestasi berdasarkan peringkat
        $prestasiByPeringkat = DataPrestasi::where($actualColumn, $user->nim)
            ->select('peringkat', DB::raw('count(*) as total'))
            ->groupBy('peringkat')
            ->get();

        // Ranking mahasiswa
        $rankingPosition = Mahasiswa::where('poin_presma', '>', $mahasiswa->poin_presma)->count() + 1;
        $totalMahasiswa = Mahasiswa::count();

        // Prestasi terbaru (5 terakhir)
        $prestasiTerbaru = DataPrestasi::where($actualColumn, $user->nim)
            ->with(['dataLomba.tingkatRelasi', 'dataLomba.jenisRelasi'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Total lomba yang tersedia
        $totalLomba = DataLomba::count();

        // Keahlian mahasiswa
        $keahlianMahasiswa = $mahasiswa->keahlian ?? collect();

        // Perbandingan dengan mahasiswa lain di prodi yang sama
        $avgPoinProdi = Mahasiswa::where('prodi', $mahasiswa->prodi)
            ->where('nim', '!=', $user->nim)
            ->avg('poin_presma') ?? 0;

        // Trend prestasi per bulan (6 bulan terakhir)
        $trendPrestasi = DataPrestasi::where($actualColumn, $user->nim)
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw('MONTH(created_at) as bulan, YEAR(created_at) as tahun, COUNT(*) as total')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('mahasiswa.statistik.index', compact(
            'mahasiswa',
            'totalPrestasi',
            'prestasiVerified',
            'prestasiPending',
            'prestasiRejected',
            'prestasiByTingkat',
            'prestasiByJenis',
            'prestasiByPeringkat',
            'rankingPosition',
            'totalMahasiswa',
            'prestasiTerbaru',
            'totalLomba',
            'keahlianMahasiswa',
            'avgPoinProdi',
            'trendPrestasi'
        ));
    }

    public function getChartData(Request $request)
    {
        if (Session::get('level') !== 'MHS') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user = Session::get('user');
        $type = $request->get('type');

        // Use the same column detection logic
        $actualColumn = 'nim'; // default
        $possibleColumns = ['nim', 'mahasiswa_nim', 'student_id', 'mahasiswa_id'];
        
        foreach ($possibleColumns as $column) {
            try {
                DB::table('data_prestasi')->where($column, $user->nim)->limit(1)->get();
                $actualColumn = $column;
                break;
            } catch (\Exception $e) {
                continue;
            }
        }

        switch ($type) {
            case 'tingkat':
                $data = DataPrestasi::where($actualColumn, $user->nim)
                    ->join('data_lomba', 'data_prestasi.id_lomba', '=', 'data_lomba.id_lomba')
                    ->join('tingkat', 'data_lomba.tingkat', '=', 'tingkat.id_tingkat')
                    ->select('tingkat.nama_tingkat as label', DB::raw('count(*) as value'))
                    ->groupBy('tingkat.nama_tingkat')
                    ->get();
                break;

            case 'jenis':
                $data = DataPrestasi::where($actualColumn, $user->nim)
                    ->join('data_lomba', 'data_prestasi.id_lomba', '=', 'data_lomba.id_lomba')
                    ->join('jenis', 'data_lomba.jenis', '=', 'jenis.id_jenis')
                    ->select('jenis.nama_jenis as label', DB::raw('count(*) as value'))
                    ->groupBy('jenis.nama_jenis')
                    ->get();
                break;

            case 'peringkat':
                $data = DataPrestasi::where($actualColumn, $user->nim)
                    ->select('peringkat as label', DB::raw('count(*) as value'))
                    ->groupBy('peringkat')
                    ->get();
                break;

            case 'verifikasi':
                $data = DataPrestasi::where($actualColumn, $user->nim)
                    ->select('verifikasi as label', DB::raw('count(*) as value'))
                    ->groupBy('verifikasi')
                    ->get();
                break;

            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }

        return response()->json($data);
    }
}
