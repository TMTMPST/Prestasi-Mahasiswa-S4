@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        --success: #28a745;
        --warning: #ffc107;
        --danger: #dc3545;
        --info: #17a2b8;
    }

    body { 
        background: var(--accent3); 
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
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .stats-label {
        font-size: 0.9rem;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .chart-container {
        position: relative;
        height: 300px;
        background: var(--light);
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 4px 24px rgba(12,30,71,0.07);
    }

    .ranking-badge {
        background: linear-gradient(135deg, var(--secondary), var(--accent2));
        color: var(--primary);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .prestasi-card {
        border-left: 4px solid var(--accent1);
        background: var(--light);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .prestasi-card:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 20px rgba(242,100,48,0.15);
    }

    .trend-chart {
        height: 200px;
    }

    .nav-pills .nav-link {
        border-radius: 25px;
        padding: 0.5rem 1.5rem;
        margin: 0 0.25rem;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link.active {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .nav-pills .nav-link:not(.active) {
        color: var(--primary);
        border-color: var(--primary);
        background-color: transparent;
    }

    .nav-pills .nav-link:not(.active):hover {
        background-color: var(--primary);
        color: var(--light);
    }

    .badge-verified {
        background-color: var(--success) !important;
    }

    .badge-pending {
        background-color: var(--warning) !important;
    }

    .badge-rejected {
        background-color: var(--danger) !important;
    }

    .progress-custom {
        height: 8px;
        border-radius: 10px;
        background-color: var(--light-gray);
    }

    .progress-custom .progress-bar {
        background: linear-gradient(90deg, var(--secondary), var(--accent1));
        border-radius: 10px;
    }
</style>

<div class="container py-4">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stats-card">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-graph-up me-2"></i>
                    <h4 class="mb-0">Statistik Prestasi - {{ $mahasiswa->nama }}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 text-muted">NIM: {{ $mahasiswa->nim }}</p>
                            <p class="mb-0 text-muted">Program Studi: {{ $mahasiswa->prodi }}</p>
                        </div>
                        <div class="text-end">
                            <div class="ranking-badge">
                                <i class="bi bi-trophy me-1"></i>
                                Ranking #{{ $rankingPosition }} dari {{ $totalMahasiswa }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-trophy-fill text-warning mb-3" style="font-size: 2rem;"></i>
                    <div class="stats-number">{{ $totalPrestasi }}</div>
                    <div class="stats-label">Total Prestasi</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle-fill text-success mb-3" style="font-size: 2rem;"></i>
                    <div class="stats-number">{{ $prestasiVerified }}</div>
                    <div class="stats-label">Terverifikasi</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-clock-fill text-warning mb-3" style="font-size: 2rem;"></i>
                    <div class="stats-number">{{ $prestasiPending }}</div>
                    <div class="stats-label">Pending</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-star-fill" style="font-size: 2rem; color: var(--secondary);"></i>
                    <div class="stats-number">{{ $mahasiswa->poin_presma }}</div>
                    <div class="stats-label">Poin Presma</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card stats-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-pie-chart me-2"></i>Prestasi Berdasarkan Tingkat</h5>
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
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Prestasi Berdasarkan Jenis</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="jenisChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card stats-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-award me-2"></i>Distribusi Peringkat</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="peringkatChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card stats-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-check-square me-2"></i>Status Verifikasi</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="verifikasiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Progress Comparison --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stats-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart-line me-2"></i>Perbandingan dengan Mahasiswa Lain</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Poin Anda vs Rata-rata Prodi</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Poin Anda: {{ $mahasiswa->poin_presma }}</span>
                                <span>Rata-rata: {{ number_format($avgPoinProdi, 1) }}</span>
                            </div>
                            <div class="progress progress-custom">
                                <div class="progress-bar" style="width: {{ $avgPoinProdi > 0 ? min(($mahasiswa->poin_presma / max($avgPoinProdi * 2, $mahasiswa->poin_presma)) * 100, 100) : 100 }}%"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Posisi Ranking</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Ranking: #{{ $rankingPosition }}</span>
                                <span>Total: {{ $totalMahasiswa }}</span>
                            </div>
                            <div class="progress progress-custom">
                                <div class="progress-bar" style="width: {{ (($totalMahasiswa - $rankingPosition + 1) / $totalMahasiswa) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Achievements --}}
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="card stats-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Prestasi Terbaru</h5>
                </div>
                <div class="card-body">
                    @forelse($prestasiTerbaru as $prestasi)
                        <div class="prestasi-card p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $prestasi->dataLomba->nama_lomba ?? 'Lomba tidak ditemukan' }}</h6>
                                    <p class="mb-1 text-muted">
                                        <i class="bi bi-award me-1"></i>{{ $prestasi->peringkat }} - 
                                        <i class="bi bi-layers me-1"></i>{{ $prestasi->dataLomba->tingkatRelasi->nama_tingkat ?? '-' }}
                                    </p>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>{{ $prestasi->created_at->format('d M Y') }}
                                    </small>
                                </div>
                                <span class="badge badge-{{ strtolower($prestasi->verifikasi) == 'accepted' ? 'verified' : (strtolower($prestasi->verifikasi) == 'pending' ? 'pending' : 'rejected') }}">
                                    {{ $prestasi->verifikasi }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-trophy text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Belum ada prestasi yang dicatat</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Keahlian Saya</h5>
                </div>
                <div class="card-body">
                    @forelse($keahlianMahasiswa as $keahlian)
                        <span class="badge bg-secondary text-dark me-2 mb-2 p-2">
                            {{ $keahlian->nama_jenis }}
                        </span>
                    @empty
                        <div class="text-center py-3">
                            <i class="bi bi-plus-circle text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2 mb-0">Belum ada keahlian yang dipilih</p>
                            <a href="{{ route('mahasiswa.profile.index') }}" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="bi bi-pencil me-1"></i>Tambah Keahlian
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart.js configuration
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
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }

    // Jenis Chart
    const jenisData = @json($prestasiByJenis);
    if (jenisData.length > 0) {
        new Chart(document.getElementById('jenisChart'), {
            type: 'bar',
            data: {
                labels: jenisData.map(item => item.nama_jenis),
                datasets: [{
                    label: 'Jumlah Prestasi',
                    data: jenisData.map(item => item.total),
                    backgroundColor: colors[1],
                    borderColor: colors[0],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Peringkat Chart
    const peringkatData = @json($prestasiByPeringkat);
    if (peringkatData.length > 0) {
        new Chart(document.getElementById('peringkatChart'), {
            type: 'pie',
            data: {
                labels: peringkatData.map(item => item.peringkat),
                datasets: [{
                    data: peringkatData.map(item => item.total),
                    backgroundColor: colors.slice(0, peringkatData.length),
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
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }

    // Verifikasi Chart
    const verifikasiData = [
        {verifikasi: 'Accepted', total: {{ $prestasiVerified }}},
        {verifikasi: 'Pending', total: {{ $prestasiPending }}},
        {verifikasi: 'Rejected', total: {{ $prestasiRejected }}}
    ].filter(item => item.total > 0);

    if (verifikasiData.length > 0) {
        new Chart(document.getElementById('verifikasiChart'), {
            type: 'doughnut',
            data: {
                labels: verifikasiData.map(item => item.verifikasi),
                datasets: [{
                    data: verifikasiData.map(item => item.total),
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
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
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection