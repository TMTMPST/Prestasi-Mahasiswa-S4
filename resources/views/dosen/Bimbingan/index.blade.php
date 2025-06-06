@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* ...style tetap... */
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
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bimbinganModalLabel">Detail Bimbingan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <strong>Nama Mahasiswa:</strong> <span id="modal-nama"></span>
                    </div>
                    <div class="mb-2">
                        <strong>NIM:</strong> <span id="modal-nim"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Nama Lomba:</strong> <span id="modal-lomba"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Deskripsi Lomba:</strong> <span id="modal-deskripsi"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Nama Dosen Pembimbing:</strong> <span id="modal-dosen"></span>
                    </div>
                    <div class="mb-2">
                        <strong>Status:</strong> <span id="modal-status"></span>
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
