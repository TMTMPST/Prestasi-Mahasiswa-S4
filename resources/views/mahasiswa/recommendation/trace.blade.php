@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --primary: #0c1e47;
        --secondary: #f7b71d;
        --accent1: #f26430;
        --accent2: #f9a11b;
        --accent3: #e6e6e6;
        --light: #ffffff;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #f8f9fa;
    }
    body { background: var(--accent3); }
    .dashboard-card {
        border-left: 6px solid var(--secondary);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(12,30,71,0.07);
    }
    .card-header {
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 18px 18px 0 0;
        letter-spacing: 0.5px;
        background: var(--primary);
        color: var(--light);
        border-bottom: none;
    }
    .btn-maroon {
        background-color: var(--secondary);
        color: var(--primary);
        border: none;
        border-radius: 8px;
        transition: background 0.2s;
        font-weight: 500;
    }
    .btn-maroon:hover, .btn-maroon:focus {
        background-color: var(--primary);
        color: var(--light);
    }
    .table thead th {
        background-color: var(--primary);
        color: var(--light);
        font-size: 1rem;
        letter-spacing: 0.5px;
    }
    .text-maroon { color: var(--primary) !important; }
    .calculation-step {
        background: var(--light);
        border: 1px solid var(--accent3);
        border-radius: 12px;
        margin-bottom: 1rem;
    }
    .step-header {
        background: var(--light-gray);
        padding: 1rem;
        border-radius: 12px 12px 0 0;
        cursor: pointer;
        transition: background 0.2s;
    }
    .step-header:hover {
        background: var(--accent3);
    }
    .step-content {
        padding: 1rem;
        display: none;
    }
    .step-content.show {
        display: block;
    }
    .matrix-table {
        font-size: 0.85rem;
    }
    .matrix-table td, .matrix-table th {
        padding: 0.5rem 0.25rem;
        text-align: center;
    }
</style>

