@extends('layouts.app')

@section('content')
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
    .bg-maroon { background-color: var(--primary) !important; }
    .bg-navy { background-color: var(--secondary) !important; }
    .text-maroon { color: var(--primary) !important; }
    .text-navy { color: var(--secondary) !important; }
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
    .badge.bg-primary {
        background-color: var(--secondary) !important;
        color: var(--primary) !important;
        font-weight: 500;
        border-radius: 8px;
        padding: 0.5em 1em;
    }
    .table thead th {
        background-color: var(--primary);
        color: var(--light);
        font-size: 1rem;
        letter-spacing: 0.5px;
    }
    .table tbody tr {
        transition: background 0.15s;
    }
    .table tbody tr:hover {
        background: var(--light-gray);
    }
</style>
<div class="container py-4">
    <div class="card dashboard-card mb-4">
        <div class="card-header">
            <strong>Profil Mahasiswa</strong>
        </div>
        <div class="card-body bg-white rounded-bottom" style="border-radius:0 0 18px 18px;">
            <table class="table table-borderless mb-0">
                <tbody>
                <tr>
                    <th class="text-maroon" style="width:180px;">NIM</th>
                    <td>{{ $mahasiswa->nim }}</td>
                </tr>
                <tr>
                    <th class="text-maroon">Nama</th>
                    <td>{{ $mahasiswa->nama }}</td>
                </tr>
                <tr>
                    <th class="text-maroon">Angkatan</th>
                    <td>{{ $mahasiswa->angkatan }}</td>
                </tr>
                <tr>
                    <th class="text-maroon">Program Studi</th>
                    <td>{{ $mahasiswa->prodi }}</td>
                </tr>
                <tr>
                    <th class="text-maroon">Email</th>
                    <td>{{ $mahasiswa->email }}</td>
                </tr>
                <tr>
                    <th class="text-maroon">Poin Prestasi</th>
                    <td>{{ $mahasiswa->poin_presma }}</td>
                </tr>
                <tr>
                    <th class="text-maroon">Prestasi Tertinggi</th>
                    <td>{{ $mahasiswa->prestasi_tertinggi ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="text-maroon">Keahlian</th>
                    <td>
                        {{ optional($mahasiswa->keahlian->first())->nama_jenis ?? '-' }}
                    </td>
                </tr>
                </tbody>
            </table>
            <a href="{{ route('mahasiswa.profile.update_profile', $mahasiswa->nim) }}" class="btn btn-maroon mt-4 px-4">
                <i class="bi bi-pencil-square me-2"></i>Update Profile
            </a>
        </div>
    </div>
</div>
@endsection
