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
        <br>
        <div class="card dashboard-card shadow-sm">
            <div class="card-header ranking-header d-flex align-items-center" style="font-size:1.2rem;">
                <strong>Verifikasi Prestasi </strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Lomba</th>
                            <th>Sertifikat</th>
                            <th>Foto Bukti</th>
                            <th>Foto Poster</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($verifikasis as $verifikasi)
                            <tr>
                                <td>{{ $verifikasi->peringkat }}</td>
                                <td>{{ $verifikasi->dataLomba->nama_lomba }}</td>
                                <td class="ellipsis-cell">
                                    @if ($verifikasi->sertif)
                                        <a href="{{ asset('storage/' . $verifikasi->sertif) }}" target="_blank"
                                            class="text-decoration-none">
                                            <i class="bi bi-file-earmark-text"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="ellipsis-cell">
                                    @if ($verifikasi->foto_bukti)
                                        <a href="{{ asset('storage/' . $verifikasi->foto_bukti) }}" target="_blank"
                                            class="text-decoration-none">
                                            <i class="bi bi-image"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="ellipsis-cell">
                                    @if ($verifikasi->poster_lomba)
                                        <a href="{{ asset('storage/' . $verifikasi->poster_lomba) }}" target="_blank"
                                            class="text-decoration-none">
                                            <i class="bi bi-image"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $verifikasi->verifikasi }}</td>
                                <td>
                                    <!-- Tombol Accept -->
                                    <form action="{{ route('admin.verifikasi.update', $verifikasi->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Accepted">
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>

                                    <!-- Tombol Reject -->
                                    <form action="{{ route('admin.verifikasi.update', $verifikasi->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
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
