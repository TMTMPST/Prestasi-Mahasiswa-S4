@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 2px 12px rgba(12, 30, 71, 0.08);
        }

        .lomba-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(12, 30, 71, 0.13);
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
    </style>

    <div class="container">
        <a href="/manajemen-presma/create" class="btn btn-success mb-3">Tambah Prestasi</a>
        <br>
        <div class="card dashboard-card shadow-sm">
            <div class="card-header ranking-header d-flex align-items-center" style="font-size:1.2rem;">
                <strong>Prestasi Mahasiswa</strong>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Peringkat</th>
                            <th>Nama Lomba</th>
                            <th style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Sertifikat</th>
                            <th style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Foto Bukti</th>
                            <th style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Foto Poster</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presmas as $presma)
                            <tr>
                                <td>{{ $presma->nimMahasiswa->nama ?? 'N/A' }}</td>
                                <td>{{ $presma->peringkat }}</td>
                                <td>{{ $presma->dataLomba->nama_lomba }}</td>
                                <td
                                    style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $presma->sertif }}</td>
                                <td
                                    style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $presma->foto_bukti }}</td>
                                <td
                                    style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $presma->poster_lomba }}</td>
                                <td>{{ $presma->verifikasi }}</td>
                                <td>
                                    <a href="/manajemen-presma/edit/{{ $presma->id }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="/manajemen-presma/delete/{{ $presma->id }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Hapus</button>
                                    </form>
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
