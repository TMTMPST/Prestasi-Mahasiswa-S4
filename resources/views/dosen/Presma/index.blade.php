@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --primary: #9a3324;
        --secondary: #0c1e47;
        --accent1: #f26430;
        --accent2: #f7b71d;
        --accent3: #f9a11b;
        --light: #ffffff;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #f8f9fa;
    }
    body { background: var(--light-gray); }
    .bg-maroon { background-color: var(--primary) !important; }
    .bg-navy { background-color: var(--secondary) !important; }
    .text-maroon { color: var(--primary) !important; }
    .text-navy { color: var(--secondary) !important; }
    .dashboard-card {
        border-left: 6px solid var(--primary);
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
    .table thead th {
        background-color: var(--secondary);
        color: var(--light);
        font-size: 1rem;
        letter-spacing: 0.5px;
    }
    .badge.bg-primary {
        background-color: var(--secondary) !important;
        font-weight: 500;
        border-radius: 8px;
        padding: 0.5em 1em;
    }
    .avatar-initial {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: var(--secondary);
        color: var(--light);
        text-align: center;
        line-height: 30px;
        font-size: 1.2rem;
        margin-right: 10px;
    }
    .table tbody tr {
        transition: background 0.15s;
    }
    .table tbody tr:hover {
        background: var(--light-gray);
    }
    .table-responsive::-webkit-scrollbar {
        display: none;
    }
    .table-responsive {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
</style>

<div class="container py-4">
    {{-- Ranking Mahasiswa --}}
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header ranking-header d-flex align-items-center" style="font-size:1.2rem;">
                    <i class="bi bi-list-ol me-2"></i>Ranking Mahasiswa
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 500px;">
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
