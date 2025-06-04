<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLomba;
use App\Models\Jenis;
use App\Models\Tingkat;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Session;

class RecommendationController extends Controller
{
    public function showForm()
    {
        // Check if mahasiswa is logged in via session
        if (Session::get('level') !== 'MHS') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai mahasiswa terlebih dahulu');
        }

        // Get mahasiswa data from session with keahlian relationship
        $sessionUser = Session::get('user');
        $mahasiswa = Mahasiswa::where('nim', $sessionUser->nim)->with('keahlian')->first();

        // Get jenis based on mahasiswa's keahlian preferences
        $jenisList = collect();
        if ($mahasiswa && $mahasiswa->keahlian->isNotEmpty()) {
            $jenisList = $mahasiswa->keahlian;
        } else {
            $jenisList = Jenis::all();
        }

        $tingkatList = Tingkat::all();
        return view('mahasiswa.Recommendation.form', compact('jenisList', 'tingkatList', 'mahasiswa'));
    }

    public function processForm(Request $request)
    {
        // Check if mahasiswa is logged in via session
        if (Session::get('level') !== 'MHS') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai mahasiswa terlebih dahulu');
        }

        // Validate input
        $request->validate([
            'selected_jenis' => 'array',
            'tingkat_scores' => 'array|min:1',
            'criteria_ranks' => 'array|size:5',
            'manual_weights' => 'sometimes|array|size:5',
        ]);

        $selectedJenis = $request->input('selected_jenis', []);
        $tingkatScores = $request->input('tingkat_scores');
        $criteriaRanks = $request->input('criteria_ranks');
        $manualWeights = $request->input('manual_weights');

        // Get mahasiswa's jenis preferences from keahlian relationship
        $sessionUser = Session::get('user');
        $mahasiswa = Mahasiswa::where('nim', $sessionUser->nim)->with('keahlian')->first();
        
        // Get jenis IDs directly from the relationship
        $mahasiswaJenisIds = [];
        if ($mahasiswa && $mahasiswa->keahlian->isNotEmpty()) {
            $mahasiswaJenisIds = $mahasiswa->keahlian->pluck('id_jenis')->toArray();
        }

        // Ensure unique ranks
        if (count(array_unique($criteriaRanks)) !== 5) {
            return redirect()->back()->withErrors(['msg' => 'Semua ranking kriteria harus unik']);
        }

        // Calculate weights - either manual or ROC
        if ($manualWeights && array_sum($manualWeights) > 0) {
            // Use manual weights and normalize them to sum to 1
            $totalWeight = array_sum($manualWeights);
            $criteriaWeights = [
                'jenis' => $manualWeights['jenis'] / $totalWeight,
                'tingkat_penyelenggara' => $manualWeights['tingkat_penyelenggara'] / $totalWeight,
                'biaya' => $manualWeights['biaya'] / $totalWeight,
                'hadiah' => $manualWeights['hadiah'] / $totalWeight,
                'tingkat' => $manualWeights['tingkat'] / $totalWeight,
            ];
        } else {
            // Calculate ROC weights
            $weights = $this->calculateROCWeights(5);
            $criteriaWeights = [
                'jenis' => $weights[$criteriaRanks['jenis'] - 1],
                'tingkat_penyelenggara' => $weights[$criteriaRanks['tingkat_penyelenggara'] - 1],
                'biaya' => $weights[$criteriaRanks['biaya'] - 1],
                'hadiah' => $weights[$criteriaRanks['hadiah'] - 1],
                'tingkat' => $weights[$criteriaRanks['tingkat'] - 1],
            ];
        }

        // Get competitions
        $competitions = DataLomba::all();
        $scoredCompetitions = [];

        foreach ($competitions as $comp) {
            // Check if tingkat exists in tingkatScores array
            $tingkatScore = isset($tingkatScores[$comp->tingkat]) ? $tingkatScores[$comp->tingkat] : 1;

            $scores = [
                'jenis' => (in_array($comp->jenis, $mahasiswaJenisIds)) ? 1 : 0,
                'tingkat_penyelenggara' => 3, // Fixed for now
                'biaya' => $this->categorizeBiaya($comp->biaya),
                'hadiah' => $this->categorizeHadiah($comp->hadiah),
                'tingkat' => $tingkatScore,
            ];
            $scoredCompetitions[$comp->id_lomba] = ['competition' => $comp, 'scores' => $scores];
        }

        // PROMETHEE calculation
        $rankedCompetitions = $this->prometheeRanking($scoredCompetitions, $criteriaWeights);

        // Store for trace page
        session(['ranked_competitions' => $rankedCompetitions, 'criteria_weights' => $criteriaWeights]);

        return view('mahasiswa.Recommendation.index', ['competitions' => $rankedCompetitions]);
    }

    public function showTrace()
    {
        // Check if mahasiswa is logged in via session
        if (Session::get('level') !== 'MHS') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai mahasiswa terlebih dahulu');
        }

        $rankedCompetitions = session('ranked_competitions', []);
        $criteriaWeights = session('criteria_weights', []);
        return view('mahasiswa.Recommendation.trace', compact('rankedCompetitions', 'criteriaWeights'));
    }

    private function calculateROCWeights($n)
    {
        $weights = [];
        for ($k = 1; $k <= $n; $k++) {
            $sum = 0;
            for ($i = $k; $i <= $n; $i++) {
                $sum += 1 / $i;
            }
            $weights[$k - 1] = $sum / $n; // Fix: Use 0-based indexing
        }
        return $weights;
    }

    private function categorizeBiaya($biaya)
    {
        if ($biaya == 0)
            return 1;
        if ($biaya <= 50000)
            return 2;
        if ($biaya <= 200000)
            return 3;
        if ($biaya <= 500000)
            return 4;
        return 5;
    }

    private function categorizeHadiah($hadiah)
    {
        $value = is_numeric($hadiah) ? (int) $hadiah : (int) str_replace(['Rp ', '.'], '', $hadiah);
        if (!is_numeric($value) || $value <= 0)
            $value = 5000000; // Default for non-numerical
        if ($value <= 500000)
            return 1;
        if ($value <= 1000000)
            return 2;
        if ($value <= 5000000)
            return 3;
        if ($value <= 10000000)
            return 4;
        return 5;
    }

    private function prometheeRanking($competitions, $weights)
    {
        $criteriaTypes = ['jenis' => 'max', 'tingkat_penyelenggara' => 'max', 'biaya' => 'min', 'hadiah' => 'max', 'tingkat' => 'max'];
        $preferenceMatrix = [];

        // Calculate preference indices
        foreach ($competitions as $idA => $dataA) {
            foreach ($competitions as $idB => $dataB) {
                if ($idA == $idB)
                    continue;
                $pi = 0;
                foreach ($criteriaTypes as $crit => $type) {
                    $scoreA = $dataA['scores'][$crit];
                    $scoreB = $dataB['scores'][$crit];
                    $pref = ($type == 'max') ? ($scoreA > $scoreB ? 1 : 0) : ($scoreA < $scoreB ? 1 : 0);
                    $pi += $weights[$crit] * $pref;
                }
                $preferenceMatrix[$idA][$idB] = $pi;
            }
        }

        // Calculate flows
        $flows = [];
        foreach ($competitions as $idA => $dataA) {
            $positiveFlow = 0;
            $negativeFlow = 0;
            foreach ($competitions as $idB => $dataB) {
                if ($idA == $idB)
                    continue;
                $positiveFlow += $preferenceMatrix[$idA][$idB] ?? 0;
                $negativeFlow += $preferenceMatrix[$idB][$idA] ?? 0;
            }
            $netFlow = $positiveFlow - $negativeFlow;
            $flows[$idA] = $netFlow;
            $competitions[$idA]['net_flow'] = $netFlow;
        }

        // Sort by net flow
        uasort($competitions, fn($a, $b) => $b['net_flow'] <=> $a['net_flow']);
        return $competitions;
    }

    
}