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

    body {
        background: var(--accent3);
    }

    .dashboard-card {
        border-left: 6px solid var(--secondary);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(12, 30, 71, 0.07);
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
        box-shadow: 0 4px 24px rgba(12, 30, 71, 0.07);
        border: none;
        background: var(--light);
    }

    .form-label {
        color: var(--primary);
        font-weight: 500;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(247, 183, 29, .15);
    }

    .btn-maroon {
        background-color: var(--secondary);
        color: var(--primary);
        border: none;
        border-radius: 8px;
        transition: background 0.2s;
        font-weight: 500;
    }

    .btn-maroon:hover,
    .btn-maroon:focus {
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

    .btn-outline-maroon:hover,
    .btn-outline-maroon:focus {
        background: var(--secondary);
        color: var(--primary);
    }

    .step-indicator {
        background: var(--light-gray);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 2rem;
    }

    .step {
        display: inline-block;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .step.completed {
        background: var(--secondary);
        color: var(--primary);
    }

    .step.active {
        background: var(--primary);
        color: var(--light);
    }

    .step.pending {
        background: var(--light);
        color: var(--gray);
        border: 1px solid var(--accent3);
    }
</style>

<div class="container py-4">
    <div class="card dashboard-card mb-4">
        <div class="card-header">
            <i class="bi bi-list-ol me-2"></i><strong>Rekomendasi Lomba - Ranking Kriteria</strong>
        </div>
        <div class="card-body">
            <!-- Step Indicator -->
            <div class="step-indicator text-center">
                <span class="step completed">
                    <i class="bi bi-check-circle me-1"></i>Preferensi Tingkat
                </span>
                <i class="bi bi-arrow-right mx-2"></i>
                <span class="step active">
                    <i class="bi bi-list-ol me-1"></i>Ranking Kriteria
                </span>
                <i class="bi bi-arrow-right mx-2"></i>
                <span class="step pending">
                    <i class="bi bi-star me-1"></i>Hasil Rekomendasi
                </span>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('mahasiswa.recomendation.process') }}">
                @csrf

                <!-- Hidden inputs untuk data step 1 -->
                @if(session('step1_data'))
                    @foreach(session('step1_data.selected_jenis', []) as $jenis)
                        <input type="hidden" name="selected_jenis[]" value="{{ $jenis }}">
                    @endforeach
                    @foreach(session('step1_data.tingkat_scores', []) as $tingkat_id => $score)
                        <input type="hidden" name="tingkat_scores[{{ $tingkat_id }}]" value="{{ $score }}">
                    @endforeach
                @endif

                {{-- Ranking Kriteria --}}
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-list-ol me-2"></i>Ranking Kriteria Penilaian
                    </label>
                    <small class="text-muted d-block mb-3">Urutkan kriteria berdasarkan kepentingan (1 = Paling Penting, 5 = Kurang Penting)</small>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Petunjuk:</strong> Berikan ranking yang berbeda untuk setiap kriteria. Semakin kecil angka, semakin penting kriteria tersebut.
                    </div>

                    @foreach (['jenis' => 'Jenis Lomba', 'tingkat_penyelenggara' => 'Tingkat Penyelenggara', 'biaya' => 'Biaya', 'hadiah' => 'Hadiah', 'tingkat' => 'Tingkat'] as $crit => $label)
                        <div class="row align-items-center mb-3">
                            <div class="col-md-6">
                                <label class="form-label mb-0 fw-bold">{{ $label }}</label>
                                <small class="text-muted d-block">
                                    @if($crit == 'jenis')
                                        Kesesuaian jenis lomba dengan minat
                                    @elseif($crit == 'tingkat_penyelenggara')
                                        Kredibilitas penyelenggara lomba
                                    @elseif($crit == 'biaya')
                                        Biaya pendaftaran lomba
                                    @elseif($crit == 'hadiah')
                                        Nilai hadiah yang ditawarkan
                                    @else
                                        Tingkat kompetisi (regional/nasional/internasional)
                                    @endif
                                </small>
                            </div>
                            <div class="col-md-6">
                                <select name="criteria_ranks[{{ $crit }}]" class="form-select criteria-rank" required>
                                    <option value="">-- Pilih Ranking --</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">Ranking {{ $i }} {{ $i == 1 ? '(Paling Penting)' : ($i == 5 ? '(Kurang Penting)' : '') }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('mahasiswa.recomendation.form') }}" class="btn btn-outline-maroon">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Step 1
                    </a>
                    <button type="submit" class="btn btn-maroon">
                        <i class="bi bi-star me-2"></i>Proses Rekomendasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.criteria-rank').on('change', function () {
            let selectedValues = [];
            let isDuplicate = false;

            $('.criteria-rank').each(function () {
                let val = $(this).val();
                if (val) {
                    if (selectedValues.includes(val)) {
                        isDuplicate = true;
                        $(this).val('');
                        return false;
                    }
                    selectedValues.push(val);
                }
            });

            if (isDuplicate) {
                alert('Setiap kriteria harus memiliki ranking yang berbeda!');
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function (e) {
            let filledSelects = 0;
            $('.criteria-rank').each(function () {
                if ($(this).val()) filledSelects++;
            });

            if (filledSelects < 5) {
                e.preventDefault();
                alert('Harap isi ranking untuk semua kriteria!');
            }
        });
    });
</script>
@endsection
