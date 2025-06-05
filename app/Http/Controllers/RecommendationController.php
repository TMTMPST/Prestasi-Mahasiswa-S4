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
        $prometheeResults = $this->prometheeRankingDetailed($scoredCompetitions, $criteriaWeights);
        $rankedCompetitions = $prometheeResults['ranked_competitions'];
        $calculationSteps = $prometheeResults['calculation_steps'];

        // Store for trace page
        session([
            'ranked_competitions' => $rankedCompetitions, 
            'criteria_weights' => $criteriaWeights,
            'calculation_steps' => $calculationSteps
        ]);

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
        $calculationSteps = session('calculation_steps', []);
        
        return view('mahasiswa.Recommendation.trace', compact('rankedCompetitions', 'criteriaWeights', 'calculationSteps'));
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
            return 5;
        if ($biaya <= 50000)
            return 4;
        if ($biaya <= 200000)
            return 3;
        if ($biaya <= 500000)
            return 2;
        return 1; // Default for high costs
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

    private function prometheeRankingDetailed($competitions, $weights)
    {
        $criteriaTypes = ['jenis' => 'max', 'tingkat_penyelenggara' => 'max', 'biaya' => 'min', 'hadiah' => 'max', 'tingkat' => 'max'];
        
        // Step 1: Normalize data (for display purposes)
        $normalizedData = [];
        $minMaxValues = [];
        
        foreach (['jenis', 'tingkat_penyelenggara', 'biaya', 'hadiah', 'tingkat'] as $criterion) {
            $values = array_column(array_column($competitions, 'scores'), $criterion);
            $minMaxValues[$criterion] = ['min' => min($values), 'max' => max($values)];
        }
        
        foreach ($competitions as $id => $data) {
            foreach ($data['scores'] as $criterion => $score) {
                $min = $minMaxValues[$criterion]['min'];
                $max = $minMaxValues[$criterion]['max'];
                $normalized = ($max - $min) != 0 ? ($score - $min) / ($max - $min) : 0;
                $normalizedData[$id][$criterion] = $normalized;
            }
        }

        // Step 2: Calculate preference matrix
        $preferenceMatrix = [];
        $preferenceDetails = [];
        
        foreach ($competitions as $idA => $dataA) {
            foreach ($competitions as $idB => $dataB) {
                if ($idA == $idB) continue;
                
                $pi = 0;
                $criteriaDetails = [];
                
                foreach ($criteriaTypes as $crit => $type) {
                    $scoreA = $dataA['scores'][$crit];
                    $scoreB = $dataB['scores'][$crit];
                    $pref = ($type == 'max') ? ($scoreA > $scoreB ? 1 : 0) : ($scoreA < $scoreB ? 1 : 0);
                    $weightedPref = $weights[$crit] * $pref;
                    $pi += $weightedPref;
                    
                    $criteriaDetails[$crit] = [
                        'score_a' => $scoreA,
                        'score_b' => $scoreB,
                        'preference' => $pref,
                        'weight' => $weights[$crit],
                        'weighted_preference' => $weightedPref
                    ];
                }
                
                $preferenceMatrix[$idA][$idB] = $pi;
                $preferenceDetails[$idA][$idB] = [
                    'total_preference' => $pi,
                    'criteria' => $criteriaDetails
                ];
            }
        }

        // Step 3: Calculate flows
        $flowCalculations = [];
        $flows = [];
        
        foreach ($competitions as $idA => $dataA) {
            $positiveFlow = 0;
            $negativeFlow = 0;
            $positiveFlowDetails = [];
            $negativeFlowDetails = [];
            
            foreach ($competitions as $idB => $dataB) {
                if ($idA == $idB) continue;
                
                $prefAB = $preferenceMatrix[$idA][$idB] ?? 0;
                $prefBA = $preferenceMatrix[$idB][$idA] ?? 0;
                
                $positiveFlow += $prefAB;
                $negativeFlow += $prefBA;
                
                $positiveFlowDetails[] = ['competition' => $dataB['competition']->nama_lomba, 'value' => $prefAB];
                $negativeFlowDetails[] = ['competition' => $dataB['competition']->nama_lomba, 'value' => $prefBA];
            }
            
            $netFlow = $positiveFlow - $negativeFlow;
            $flows[$idA] = $netFlow;
            $competitions[$idA]['net_flow'] = $netFlow;
            
            $flowCalculations[$idA] = [
                'competition_name' => $dataA['competition']->nama_lomba,
                'positive_flow' => $positiveFlow,
                'negative_flow' => $negativeFlow,
                'net_flow' => $netFlow,
                'positive_flow_details' => $positiveFlowDetails,
                'negative_flow_details' => $negativeFlowDetails
            ];
        }

        // Sort by net flow
        uasort($competitions, fn($a, $b) => $b['net_flow'] <=> $a['net_flow']);
        
        return [
            'ranked_competitions' => $competitions,
            'calculation_steps' => [
                'normalized_data' => $normalizedData,
                'min_max_values' => $minMaxValues,
                'preference_matrix' => $preferenceMatrix,
                'preference_details' => $preferenceDetails,
                'flow_calculations' => $flowCalculations,
                'criteria_types' => $criteriaTypes
            ]
        ];
    }

    // Keep the original method for backward compatibility
    private function prometheeRanking($competitions, $weights)
    {
        return $this->prometheeRankingDetailed($competitions, $weights)['ranked_competitions'];
    }
}