<div class="container py-4">
    <div class="card dashboard-card mb-4">
        <div class="card-header">
            <i class="bi bi-calculator me-2"></i><strong>Detail Perhitungan Rekomendasi PROMETHEE</strong>
        </div>
        <div class="card-body">
            <!-- Criteria Weights Section -->
            <div class="mb-4">
                <h5 class="text-maroon mb-3"><i class="bi bi-graph-up me-2"></i>Bobot Kriteria</h5>
                <div class="row">
                    @foreach ($criteriaWeights as $crit => $weight)
                        <div class="col-md-4 mb-2">
                            <div class="card border-0 bg-light">
                                <div class="card-body py-2">
                                    <strong>{{ ucfirst(str_replace('_', ' ', $crit)) }}</strong>
                                    <span class="badge bg-secondary float-end">{{ number_format($weight, 4) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if(isset($calculationSteps))
            <!-- Step 1: Raw Data -->
            <div class="calculation-step">
                <div class="step-header" onclick="toggleStep('step1')">
                    <h6 class="mb-0"><i class="bi bi-1-circle me-2"></i>Data Awal Kompetisi</h6>
                </div>
                <div class="step-content" id="step1">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama Lomba</th>
                                    <th>Jenis</th>
                                    <th>Tingkat Penyelenggara</th>
                                    <th>Biaya</th>
                                    <th>Hadiah</th>
                                    <th>Tingkat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rankedCompetitions as $id => $data)
                                    <tr>
                                        <td>{{ $data['competition']->nama_lomba }}</td>
                                        <td>{{ $data['competition']->jenis }} ({{ $data['scores']['jenis'] }})</td>
                                        <td>{{ $data['competition']->tingkat_penyelenggara }} ({{ $data['scores']['tingkat_penyelenggara'] }})</td>
                                        <td>{{ $data['competition']->biaya }} ({{ $data['scores']['biaya'] }})</td>
                                        <td>{{ $data['competition']->hadiah }} ({{ $data['scores']['hadiah'] }})</td>
                                        <td>{{ $data['scores']['tingkat'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="text-muted mt-2"><strong>Keterangan:</strong> Angka dalam kurung adalah skor yang diberikan untuk setiap kriteria.</p>
                </div>
            </div>

            <!-- Step 2: Pairwise Comparisons -->
            <div class="calculation-step">
                <div class="step-header" onclick="toggleStep('step2')">
                    <h6 class="mb-0"><i class="bi bi-2-circle me-2"></i>Perbandingan Berpasangan per Kriteria</h6>
                </div>
                <div class="step-content" id="step2">
                    <p class="text-muted mb-3">Setiap alternatif dibandingkan dengan alternatif lainnya untuk setiap kriteria</p>
                    
                    @foreach($calculationSteps['criteria_types'] as $criterion => $type)
                        <h6 class="mt-4">{{ ucfirst(str_replace('_', ' ', $criterion)) }} ({{ $type === 'max' ? 'Maximize' : 'Minimize' }})</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered matrix-table">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach ($rankedCompetitions as $data)
                                            <th class="text-center" style="writing-mode: vertical-lr;">
                                                {{ substr($data['competition']->nama_lomba, 0, 8) }}...
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rankedCompetitions as $idA => $dataA)
                                        <tr>
                                            <td><strong>{{ substr($dataA['competition']->nama_lomba, 0, 15) }}...</strong></td>
                                            @foreach ($rankedCompetitions as $idB => $dataB)
                                                <td class="text-center">
                                                    @if($idA != $idB)
                                                        {{ $calculationSteps['pairwise_comparisons'][$criterion][$idA][$idB]['preference'] }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Step 3: Weight Aggregation -->
            <div class="calculation-step">
                <div class="step-header" onclick="toggleStep('step3')">
                    <h6 class="mb-0"><i class="bi bi-3-circle me-2"></i>Agregasi dengan Bobot Kriteria</h6>
                </div>
                <div class="step-content" id="step3">
                    <p class="text-muted mb-3">Preferensi setiap kriteria dikalikan dengan bobotnya dan dijumlahkan</p>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Bobot Kriteria (ROC):</h6>
                            <ul class="list-unstyled">
                                @foreach($criteriaWeights as $crit => $weight)
                                    <li><strong>{{ ucfirst(str_replace('_', ' ', $crit)) }}:</strong> {{ number_format($weight, 4) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Formula:</h6>
                            <p class="text-muted">π(a,b) = Σ[w<sub>j</sub> × P<sub>j</sub>(a,b)]</p>
                            <p class="text-muted">dimana:</p>
                            <p class="text-muted">w<sub>j</sub> = bobot kriteria j</p>
                            <p class="text-muted">P<sub>j</sub>(a,b) = preferensi alternatif a terhadap b pada kriteria j</p>
                        </div>
                    </div>

                    <h6>Matriks Preferensi Teragregasi:</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered matrix-table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Alternatif</th>
                                    @foreach ($rankedCompetitions as $data)
                                        <th class="text-center" style="writing-mode: vertical-lr;">
                                            {{ substr($data['competition']->nama_lomba, 0, 8) }}...
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rankedCompetitions as $idA => $dataA)
                                    <tr>
                                        <td><strong>{{ substr($dataA['competition']->nama_lomba, 0, 15) }}...</strong></td>
                                        @foreach ($rankedCompetitions as $idB => $dataB)
                                            <td class="text-center">
                                                @if($idA != $idB)
                                                    {{ number_format($calculationSteps['aggregated_preferences'][$idA][$idB], 4) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Step 4: Flow Calculations -->
            <div class="calculation-step">
                <div class="step-header" onclick="toggleStep('step4')">
                    <h6 class="mb-0"><i class="bi bi-4-circle me-2"></i>Perhitungan Aliran PROMETHEE</h6>
                </div>
                <div class="step-content" id="step4">
                    <p class="text-muted mb-3">Entering Flow (φ⁺), Leaving Flow (φ⁻), dan Net Flow (φ)</p>
                    
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama Lomba</th>
                                    <th>Entering Flow (φ⁺)</th>
                                    <th>Leaving Flow (φ⁻)</th>
                                    <th>Net Flow (φ)</th>
                                    <th>Ranking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $rank = 1; @endphp
                                @foreach ($calculationSteps['flow_calculations'] as $id => $flow)
                                    <tr>
                                        <td><strong>{{ $flow['competition_name'] }}</strong></td>
                                        <td>{{ number_format($flow['positive_flow'], 4) }}</td>
                                        <td>{{ number_format($flow['negative_flow'], 4) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $flow['net_flow'] > 0 ? 'success' : 'danger' }}">
                                                {{ number_format($flow['net_flow'], 4) }}
                                            </span>
                                        </td>
                                        <td><span class="badge bg-primary">{{ $rank++ }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <p class="text-muted mb-1"><strong>Formula PROMETHEE:</strong></p>
                        <p class="text-muted mb-1">φ⁺(a) = (1/(n-1)) × Σπ(a,x) untuk semua x ≠ a</p>
                        <p class="text-muted mb-1">φ⁻(a) = (1/(n-1)) × Σπ(x,a) untuk semua x ≠ a</p>
                        <p class="text-muted mb-1">φ(a) = φ⁺(a) - φ⁻(a)</p>
                        <p class="text-muted"><strong>Keterangan:</strong> n = jumlah alternatif, π(a,x) = preferensi teragregasi</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Final Results Section -->
            <div class="mb-4">
                <h5 class="text-maroon mb-3"><i class="bi bi-trophy me-2"></i>Hasil Akhir Rekomendasi PROMETHEE</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Nama Lomba</th>
                                <th>Jenis</th>
                                <th>Tingkat Penyelenggara</th>
                                <th>Biaya</th>
                                <th>Hadiah</th>
                                <th>Tingkat</th>
                                <th>Net Flow</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $rank = 1; @endphp
                            @foreach ($rankedCompetitions as $data)
                                <tr>
                                    <td><span class="badge bg-primary">{{ $rank++ }}</span></td>
                                    <td><strong>{{ $data['competition']->nama_lomba }}</strong></td>
                                    <td>{{ $data['scores']['jenis'] }}</td>
                                    <td>{{ $data['competition']->tingkat_penyelenggara }} ({{ $data['scores']['tingkat_penyelenggara'] }})</td>
                                    <td>{{ $data['competition']->biaya }} ({{ $data['scores']['biaya'] }})</td>
                                    <td>{{ $data['competition']->hadiah }} ({{ $data['scores']['hadiah'] }})</td>
                                    <td>{{ $data['scores']['tingkat'] }}</td>
                                    <td>
                                        <span class="badge bg-{{ $data['net_flow'] > 0 ? 'success' : 'danger' }}">
                                            {{ number_format($data['net_flow'], 4) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Explanation Section -->
            <div class="alert alert-info">
                <h6><i class="bi bi-info-circle me-2"></i>Penjelasan Metode PROMETHEE</h6>
                <ul class="mb-0">
                    <li><strong>Perbandingan Berpasangan:</strong> Setiap alternatif dibandingkan dengan alternatif lain untuk setiap kriteria</li>
                    <li><strong>Agregasi Bobot:</strong> Preferensi setiap kriteria dikalikan dengan bobot ROC dan dijumlahkan</li>
                    <li><strong>Entering Flow (φ⁺):</strong> Mengukur seberapa baik alternatif dibanding alternatif lain</li>
                    <li><strong>Leaving Flow (φ⁻):</strong> Mengukur seberapa buruk alternatif dibanding alternatif lain</li>
                    <li><strong>Net Flow (φ):</strong> Selisih antara positive dan Leaving Flow, menentukan ranking akhir</li>
                    <li><strong>Semakin tinggi Net Flow, semakin direkomendasikan</strong> lomba tersebut</li>
                </ul>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('mahasiswa.recomendation.form') }}" class="btn btn-maroon px-4">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Form
                </a>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-house me-2"></i>Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleStep(stepId) {
    const content = document.getElementById(stepId);
    content.classList.toggle('show');
}
</script>
@endsection