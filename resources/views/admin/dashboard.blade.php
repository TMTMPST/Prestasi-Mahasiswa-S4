@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #0c1e47;
            /* Biru tua utama (bg utama welcome) */
            --secondary: #f7b71d;
            /* Kuning emas (aksen utama welcome) */
            --accent1: #f26430;
            /* Oranye (aksen tombol/ikon) */
            --accent2: #f9a11b;
            /* Oranye muda */
            --accent3: #e6e6e6;
            /* Abu terang (background) */
            --light: #ffffff;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #f8f9fa;
        }

        body {
            background: var(--accent3);
        }

        .bg-maroon {
            background-color: var(--primary) !important;
        }

        .bg-navy {
            background-color: var(--secondary) !important;
        }

        .text-maroon {
            color: var(--primary) !important;
        }

        .text-navy {
            color: var(--secondary) !important;
        }

        .dashboard-card {
            border-left: 6px solid var(--secondary);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(12, 30, 71, 0.07);
        }

        .lomba-card {
            border-top: 4px solid var(--accent1);
            border-radius: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(12, 30, 71, 0.08);
            position: relative;
            overflow: hidden;
        }

        .lomba-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .lomba-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(12, 30, 71, 0.15);
            border-top-color: var(--secondary);
        }

        .lomba-card:hover::before {
            left: 100%;
        }

        .lomba-card:hover .card-header {
            background: linear-gradient(135deg, var(--accent1), var(--secondary)) !important;
        }

        .ranking-header {
            background: linear-gradient(90deg, var(--primary) 100%);
            color: var(--light);
            border-radius: 18px 18px 0 0;
        }

        .card-header {
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 18px 18px 0 0;
            letter-spacing: 0.5px;
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

        .table thead th {
            background-color: var(--primary);
            color: var(--light);
            font-size: 1rem;
            letter-spacing: 0.5px;
        }

        .badge.bg-primary {
            background-color: var(--secondary) !important;
            color: var(--primary) !important;
            font-weight: 500;
            border-radius: 8px;
            padding: 0.5em 1em;
        }

        .avatar-initial {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--primary);
            color: var(--light);
            text-align: center;
            line-height: 30px;
            font-size: 1.2rem;
        }

        .table tbody tr {
            transition: background 0.15s;
        }

        .table tbody tr:hover {
            background: var(--light-gray);
        }

        .d-flex.flex-nowrap.overflow-auto::-webkit-scrollbar,
        .table-responsive::-webkit-scrollbar {
            display: none;
        }

        .d-flex.flex-nowrap.overflow-auto,
        .table-responsive {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .slide-container {
            position: relative;
        }

        .slide-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: var(--primary);
            border: none;
            border-radius: 50%;
            color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(12, 30, 71, 0.3);
        }

        .slide-nav:hover {
            background: var(--secondary);
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
        }

        .slide-nav.prev {
            left: -20px;
        }

        .slide-nav.next {
            right: -20px;
        }

        .slide-nav:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            transform: translateY(-50%) scale(0.9);
        }

        .slide-nav:disabled:hover {
            background: var(--gray);
            transform: translateY(-50%) scale(0.9);
        }

        .slide-indicators {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }

        .slide-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--gray);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slide-dot.active {
            background: var(--secondary);
            transform: scale(1.2);
        }

        .slide-scroll {
            scroll-behavior: smooth;
        }

    .stats-card {
        border-left: 6px solid var(--secondary);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(12,30,71,0.07);
        background: var(--light);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 35px rgba(12,30,71,0.15);
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
    }

    .stats-label {
        font-size: 0.8rem;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .chart-container {
        position: relative;
        height: 250px;
        background: var(--light);
        border-radius: 18px;
        padding: 15px;
        box-shadow: 0 4px 24px rgba(12,30,71,0.07);
    }

    .prestasi-item {
        border-left: 4px solid var(--accent1);
        background: var(--light);
        border-radius: 8px;
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .prestasi-item:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(242,100,48,0.15);
    }

    .urgent-badge {
        background: linear-gradient(135deg, #dc3545, #fd7e14);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    </style>

    <div class="container py-4">
        {{-- Dashboard Card --}}
        <div class="row justify-content-center mb-4">
            <div class="col-md-12">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header bg-maroon text-white d-flex align-items-center" style="font-size:1.2rem;">
                        <i class="bi bi-shield-check me-2"></i> Admin Dashboard
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-center align-items-center fs-5 text-maroon"
                            style="font-weight:500;">
                            <i class="bi bi-person-gear me-2"></i>Anda login sebagai Administrator!
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- Statistics Overview --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header bg-maroon text-white d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-graph-up me-2"></i>Statistik Sistem
                    </div>
                    @if($prestasiPendingVerifikasi > 0 || $lombaPendingVerifikasi > 0)
                        <div class="urgent-badge">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            {{ $prestasiPendingVerifikasi + $lombaPendingVerifikasi }} Menunggu Verifikasi
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    {{-- Main Stats Cards --}}
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-people-fill text-primary mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="stats-number">{{ $totalMahasiswa }}</div>
                                    <div class="stats-label">Total Mahasiswa</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-person-workspace text-info mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="stats-number">{{ $totalDosen }}</div>
                                    <div class="stats-label">Total Dosen</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-trophy-fill text-warning mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="stats-number">{{ $totalLomba }}</div>
                                    <div class="stats-label">Total Lomba</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-award-fill mb-2" style="font-size: 1.5rem; color: var(--secondary);"></i>
                                    <div class="stats-number">{{ $totalPrestasi }}</div>
                                    <div class="stats-label">Total Prestasi</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Verification Stats --}}
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card stats-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-clock-fill text-warning mb-2" style="font-size: 1.2rem;"></i>
                                    <div class="stats-number text-warning">{{ $prestasiPendingVerifikasi }}</div>
                                    <div class="stats-label">Prestasi Pending</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card stats-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-check-circle-fill text-success mb-2" style="font-size: 1.2rem;"></i>
                                    <div class="stats-number text-success">{{ $prestasiVerified }}</div>
                                    <div class="stats-label">Prestasi Verified</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card stats-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-people-fill text-info mb-2" style="font-size: 1.2rem;"></i>
                                    <div class="stats-number text-info">{{ $bimbinganAccepted }}</div>
                                    <div class="stats-label">Bimbingan Aktif</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Charts Section --}}
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="card stats-card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="bi bi-pie-chart me-2"></i>Prestasi by Tingkat</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="tingkatChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card stats-card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Status Verifikasi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="verifikasiChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Activities --}}
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="card stats-card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="bi bi-clock-history me-2"></i>Prestasi Perlu Verifikasi</h6>
                                </div>
                                <div class="card-body">
                                    @forelse($prestasiTerbaruPending as $prestasi)
                                        <div class="prestasi-item">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1" style="font-size: 0.9rem;">{{ $prestasi->nimMahasiswa->nama ?? 'Mahasiswa tidak ditemukan' }}</h6>
                                                    <p class="mb-1 text-muted" style="font-size: 0.8rem;">
                                                        <i class="bi bi-trophy me-1"></i>{{ $prestasi->dataLomba->nama_lomba ?? 'Lomba tidak ditemukan' }}
                                                    </p>
                                                    <p class="mb-0 text-muted" style="font-size: 0.8rem;">
                                                        <i class="bi bi-award me-1"></i>{{ $prestasi->peringkat }} - 
                                                        <i class="bi bi-calendar me-1"></i>{{ $prestasi->created_at ? $prestasi->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}
                                                    </p>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.verifikasi.index') }}" class="btn btn-primary btn-sm" style="font-size: 0.7rem;">
                                                        <i class="bi bi-check-lg"></i>
                                                    </a>
                                                    <a href="{{ route('admin.presma.edit', $prestasi->id) }}" class="btn btn-outline-primary btn-sm" style="font-size: 0.7rem;">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-3">
                                            <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2 mb-0" style="font-size: 0.9rem;">Semua prestasi sudah diverifikasi</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card stats-card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="bi bi-star me-2"></i>Top Mahasiswa</h6>
                                </div>
                                <div class="card-body">
                                    @forelse($topMahasiswa as $index => $mhs)
                                        <div class="prestasi-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-warning text-dark me-2">#{{ $index + 1 }}</span>
                                                        <div>
                                                            <h6 class="mb-0" style="font-size: 0.9rem;">{{ $mhs->nama }}</h6>
                                                            <small class="text-muted">{{ $mhs->nim }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="badge bg-success" style="font-size: 0.7rem;">
                                                    {{ $mhs->total_prestasi }} Prestasi
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-3">
                                            <i class="bi bi-people text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2 mb-0" style="font-size: 0.9rem;">Belum ada data prestasi</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        {{-- Rekomendasi Lomba --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header bg-maroon text-white d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-trophy me-2"></i>Manajemen Lomba
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-light text-dark me-2">{{ $lombas->count() }} Lomba</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="slide-container">
                            <button class="slide-nav prev" id="prevBtn" onclick="slideLeft()">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="slide-nav next" id="nextBtn" onclick="slideRight()">
                                <i class="bi bi-chevron-right"></i>
                            </button>

                            <div class="d-flex flex-nowrap overflow-auto slide-scroll" id="lombaSlider"
                                style="gap: 1.5rem; padding-bottom: 8px;">
                                @forelse ($lombas->take(6) as $index => $lomba)
                                    <div class="flex-shrink-0 slide-item" style="min-width: 350px; max-width: 400px;">
                                        <div class="card lomba-card border-0 h-100 mb-0 d-flex flex-column">
                                            <div
                                                class="card-header bg-navy text-white text-truncate d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-award me-2"></i>
                                                    <span class="text-truncate">{{ $lomba->nama_lomba }}</span>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-link text-white p-0"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="bi bi-eye me-2"></i>Lihat</a></li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="bi bi-pencil me-2"></i>Edit</a></li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li><a class="dropdown-item text-danger" href="#"><i
                                                                    class="bi bi-trash me-2"></i>Hapus</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body d-flex flex-column justify-content-between"
                                                style="font-size: 0.97rem; flex: 1 1 auto;">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p class="mb-2">
                                                                <strong class="text-maroon">Tingkat:</strong>
                                                                <span
                                                                    class="badge bg-info text-dark ms-1">{{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}</span>
                                                            </p>

                                                            <p class="mb-0">
                                                                <strong class="text-maroon">Jenis:</strong><br>
                                                                <small>{{ $lomba->jenisRelasi->nama_jenis ?? '-' }}</small>
                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-2">
                                                                <strong class="text-maroon">Penyelenggara:</strong><br>
                                                                <small>{{ Str::limit($lomba->penyelenggara, 25) }}</small>
                                                            </p>
                                                            <p class="mb-2">
                                                                <strong class="text-maroon">Mulai:</strong><br>
                                                                <small
                                                                    class="text-success">{{ $lomba->tgl_dibuka ? \Carbon\Carbon::parse($lomba->tgl_dibuka)->format('d M Y') : 'Tidak diset' }}</small>
                                                            </p>
                                                            <p class="mb-0">
                                                                <strong class="text-maroon">Selesai:</strong><br>
                                                                <small
                                                                    class="text-danger">{{ $lomba->tgl_ditutup ? \Carbon\Carbon::parse($lomba->tgl_ditutup)->format('d M Y') : 'Tidak diset' }}</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4 d-flex justify-content-between align-items-end"
                                                    style="min-height: 38px;">
                                                    <a href="{{ route('admin.lomba.edit', $lomba->id_lomba) }}"
                                                        class="btn btn-outline-maroon btn-sm px-3">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-maroon btn-sm btn-detail-lomba"
                                                        data-id="{{ $lomba->id_lomba }}" data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailLomba">
                                                        <i class="bi bi-info-circle-fill me-1"></i> Detail
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex-shrink-0" style="min-width: 350px;">
                                        <div class="alert alert-warning mb-0 w-100 d-flex align-items-center">
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            <div>
                                                <strong>Tidak ada lomba tersedia</strong><br>
                                                <small>Belum ada data lomba yang dapat ditampilkan</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            @if ($lombas->count() > 3)
                                <div class="slide-indicators">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Detail Lomba -->
        <div class="modal fade" id="modalDetailLomba" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header w-100 d-flex justify-content-center">
                        <h5 class="modal-title text-center w-100">Detail Lomba</h5>
                        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalDetailLombaContent">
                        <!-- Konten detail lomba akan dimuat lewat AJAX -->
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Ranking Mahasiswa --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header ranking-header d-flex align-items-center">
                        <i class="bi bi-list-ol me-2"></i>Ranking Mahasiswa
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px;">
                            <table class="table table-bordered mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NIM</th>
                                        <th>Program Studi</th>
                                        <th>Prestasi Tertinggi</th>
                                        <th>Poin Presma</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mahasiswa->take(6) as $index => $mhs)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <span class="avatar-initial">
                                                    <i class="bi bi-person-fill"></i>
                                                </span>
                                                {{ $mhs->nama }}
                                            </td>
                                            <td>{{ $mhs->nim }}</td>
                                            <td>{{ $mhs->prodi }}</td>
                                            <td>{{ $mhs->prestasi_tertinggi }}</td>
                                            <td>
                                                <span class="badge bg-primary fs-6">
                                                    <i class="bi bi-star-fill me-1"></i>{{ $mhs->poin_presma }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada data mahasiswa</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slideWidth = 370; // Width of each card + gap
        const maxSlides = Math.max(0, {{ $lombas->count() }} - 3);

        function updateSlideButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            if (prevBtn && nextBtn) {
                prevBtn.disabled = currentSlide <= 0;
                nextBtn.disabled = currentSlide >= maxSlides;
            }

            // Update indicators
            document.querySelectorAll('.slide-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === Math.floor(currentSlide / 3));
            });
        }

        function slideLeft() {
            if (currentSlide > 0) {
                currentSlide--;
                const slider = document.getElementById('lombaSlider');
                if (slider) {
                    slider.scrollTo({
                        left: currentSlide * slideWidth,
                        behavior: 'smooth'
                    });
                }
                updateSlideButtons();
            }
        }

        function slideRight() {
            if (currentSlide < maxSlides) {
                currentSlide++;
                const slider = document.getElementById('lombaSlider');
                if (slider) {
                    slider.scrollTo({
                        left: currentSlide * slideWidth,
                        behavior: 'smooth'
                    });
                }
                updateSlideButtons();
            }
        }

        function slideTo(index) {
            currentSlide = index * 3;
            currentSlide = Math.min(currentSlide, maxSlides);
            const slider = document.getElementById('lombaSlider');
            if (slider) {
                slider.scrollTo({
                    left: currentSlide * slideWidth,
                    behavior: 'smooth'
                });
            }
            updateSlideButtons();
        }

        // Initialize slide buttons on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateSlideButtons();

            // Auto-hide navigation if not enough items
            if ({{ $lombas->count() }} <= 3) {
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                if (prevBtn && nextBtn) {
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                }
            }
        });

        // Add touch/swipe support for mobile
        let startX = 0;
        let scrollLeft = 0;
        const slider = document.getElementById('lombaSlider');

        if (slider) {
            slider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('touchmove', (e) => {
                if (!startX) return;
                const x = e.touches[0].pageX - slider.offsetLeft;
                const walk = (x - startX) * 2;
                slider.scrollLeft = scrollLeft - walk;
            });

            slider.addEventListener('touchend', () => {
                startX = 0;
            });
        }

// Chart.js configuration for admin dashboard
document.addEventListener('DOMContentLoaded', function() {
    Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
    Chart.defaults.color = '#6c757d';

    const colors = ['#0c1e47', '#f7b71d', '#f26430', '#f9a11b', '#28a745', '#dc3545', '#17a2b8'];

    // Tingkat Chart
    const tingkatData = @json($prestasiByTingkat);
    if (tingkatData.length > 0) {
        new Chart(document.getElementById('tingkatChart'), {
            type: 'doughnut',
            data: {
                labels: tingkatData.map(item => item.nama_tingkat),
                datasets: [{
                    data: tingkatData.map(item => item.total),
                    backgroundColor: colors.slice(0, tingkatData.length),
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    } else {
        document.getElementById('tingkatChart').parentElement.innerHTML = '<div class="text-center py-4"><i class="bi bi-pie-chart text-muted" style="font-size: 2rem;"></i><p class="text-muted mt-2 mb-0">Belum ada data</p></div>';
    }

    // Verifikasi Chart
    const verifikasiData = @json($prestasiByVerifikasi);
    if (verifikasiData.length > 0) {
        new Chart(document.getElementById('verifikasiChart'), {
            type: 'bar',
            data: {
                labels: verifikasiData.map(item => item.verifikasi),
                datasets: [{
                    label: 'Jumlah Prestasi',
                    data: verifikasiData.map(item => item.total),
                    backgroundColor: verifikasiData.map(item => {
                        switch(item.verifikasi) {
                            case 'Accepted': return '#28a745';
                            case 'Pending': return '#ffc107';
                            case 'Rejected': return '#dc3545';
                            default: return colors[0];
                        }
                    }),
                    borderColor: colors[0],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    } else {
        document.getElementById('verifikasiChart').parentElement.innerHTML = '<div class="text-center py-4"><i class="bi bi-bar-chart text-muted" style="font-size: 2rem;"></i><p class="text-muted mt-2 mb-0">Belum ada data</p></div>';
    }
});

        function attachDetailListeners() {
            document.querySelectorAll('.btn-detail-lomba').forEach(btn => {
                btn.removeEventListener('click', btn._detailHandler || (() => {}));
                btn._detailHandler = function() {
                    const id = this.getAttribute('data-id');
                    const modalContent = document.getElementById('modalDetailLombaContent');
                    modalContent.innerHTML =
                        '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';
                    fetch(`/Lomba/${id}/detail`)
                        .then(res => res.text())
                        .then(html => {
                            modalContent.innerHTML = html;
                        })
                        .catch(() => {
                            modalContent.innerHTML =
                                '<div class="alert alert-danger">Gagal memuat detail lomba.</div>';
                        });
                };
                btn.addEventListener('click', btn._detailHandler);
            });
        }

        attachDetailListeners();
    </script>
@endsection
