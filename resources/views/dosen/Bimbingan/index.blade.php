@extends('layouts.app')

@push('styles')
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
        --shadow: 0 4px 24px rgba(0,0,0,0.08);
    }

    body {
        background: var(--light-gray);
        min-height: 100vh;
        color: #000;
    }

    .custom-card {
        border: 1px solid var(--gray);
        border-radius: 16px;
        box-shadow: var(--shadow);
        background: var(--light);
        margin-top: 40px;
        overflow: hidden;
        color: #000;
    }

    .custom-card-header {
        background: var(--primary);
        color: #000;
        font-weight: bold;
        font-size: 1.3rem;
        letter-spacing: 1px;
        padding: 1.2rem 2rem;
        border-bottom: 1px solid var(--gray);
    }

    .custom-table {
        border-radius: 12px;
        overflow: hidden;
        margin-top: 10px;
        color: #000;
    }

    .custom-table thead {
        background: var(--secondary);
        color: #000;
        font-size: 1.05rem;
    }

    .custom-table tbody tr {
        transition: background 0.2s;
        color: #000;
    }

    .custom-table tbody tr:hover {
        background: var(--accent2);
    }

    .custom-table tbody tr:nth-child(even) {
        background: var(--light-gray);
    }

    .custom-table tbody tr:nth-child(odd) {
        background: var(--light);
    }

    .custom-table th,
    .custom-table td {
        vertical-align: middle;
        padding: 0.85rem 1rem;
        border: none;
        color: #000;
    }

    .badge-warning,
    .badge-success {
        color: #000;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
@endpush

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-header custom-card-header text-center">
            <i class="fas fa-users mr-2"></i>
            Daftar Mahasiswa Bimbingan
        </div>
        <div class="card-body">
            @if ($mahasiswa->count())
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Prestasi Tertinggi</th>
                                <th>Poin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $index => $mhs)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="font-weight-bold">{{ $mhs->nama }}</span></td>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>
                                        <span class="badge badge-warning px-3 py-2" style="font-size:0.95rem;">
                                            {{ $mhs->prestasi_tertinggi ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success px-3 py-2" style="font-size:0.95rem;">
                                            {{ $mhs->poin_presma }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('dosen.bimbingan.prestasi', $mhs->nim) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-trophy mr-1"></i> Prestasi
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Belum ada mahasiswa bimbingan.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
