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
        
        // Get distinct tingkat penyelenggara from competitions
        $tingkatPenyelenggaraList = DataLomba::select('tingkat_penyelenggara')
            ->distinct()
            ->whereNotNull('tingkat_penyelenggara')
            ->where('tingkat_penyelenggara', '!=', '')
            ->pluck('tingkat_penyelenggara')
            ->sort()
            ->values();
        
        return view('mahasiswa.Recommendation.form', compact('jenisList', 'tingkatList', 'mahasiswa', 'tingkatPenyelenggaraList'));
    }

    public function processStep1(Request $request)
    {
        // Check if mahasiswa is logged in via session
        if (Session::get('level') !== 'MHS') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai mahasiswa terlebih dahulu');
        }

        // Validate step 1 input
        $request->validate([
            'selected_jenis' => 'array',
            'tingkat_scores' => 'array|min:1',
        ]);

        // Store step 1 data in session
        session([
            'step1_data' => [
                'selected_jenis' => $request->input('selected_jenis', []),
                'tingkat_scores' => $request->input('tingkat_scores', [])
            ]
        ]);

        return redirect()->route('mahasiswa.recomendation.criteria');
    }

    public function showCriteria()
    {
        // Check if mahasiswa is logged in via session
        if (Session::get('level') !== 'MHS') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai mahasiswa terlebih dahulu');
        }

        // Check if step 1 data exists
        if (!session('step1_data')) {
            return redirect()->route('mahasiswa.recomendation.form')->with('error', 'Silakan lengkapi step 1 terlebih dahulu');
        }

        return view('mahasiswa.Recommendation.criteria');
    }

    public function showResult()
    {
        // Check if mahasiswa is logged in via session
        if (Session::get('level') !== 'MHS') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai mahasiswa terlebih dahulu');
        }

        $rankedCompetitions = session('ranked_competitions', []);
        
        if (empty($rankedCompetitions)) {
            return redirect()->route('mahasiswa.recomendation.form')->with('error', 'Tidak ada data rekomendasi. Silakan mulai dari awal.');
        }

        return view('mahasiswa.Recommendation.index', ['competitions' => $rankedCompetitions]);
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
        ]);

        $selectedJenis = $request->input('selected_jenis', []);
        $tingkatScores = $request->input('tingkat_scores', []);
        $criteriaRanks = $request->input('criteria_ranks');

        // Get mahasiswa's jenis preferences from keahlian relationship
        $sessionUser = Session::get('user');
        $mahasiswa = Mahasiswa::where('nim', $sessionUser->nim)->with('keahlian')->first();
        
        // Get jenis IDs directly from the relationship
        $mahasiswaJenisIds = [];
        if ($mahasiswa && $mahasiswa->keahlian->isNotEmpty()) {
            $mahasiswaJenisIds = $mahasiswa->keahlian->pluck('id_jenis')->toArray();
        } else {
            // Use selected jenis from form if no keahlian in profile
            $mahasiswaJenisIds = $selectedJenis;
        }

        // Ensure unique ranks
        if (count(array_unique($criteriaRanks)) !== 5) {
            return redirect()->back()->withErrors(['msg' => 'Semua ranking kriteria harus unik']);
        }

        // Calculate ROC weights
        $weights = $this->calculateROCWeights(5);
        $criteriaWeights = [
            'jenis' => $weights[$criteriaRanks['jenis'] - 1],
            'tingkat_penyelenggara' => $weights[$criteriaRanks['tingkat_penyelenggara'] - 1],
            'biaya' => $weights[$criteriaRanks['biaya'] - 1],
            'hadiah' => $weights[$criteriaRanks['hadiah'] - 1],
            'tingkat' => $weights[$criteriaRanks['tingkat'] - 1],
        ];

        // Get competitions
        $competitions = DataLomba::all();
        $scoredCompetitions = [];

        foreach ($competitions as $comp) {
            // Check if tingkat exists in tingkatScores array
            $tingkatScore = isset($tingkatScores[$comp->tingkat]) ? $tingkatScores[$comp->tingkat] : 1;

            $scores = [
                'jenis' => (in_array($comp->jenis, $mahasiswaJenisIds)) ? 1 : 0,
                'tingkat_penyelenggara' => $this->categorizeTingkatPenyelenggara($comp->tingkat_penyelenggara),
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

        // Clear step1 data
        session()->forget('step1_data');

        return redirect()->route('mahasiswa.recomendation.result');
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

    private function categorizeTingkatPenyelenggara($tingkat)
    {
        $tingkat = strtolower($tingkat);
        if (strpos($tingkat, 'internasional') !== false) return 5;
        if (strpos($tingkat, 'nasional') !== false) return 4;
        if (strpos($tingkat, 'regional') !== false) return 3;
        if (strpos($tingkat, 'provinsi') !== false) return 2;
        return 1; // Default for local/other
    }

    private function prometheeRankingDetailed($competitions, $weights)
    {
        $criteriaTypes = ['jenis' => 'max', 'tingkat_penyelenggara' => 'max', 'biaya' => 'min', 'hadiah' => 'max', 'tingkat' => 'max'];
        
        // Step 1: Raw data (already available in scores)
        $rawData = [];
        foreach ($competitions as $id => $data) {
            $rawData[$id] = $data['scores'];
        }

        // Step 2: Calculate pairwise comparisons for each criterion
        $pairwiseComparisons = [];
        $criteriaPreferences = [];
        
        foreach (['jenis', 'tingkat_penyelenggara', 'biaya', 'hadiah', 'tingkat'] as $criterion) {
            $criteriaPreferences[$criterion] = [];
            
            foreach ($competitions as $idA => $dataA) {
                foreach ($competitions as $idB => $dataB) {
                    if ($idA == $idB) continue;
                    
                    $scoreA = $dataA['scores'][$criterion];
                    $scoreB = $dataB['scores'][$criterion];
                    
                    // Calculate preference using Excel formulas
                    if ($criteriaTypes[$criterion] == 'max') {
                        // For benefit criteria: =IF(A>B;1;0)
                        $preference = ($scoreA > $scoreB) ? 1 : 0;
                    } else {
                        // For cost criteria (biaya): =IF(A<B;1;0) 
                        $preference = ($scoreA < $scoreB) ? 1 : 0;
                    }
                    
                    $criteriaPreferences[$criterion][$idA][$idB] = [
                        'score_a' => $scoreA,
                        'score_b' => $scoreB,
                        'difference' => $scoreA - $scoreB,
                        'preference' => $preference,
                        'interpretation' => $this->getPreferenceInterpretation($scoreA, $scoreB, $criteriaTypes[$criterion], $criterion)
                    ];
                }
            }
        }

        // Step 3: Weight aggregation - Calculate weighted preference indices
        $aggregatedPreferences = [];
        $weightedDetails = [];
        
        foreach ($competitions as $idA => $dataA) {
            foreach ($competitions as $idB => $dataB) {
                if ($idA == $idB) continue;
                
                $totalPreference = 0;
                $criteriaBreakdown = [];
                
                foreach (['jenis', 'tingkat_penyelenggara', 'biaya', 'hadiah', 'tingkat'] as $criterion) {
                    $preference = $criteriaPreferences[$criterion][$idA][$idB]['preference'];
                    $weight = $weights[$criterion];
                    $weightedPreference = $weight * $preference;
                    $totalPreference += $weightedPreference;
                    
                    $criteriaBreakdown[$criterion] = [
                        'preference' => $preference,
                        'weight' => $weight,
                        'weighted_preference' => $weightedPreference
                    ];
                }
                
                $aggregatedPreferences[$idA][$idB] = $totalPreference;
                $weightedDetails[$idA][$idB] = [
                    'total_preference' => $totalPreference,
                    'criteria_breakdown' => $criteriaBreakdown
                ];
            }
        }

        // Step 4: Calculate positive and negative flows
        $flowCalculations = [];
        $flows = [];
        $n = count($competitions);
        
        foreach ($competitions as $idA => $dataA) {
            $positiveFlow = 0;
            $negativeFlow = 0;
            $positiveFlowDetails = [];
            $negativeFlowDetails = [];
            
            foreach ($competitions as $idB => $dataB) {
                if ($idA == $idB) continue;
                
                // Positive flow: how much A dominates others
                $prefAB = $aggregatedPreferences[$idA][$idB] ?? 0;
                $positiveFlow += $prefAB;
                $positiveFlowDetails[] = [
                    'competition' => $dataB['competition']->nama_lomba,
                    'preference' => $prefAB
                ];
                
                // Negative flow: how much others dominate A
                $prefBA = $aggregatedPreferences[$idB][$idA] ?? 0;
                $negativeFlow += $prefBA;
                $negativeFlowDetails[] = [
                    'competition' => $dataB['competition']->nama_lomba,
                    'preference' => $prefBA
                ];
            }
            
            // Normalize by number of comparisons (n-1)
            $positiveFlow = $positiveFlow / ($n - 1);
            $negativeFlow = $negativeFlow / ($n - 1);
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

        // Sort by net flow (highest first)
        uasort($competitions, fn($a, $b) => $b['net_flow'] <=> $a['net_flow']);
        
        return [
            'ranked_competitions' => $competitions,
            'calculation_steps' => [
                'raw_data' => $rawData,
                'pairwise_comparisons' => $criteriaPreferences,
                'weight_aggregation' => $weightedDetails,
                'aggregated_preferences' => $aggregatedPreferences,
                'flow_calculations' => $flowCalculations,
                'criteria_types' => $criteriaTypes
            ]
        ];
    }

    private function getPreferenceInterpretation($scoreA, $scoreB, $type, $criterion)
    {
        if ($type == 'max') {
            // Benefit criteria: =IF(A>B;1;0)
            $preference = ($scoreA > $scoreB) ? 1 : 0;
            if ($preference == 1) {
                return "A preferred (A=$scoreA > B=$scoreB)";
            } else {
                return "B preferred or equal (A=$scoreA ≤ B=$scoreB)";
            }
        } else {
            // Cost criteria: =IF(A<B;1;0)
            $preference = ($scoreA < $scoreB) ? 1 : 0;
            if ($preference == 1) {
                return "A preferred (cost A=$scoreA < cost B=$scoreB)";
            } else {
                return "B preferred or equal (cost A=$scoreA ≥ cost B=$scoreB)";
            }
        }
    }

    // Keep the original method for backward compatibility
    private function prometheeRanking($competitions, $weights)
    {
        return $this->prometheeRankingDetailed($competitions, $weights)['ranked_competitions'];
    }
}