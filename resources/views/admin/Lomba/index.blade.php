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
            margin-top: 30px;
        }

        .ranking-header {
            background: linear-gradient(90deg, var(--primary) 100%);
            color: var(--light);
            border-radius: 18px 18px 0 0;
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 18px 24px;
        }

        .btn-maroon {
            background-color: var(--secondary);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }

        .btn-maroon:hover,
        .btn-maroon:focus {
            background-color: var(--primary);
            color: var(--light);
        }

        .btn-primary {
            border-radius: 8px;
            font-weight: 500;
        }

        .table thead th {
            background-color: var(--primary);
            color: var(--light);
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-align: center;
            vertical-align: middle;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: var(--light-gray);
        }

        .table-bordered {
            border-radius: 12px;
            overflow: hidden;
        }

        .table tbody tr:hover {
            background: var(--accent2);
            color: var(--light);
            transition: background 0.15s, color 0.15s;
        }

        .btn-action {
            margin: 2px 0;
            min-width: 90px;
        }

        .add-btn {
            background: linear-gradient(90deg, var(--secondary), var(--accent1));
            color: var(--primary);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 24px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(12, 30, 71, 0.07);
            transition: background 0.2s, color 0.2s;
        }

        .add-btn:hover {
            background: var(--primary);
            color: var(--light);
        }
    </style>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
            <h4 class="text-maroon mb-0"><i class="bi bi-trophy-fill me-2"></i>Manajemen Lomba</h4>
            <div class="action-buttons">
                <a href="{{ route('lomba.export') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-file-earmark-excel"></i> Export to Excel
                </a>
                <a href="/manajemen-lomba/create" class="btn btn-primary btn-sm" style="text-decoration: none;">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Lomba
                </a>
            </div>
        </div>
        <div class="card dashboard-card shadow-sm">
            <div class="ranking-header d-flex align-items-center">
                <strong>Data Lomba</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Nama Lomba</th>
                                <th>Tingkat</th>
                                <th>Jenis</th>
                                <th>Tingkat Penyelenggara</th>
                                <th>Biaya Pendaftaran</th>
                                <th>Hadiah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lombas as $lomba)
                                <tr>
                                    <td>{{ $lomba->nama_lomba }}</td>
                                    <td>{{ $lomba->tingkatRelasi->nama_tingkat }}</td>
                                    <td>{{ $lomba->jenisRelasi->nama_jenis }}</td>
                                    <td>{{ $lomba->tingkat_penyelenggara }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $lomba->biaya == 0 ? 'Gratis' : 'Rp' . number_format($lomba->biaya, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>{{ $lomba->hadiah }}</td>
                                    <td>
                                        <span
                                            class="badge 
                                            @if ($lomba->verifikasi == 'Accepted') bg-success
                                            @elseif($lomba->verifikasi == 'Pending')
                                                bg-warning text-dark
                                            @elseif($lomba->verifikasi == 'Rejected')
                                                bg-danger @endif">
                                            {{ $lomba->verifikasi }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            <a href="/manajemen-lomba/edit/{{ $lomba->id_lomba }}"
                                                class="btn btn-primary btn-sm btn-action">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-maroon btn-sm btn-detail-lomba"
                                                data-id="{{ $lomba->id_lomba }}" data-bs-toggle="modal"
                                                data-bs-target="#modalDetailLomba">
                                                <i class="bi bi-info-circle-fill me-1"></i> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($lombas->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center text-gray">Belum ada data lomba.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal Detail Lomba -->
        <div class="modal fade" id="modalDetailLomba" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header w-100 d-flex justify-content-center">
                        <h5 class="modal-title text-center w-100">Detail Lomba</h5>
                        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalDetailLombaContent">
                        <!-- Konten detail lomba akan dimuat lewat AJAX -->
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function attachDetailListeners() {
            document.querySelectorAll('.btn-detail-lomba').forEach(btn => {
                btn.removeEventListener('click', btn._detailHandler || (() => {}));
                btn._detailHandler = function() {
                    const id = this.getAttribute('data-id');
                    const modalContent = document.getElementById('modalDetailLombaContent');
                    modalContent.innerHTML =
                        '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';
                    fetch(`/Lomba/${id}/detail`)
                        .then(res => res.text())
                        .then(html => {
                            modalContent.innerHTML = html;
                        })
                        .catch(() => {
                            modalContent.innerHTML =
                                '<div class="alert alert-danger">Gagal memuat detail lomba.</div>';
                        });
                };
                btn.addEventListener('click', btn._detailHandler);
            });
        }

        attachDetailListeners();
    </script>
@endsection
