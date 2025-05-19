@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    body { background: #f7f8fa; }
    .bg-maroon { background-color: #ef4a24 !important; }
    .bg-navy { background-color: #2c3e50 !important; }
    .text-maroon { color: #ef4a24 !important; }
    .text-navy { color: #2c3e50 !important; }
    .dashboard-card {
        border-left: 6px solid #ef4a24;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(44,62,80,0.07);
    }
    .lomba-card {
        border-top: 4px solid #ef4a24;
        border-radius: 18px;
        transition: transform 0.15s, box-shadow 0.15s;
        box-shadow: 0 2px 12px rgba(44,62,80,0.08);
    }
    .lomba-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(44,62,80,0.13);
    }
    .ranking-header {
        background: linear-gradient(90deg, #ef4a24 80%);
        color: #fff;
        border-radius: 18px 18px 0 0;
    }
    .card-header {
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 18px 18px 0 0;
        letter-spacing: 0.5px;
    }
    .btn-maroon {
        background-color: #ef4a24;
        color: #fff;
        border: none;
        border-radius: 8px;
        transition: background 0.2s;
        font-weight: 500;
    }
    .btn-maroon:hover, .btn-maroon:focus {
        background-color: #2c3e50;
        color: #fff;
    }
    .btn-outline-maroon {
        border: 1.5px solid #ef4a24;
        color: #ef4a24;
        background: #fff;
        border-radius: 8px;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
    }
    .btn-outline-maroon:hover, .btn-outline-maroon:focus {
        background: #ef4a24;
        color: #fff;
    }
    .table thead th {
        background-color: #2c3e50;
        color: #fff;
        font-size: 1rem;
        letter-spacing: 0.5px;
    }
    .badge.bg-primary {
        background-color: #ef4a24 !important;
        font-weight: 500;
        border-radius: 8px;
        padding: 0.5em 1em;
    }
    .avatar-initial {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #2c3e50;
        color: #fff;
        text-align: center;
        line-height: 30px;
        font-size: 1.2rem;
    }
    .table tbody tr {
        transition: background 0.15s;
    }
    .table tbody tr:hover {
        background: #f3f3f3;
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
</style>

<div class="container py-4">
    {{-- Dashboard Card --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header bg-maroon text-white d-flex align-items-center" style="font-size:1.2rem;">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-center align-items-center fs-5 text-maroon" style="font-weight:500;">
                        <i class="bi bi-person-badge me-2"></i>Anda login sebagai Dosen!
                    </div>
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
            <div class="d-flex flex-nowrap overflow-auto" style="gap: 1.5rem; padding-bottom: 8px;">
                @forelse ($lombas->take(4) as $lomba)
                    <div class="flex-shrink-0" style="min-width: 350px; max-width: 400px;">
                        <div class="card lomba-card border-0 h-100">
                            <div class="card-header bg-navy text-white text-truncate">
                                <i class="bi bi-award me-2"></i>{{ $lomba->nama_lomba }}
                            </div>
                            <div class="card-body" style="font-size: 0.97rem;">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="mb-2">
                                            <strong class="text-maroon">Tingkat:</strong>
                                            {{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}
                                        </p>
                                        <p class="mb-2">
                                            <strong class="text-maroon">Kategori:</strong>
                                            {{ $lomba->kategoriRelasi->nama_kategori ?? '-' }}
                                        </p>
                                        <p class="mb-0">
                                            <strong class="text-maroon">Jenis:</strong>
                                            {{ $lomba->jenisRelasi->nama_jenis ?? '-' }}
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-2">
                                            <strong class="text-maroon">Penyelenggara:</strong>
                                            {{ $lomba->penyelenggara }}
                                        </p>
                                        <p class="mb-2">
                                            <strong class="text-maroon">Mulai:</strong>
                                            {{ \Carbon\Carbon::parse($lomba->tanggal_mulai)->format('d M Y') }}
                                        </p>
                                        <p class="mb-0">
                                            <strong class="text-maroon">Selesai:</strong>
                                            {{ \Carbon\Carbon::parse($lomba->tanggal_selesai)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-between">
                                    <a href="#" class="btn btn-outline-maroon btn-sm px-3">
                                        <i class="bi bi-info-circle"></i> Detail
                                    </a>
                                    <a href="https://docs.google.com/forms/d/19H28i0qObFYdjkMxXbRN_eOjimVQlGO1L6rKW6-sqXc/edit" target="_blank" class="btn btn-maroon btn-sm px-3">
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
@endsection


