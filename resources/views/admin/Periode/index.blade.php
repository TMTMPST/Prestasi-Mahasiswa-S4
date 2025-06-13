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

        .btn-success,
        .btn-primary,
        .btn-danger {
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--secondary);
            color: var(--primary);
            border: none;
            transition: background 0.2s;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--primary);
            color: var(--light);
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #c0392b;
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

        .table-responsive::-webkit-scrollbar {
            display: none;
        }

        .table-responsive {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
    </style>

    <div class="container py-4">
        {{-- <a href="/manajemen-user/tambah" class="btn btn-success mb-3"><i class="bi bi-person-plus-fill me-1"></i>Tambah
            Pengguna</a> --}}
        <div class="card dashboard-card shadow-sm">
            <div class="card-header ranking-header d-flex align-items-center" style="font-size:1.2rem;">
                <i class="bi bi-people-fill me-2"></i><strong>Data Mahasiswa</strong>
            </div>
            <div class="card-body">
                {{-- Filter by Angkatan --}}
                <form action="{{ route('admin.periode_mahasiswa.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="angkatan" class="form-select">
                                <option value="">Pilih Angkatan</option>
                                {{-- Loop angkatan yang ada, misalnya 2019, 2020, dll --}}
                                @foreach ($filter->pluck('angkatan')->unique() as $periode)
                                    <option value="{{ $periode }}"
                                        {{ $periode == request()->angkatan ? 'selected' : '' }}>
                                        {{ $periode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            {{-- Tombol Reset --}}
                            <a href="{{ route('admin.periode_mahasiswa.index') }}" class="btn btn-secondary ms-2">Reset</a>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ route('periode_mahasiswa.export', ['angkatan' => request()->angkatan]) }}" class="btn btn-success me-2">
                                <i class="bi bi-file-earmark-excel"></i> Export to Excel
                            </a>
                        </div>
                    </div>
                </form>

                {{-- Tabel Data Mahasiswa --}}
                <table class="table table-striped table-bordered mb-0 align-middle table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center">Level</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Angkatan</th>
                            <th>Program Studi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $item)
                            <tr>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $item->level ?? 'N/A' }}</span>
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->angkatan }}</td>
                                <td>{{ $item->prodi }}</td>
                                <td class="text-center">
                                    <a href="/manajemen-user/edit/{{ $item->nim }}"
                                        class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="/manajemen-user/delete/{{ $item->nim }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus Mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>
                                            Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
