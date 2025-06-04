<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Kriteria;

class PrometheeController extends Controller
{
    public function rekomendasiLomba()
{
    $alternatifs = DataLomba::with('alternatif.kriteria')->get();
    $kriterias = Kriteria::all();

    $n = $alternatifs->count();
    $preferensi = [];

    // Hitung preferensi antar alternatif
    foreach ($alternatifs as $i => $a) {
        foreach ($alternatifs as $j => $b) {
            if ($i == $j) continue;

            $preferensi[$i][$j] = 0;

            foreach ($kriterias as $kriteria) {
                $nilaiA = optional($a->nilaiKriteria->firstWhere('id_kriteria', $kriteria->id))->nilai ?? 0;
                $nilaiB = optional($b->nilaiKriteria->firstWhere('id_kriteria', $kriteria->id))->nilai ?? 0;

                $d = $nilaiA - $nilaiB;

                // Fungsi preferensi sederhana
                $p = $d > 0 ? $d : 0;

                // Kalau tipe cost, invert nilai preferensi
                if ($kriteria->tipe == 'cost') {
                    $p = $d < 0 ? abs($d) : 0;
                }

                $preferensi[$i][$j] += $p * $kriteria->bobot;
            }
        }
    }

    // Hitung Leaving flow, Entering flow, Net flow
    $netFlows = [];
    foreach ($alternatifs as $i => $a) {
        $leaving = array_sum($preferensi[$i]) / ($n - 1);

        $entering = 0;
        foreach ($preferensi as $row) {
            $entering += $row[$i] ?? 0;
        }
        $entering = $entering / ($n - 1);

        $netFlows[] = [
            'lomba' => $a->nama_lomba,
            'net_flow' => $leaving - $entering
        ];
    }

    // Urutkan berdasarkan net flow descending
    usort($netFlows, function ($a, $b) {
        return $b['net_flow'] <=> $a['net_flow'];
    });

    return view('promethee.rekomendasi', compact('netFlows'));
}

}
