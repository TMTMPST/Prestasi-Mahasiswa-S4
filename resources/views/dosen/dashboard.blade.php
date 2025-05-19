@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .bg-maroon { background-color: #953c37 !important; }
    .bg-navy { background-color: #2c3e50 !important; }
    .text-maroon { color: #953c37 !important; }
    .text-navy { color: #2c3e50 !important; }
    .border-maroon { border-color: #953c37 !important; }
    .dashboard-card { border-left: 6px solid #953c37; border-radius: 12px; }
    .lomba-card { border-top: 4px solid #953c37; border-radius: 12px; }
    .ranking-header {
        background: linear-gradient(90deg, #953c37 0%, #2c3e50 100%);
        color: #fff;
        border-radius: 12px 12px 0 0;
    }
    .card-header {
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 12px 12px 0 0;
    }
    .btn-maroon {
        background-color: #953c37;
        color: #fff;
        border: none;
        transition: background 0.2s;
    }
    .btn-maroon:hover, .btn-maroon:focus {
        background-color: #2c3e50;
        color: #fff;
    }
    .btn-outline-maroon {
        border: 1.5px solid #953c37;
        color: #953c37;
        background: #fff;
        transition: background 0.2s, color 0.2s;
    }
    .btn-outline-maroon:hover, .btn-outline-maroon:focus {
        background: #953c37;
        color: #fff;
    }
    .table thead th {
        background-color: #2c3e50;
        color: #fff;
    }
    .badge.bg-primary {
        background-color: #953c37 !important;
    }
    /* Hide scrollbars for horizontal/vertical scrolls */
    .d-flex.flex-nowrap.overflow-auto::-webkit-scrollbar,
    .table-responsive::-webkit-scrollbar {
        display: none;
    }
    .d-flex.flex-nowrap.overflow-auto,
    .table-responsive {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
</style>

<div class="container py-4">
    {{-- Dashboard Card --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header bg-maroon text-white d-flex align-items-center">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('status') }}
                        </div>
                    @endif
                    <span class="fs-5 text-maroon">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="bi bi-person-badge me-2"></i>Anda login sebagai Dosen !!!
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Rekomendasi Lomba --}}
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-3 fw-bold text-maroon">
                <i class="bi bi-trophy me-2"></i>Rekomendasi Lomba
            </h5>
            <div class="d-flex flex-nowrap overflow-auto" style="gap: 1rem; padding-bottom: 8px;">
                @forelse ($lombas->take(4) as $lomba)
                    <div class="flex-shrink-0" style="min-width: 350px; max-width: 400px;">
                        <div class="card lomba-card shadow border-0 h-100">
                            <div class="card-header bg-navy text-white text-truncate">
                                <i class="bi bi-award me-2"></i>{{ $lomba->nama_lomba }}
                            </div>
                            <div class="card-body" style="font-size: 0.95rem;">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="mb-2"><strong class="text-maroon">Tingkat:</strong> {{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}</p>
                                        <p class="mb-2"><strong class="text-maroon">Kategori:</strong> {{ $lomba->kategoriRelasi->nama_kategori ?? '-' }}</p>
                                        <p class="mb-0"><strong class="text-maroon">Jenis:</strong> {{ $lomba->jenisRelasi->nama_jenis ?? '-' }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-2"><strong class="text-maroon">Penyelenggara:</strong> {{ $lomba->penyelenggara }}</p>
                                        <p class="mb-2"><strong class="text-maroon">Mulai:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal_mulai)->format('d M Y') }}</p>
                                        <p class="mb-0"><strong class="text-maroon">Selesai:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal_selesai)->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-between">
                                    <a href="#" class="btn btn-outline-maroon btn-sm">
                                        <i class="bi bi-info-circle"></i> Detail
                                    </a>
                                    <a href="https://docs.google.com/forms/d/19H28i0qObFYdjkMxXbRN_eOjimVQlGO1L6rKW6-sqXc/edit" target="_blank" class="btn btn-maroon btn-sm">
                                        <i class="bi bi-pencil-square"></i> Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex-shrink-0" style="min-width: 350px;">
                        <div class="alert alert-warning mb-0 w-100">
                            <i class="bi bi-exclamation-triangle me-2"></i>Tidak ada informasi lomba tersedia.
                        </div>
                    </div>
                @endforelse
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
                                @forelse ($mahasiswa as $index => $mhs)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <i class="bi bi-person-circle me-1 text-maroon"></i>{{ $mhs->nama }}
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
@endsection

