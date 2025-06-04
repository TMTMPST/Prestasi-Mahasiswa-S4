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
</style>

<div class="container py-4">
    <div class="card dashboard-card mb-4">
        <div class="card-header">
            <i class="bi bi-calculator me-2"></i><strong>Detail Perhitungan Rekomendasi</strong>
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

            <!-- Competition Scores Section -->
            <div class="mb-4">
                <h5 class="text-maroon mb-3"><i class="bi bi-table me-2"></i>Skor dan Aliran Kompetisi</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
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
                            @foreach ($rankedCompetitions as $data)
                                <tr>
                                    <td><strong>{{ $data['competition']->nama_lomba }}</strong></td>
                                    <td>{{ $data['scores']['jenis'] }}</td>
                                    <td>{{ $data['scores']['tingkat_penyelenggara'] }}</td>
                                    <td>{{ $data['scores']['biaya'] }}</td>
                                    <td>{{ $data['scores']['hadiah'] }}</td>
                                    <td>{{ $data['scores']['tingkat'] }}</td>
                                    <td>
                                        <span class="badge bg-primary">
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
                <h6><i class="bi bi-info-circle me-2"></i>Penjelasan Perhitungan</h6>
                <ul class="mb-0">
                    <li><strong>Bobot Kriteria:</strong> Dihitung menggunakan metode ROC (Rank Order Centroid) berdasarkan ranking yang Anda berikan</li>
                    <li><strong>Net Flow:</strong> Hasil perhitungan PROMETHEE yang menunjukkan tingkat preferensi lomba</li>
                    <li><strong>Semakin tinggi Net Flow, semakin direkomendasikan</strong> lomba tersebut untuk Anda</li>
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
@endsection