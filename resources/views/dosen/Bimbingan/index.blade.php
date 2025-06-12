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

        .badge.bg-success {
            background-color: #28a745 !important;
        }
        .badge.bg-secondary {
            background-color: #6c757d !important;
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
            margin-right: 6px;
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

        .btn-detail-bimbingan {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--light);
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-detail-bimbingan:hover,
        .btn-detail-bimbingan:focus {
            background: var(--primary);
            color: var(--light);
            border-color: var(--primary);
        }
    </style>

    <div class="container py-4">
        {{-- Tabel Request Bimbingan --}}
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="card dashboard-card shadow-sm mb-4">
                    <div class="card-header ranking-header d-flex align-items-center" style="font-size:1.2rem;">
                        <i class="bi bi-people-fill me-2"></i>Request Bimbingan
                    </div>
                    <div class="card-body">
                        @if ($bimbinganRequest->count())
                            <div class="table-responsive" style="max-height: 500px;">
                                <table class="table table-bordered mb-0 align-middle">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pengaju</th>
                                            <th>NIM</th>
                                            <th>Nama Lomba</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bimbinganRequest as $index => $bmb)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <span class="avatar-initial"><i class="bi bi-person-fill"></i></span>
                                                    {{ $bmb->mahasiswa->nama ?? ($bmb->nama_pengaju ?? 'Belum Ada Nama') }}
                                                </td>
                                                <td>{{ $bmb->mahasiswa->nim ?? ($bmb->nim ?? 'Belum Ada NIM') }}</td>
                                                <td>{{ $bmb->lomba->nama_lomba ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-secondary">Pending</span>
                                                </td>
                                                <td>
                                                    @if(isset($bmb->nim))
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-info btn-sm me-1 btn-detail-bimbingan"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#bimbinganModal"
                                                            data-nama="{{ $bmb->mahasiswa->nama ?? ($bmb->nama_pengaju ?? '-') }}"
                                                            data-nim="{{ $bmb->nim }}"
                                                            data-lomba="{{ $bmb->lomba->nama_lomba ?? '-' }}"
                                                            data-deskripsi="{{ $bmb->deskripsi_lomba ?? '-' }}"
                                                            data-status="{{ $bmb->status }}"
                                                            data-dosen="{{ $bmb->dosen->nama ?? '-' }}"
                                                        >
                                                            <i class="bi bi-info-circle me-1"></i> Detail
                                                        </button>
                                                        <form action="{{ route('bimbingan.accept', $bmb->nim) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="bi bi-check-circle me-1"></i> Accept
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('bimbingan.reject', $bmb->nim) }}" method="POST" class="d-inline" onsubmit="return confirm('Tolak permintaan ini?')">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="bi bi-x-circle me-1"></i> Reject
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-danger">NIM tidak ditemukan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                Belum ada request bimbingan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Bimbingan Diterima --}}
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header ranking-header d-flex align-items-center" style="font-size:1.2rem;">
                        <i class="bi bi-check-circle-fill me-2"></i>Daftar Mahasiswa Bimbingan
                    </div>
                    <div class="card-body">
                        @if ($bimbinganAccepted->count())
                            <div class="table-responsive" style="max-height: 500px;">
                                <table class="table table-bordered mb-0 align-middle">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pengaju</th>
                                            <th>NIM</th>
                                            <th>Nama Lomba</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bimbinganAccepted as $index => $bmb)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <span class="avatar-initial"><i class="bi bi-person-fill"></i></span>
                                                    {{ $bmb->mahasiswa->nama ?? ($bmb->nama_pengaju ?? 'Belum Ada Nama') }}
                                                </td>
                                                <td>{{ $bmb->mahasiswa->nim ?? ($bmb->nim ?? 'Belum Ada NIM') }}</td>
                                                <td>{{ $bmb->lomba->nama_lomba ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-success">Accepted</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                Belum ada bimbingan diterima.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
     <div class="modal fade" id="bimbinganModal" tabindex="-1" aria-labelledby="bimbinganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 18px; box-shadow: 0 4px 24px rgba(12,30,71,0.15); border: none;">
                <div class="modal-header" style="background: linear-gradient(90deg, var(--primary) 100%); color: var(--light); border-radius: 18px 18px 0 0; border-bottom: none;">
                    <h5 class="modal-title" id="bimbinganModalLabel">Detail Bimbingan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1); opacity: 0.8;"></button>
                </div>
                <div class="modal-body" style="background: var(--light); color: var(--dark); border-radius: 0 0 18px 18px; font-size: 1rem;">
                    <div class="row mb-2">
                        <div class="col-5 fw-semibold">Nama Mahasiswa</div>
                        <div class="col-7">: <span id="modal-nama"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-semibold">NIM</div>
                        <div class="col-7">: <span id="modal-nim"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-semibold">Nama Lomba</div>
                        <div class="col-7">: <span id="modal-lomba"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-semibold">Deskripsi Lomba</div>
                        <div class="col-7">: <span id="modal-deskripsi"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-semibold">Nama Dosen Pembimbing</div>
                        <div class="col-7">: <span id="modal-dosen"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-semibold">Status</div>
                        <div class="col-7">: <span id="modal-status"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk isi modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var nama = document.getElementById('modal-nama');
            var nim = document.getElementById('modal-nim');
            var lomba = document.getElementById('modal-lomba');
            var deskripsi_lomba = document.getElementById('modal-deskripsi');
            var dosen = document.getElementById('modal-dosen');
            var status = document.getElementById('modal-status');

            document.querySelectorAll('.btn-detail-bimbingan').forEach(function(btn) {
                btn.addEventListener('click', function () {
                    nama.textContent = btn.getAttribute('data-nama') || '-';
                    nim.textContent = btn.getAttribute('data-nim') || '-';
                    lomba.textContent = btn.getAttribute('data-lomba') || '-';
                    deskripsi_lomba.textContent = btn.getAttribute('data-deskripsi') || '-';
                    dosen.textContent = btn.getAttribute('data-dosen') || '-';
                    status.textContent = btn.getAttribute('data-status') || '-';
                });
            });
        });
    </script>
@endsection
