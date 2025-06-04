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
    .table tbody tr {
        transition: background 0.15s;
    }
    .table tbody tr:hover {
        background: var(--light-gray);
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header ranking-header d-flex align-items-center" style="font-size:1.2rem;">
                    <i class="bi bi-star me-2"></i>Rekomendasi Lomba Untuk Anda
                </div>
                
                <div class="card-body">
                    @if(count($competitions) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Nama Lomba</th>
                                        <th>Skor Rekomendasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($competitions as $index => $data)
                                        <tr>
                                            <td class="text-center">
                                                @if($index == 0)
                                                    <i class="bi bi-trophy-fill text-warning fs-4"></i>
                                                @elseif($index == 1)
                                                    <i class="bi bi-award-fill text-secondary fs-4"></i>
                                                @elseif($index == 2)
                                                    <i class="bi bi-award-fill text-warning fs-4"></i>
                                                @else
                                                    <span class="badge bg-secondary">{{ $index + 1 }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $data['competition']->nama_lomba }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $data['competition']->penyelenggara }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary fs-6">
                                                    {{ number_format($data['net_flow'], 4) }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $today = now();
                                                    $startDate = \Carbon\Carbon::parse($data['competition']->tgl_dibuka);
                                                    $endDate = \Carbon\Carbon::parse($data['competition']->tgl_ditutup);
                                                @endphp
                                                @if($today < $startDate)
                                                    <span class="badge bg-info">Akan Dibuka</span>
                                                @elseif($today >= $startDate && $today <= $endDate)
                                                    <span class="badge bg-success">Pendaftaran Dibuka</span>
                                                @else
                                                    <span class="badge bg-danger">Pendaftaran Ditutup</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data['competition']->link_lomba)
                                                    <a href="{{ $data['competition']->link_lomba }}" target="_blank" class="btn btn-maroon btn-sm">
                                                        <i class="bi bi-link-45deg me-1"></i> Detail
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4 d-flex gap-2">
                            <a href="{{ route('mahasiswa.recomendation.trace') }}" class="btn btn-outline-maroon">
                                <i class="bi bi-graph-up me-2"></i>Lihat Detail Perhitungan
                            </a>
                            <a href="{{ route('mahasiswa.recomendation.form') }}" class="btn btn-maroon">
                                <i class="bi bi-arrow-clockwise me-2"></i>Ubah Preferensi
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning text-center">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            Tidak ada rekomendasi lomba yang tersedia.
                            <br>
                            <a href="{{ route('mahasiswa.recomendation.form') }}" class="btn btn-warning mt-2">
                                Coba Lagi
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection