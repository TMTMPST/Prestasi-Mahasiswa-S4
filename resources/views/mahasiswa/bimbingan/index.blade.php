@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #0c1e47;
            --secondary: #f7b71d;
            --accent1: #f26430;
            --accent3: #e6e6e6;
            --light: #ffffff;
        }
        body { background: var(--accent3); }
        .dashboard-card {
            border-left: 6px solid var(--secondary);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(12, 30, 71, 0.07);
            background: var(--light);
        }
        .card-header.bg-maroon {
            background-color: var(--primary) !important;
            color: var(--light);
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 18px 18px 0 0;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }
        .btn-success {
            background: var(--secondary);
            color: var(--primary);
            font-weight: 500;
            border-radius: 8px;
            border: none;
            transition: all 0.2s;
        }
        .btn-success:hover,
        .btn-success:focus {
            background: var(--primary);
            color: var(--light);
        }
        .btn-primary {
            background: var(--primary);
            color: var(--light);
            border-radius: 8px;
            border: none;
            transition: all 0.2s;
        }
        .btn-primary:hover,
        .btn-primary:focus {
            background: var(--secondary);
            color: var(--primary);
        }
        .btn-danger {
            border-radius: 8px;
        }
        .table thead th {
            background-color: var(--primary);
            color: var(--light);
            font-size: 1rem;
            letter-spacing: 0.5px;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }
        .table-bordered {
            border-radius: 12px;
            overflow: hidden;
        }
    </style>
    <div class="container py-4">
        <a href="/bimbingan/tambah_bimbingan" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle me-1"></i>Ajukan Bimbingan
        </a>
        <div class="card dashboard-card shadow-sm">
            <div class="card-header bg-maroon">
                <i class="bi bi-journal-text me-2"></i>
                <strong>Data Bimbingan</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lomba</th>
                            <th>Nama Pengaju</th>
                            <th>Nama Dosen Pembimbing</th>
                            <th>Deskripsi Lomba</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bimbingan as $index => $bimb)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $bimb->lomba->nama_lomba }}</td>
                                <td>{{ $bimb->nama_pengaju }}</td>
                                <td>{{ $bimb->dosen->nama }}</td>
                                <td>{{ $bimb->deskripsi_lomba }}</td>
                                <td>{{ $bimb->status }}</td>
                                <td>
                                    <form action="{{ route('mahasiswa.destroy_bimbingan', $bimb->id_bimbingan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                    <a href="{{ route('mahasiswa.edit_bimbingan', $bimb->id_bimbingan) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data mahasiswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection