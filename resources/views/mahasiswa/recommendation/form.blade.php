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
    .card {
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(12,30,71,0.07);
        border: none;
        background: var(--light);
    }
    .form-label {
        color: var(--primary);
        font-weight: 500;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(247,183,29,.15);
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
    .btn-outline-maroon {
        border: 1.5px solid var(--secondary);
        color: var(--secondary);
        background: var(--light);
        border-radius: 8px;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
    }
    .btn-outline-maroon:hover, .btn-outline-maroon:focus {
        background: var(--secondary);
        color: var(--primary);
    }
</style>

<div class="container py-4">
    <div class="card dashboard-card mb-4">
        <div class="card-header">
            <i class="bi bi-lightbulb me-2"></i><strong>Rekomendasi Lomba - Preferensi Anda</strong>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('mahasiswa.recomendation.process') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-tag me-2"></i>Jenis Lomba Preferensi Anda</label>
                    @if($mahasiswa && $mahasiswa->keahlian->isNotEmpty())
                        @foreach($mahasiswa->keahlian as $keahlian)
                            <div class="form-control bg-light mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>{{ $keahlian->nama_jenis }}
                                <input type="hidden" name="selected_jenis[]" value="{{ $keahlian->id_jenis }}">
                            </div>
                        @endforeach
                        <small class="text-muted">Berdasarkan keahlian yang terdaftar di profil Anda</small>
                    @else
                        <div class="form-control bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>Belum ada preferensi jenis lomba di profil Anda
                        </div>
                        <small class="text-muted">Silakan lengkapi keahlian di profil Anda terlebih dahulu</small>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-trophy me-2"></i>Preferensi Tingkat Lomba</label>
                    <small class="text-muted d-block mb-2">Berikan skor 1-4 untuk setiap tingkat (1 = Kurang diminati, 4 = Sangat diminati)</small>
                    @foreach ($tingkatList as $tingkat)
                        <div class="row align-items-center mb-2">
                            <div class="col-6">
                                <label class="form-label mb-0">{{ $tingkat->nama_tingkat }}</label>
                            </div>
                            <div class="col-6">
                                <select name="tingkat_scores[{{ $tingkat->id_tingkat }}]" class="form-select">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}">{{ $i }} - {{ $i == 1 ? 'Kurang' : ($i == 2 ? 'Cukup' : ($i == 3 ? 'Baik' : 'Sangat Baik')) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-list-ol me-2"></i>Ranking Kriteria Penilaian</label>
                    <small class="text-muted d-block mb-2">Urutkan kriteria berdasarkan kepentingan (1 = Paling Penting, 5 = Kurang Penting)</small>
                    @foreach (['jenis', 'tingkat_penyelenggara', 'biaya', 'hadiah', 'tingkat'] as $crit)
                        <div class="row align-items-center mb-2">
                            <div class="col-6">
                                <label class="form-label mb-0">{{ ucfirst(str_replace('_', ' ', $crit)) }}</label>
                            </div>
                            <div class="col-6">
                                <select name="criteria_ranks[{{ $crit }}]" class="form-select">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-maroon px-4">
                        <i class="bi bi-search me-2"></i>Dapatkan Rekomendasi
                    </button>
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-maroon px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection