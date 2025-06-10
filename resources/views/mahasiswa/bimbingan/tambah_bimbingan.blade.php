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
        .form-label {
            color: var(--primary);
            font-weight: 500;
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
        .btn-secondary {
            border-radius: 8px;
        }
    </style>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header bg-maroon">
                        <i class="bi bi-plus-circle me-2"></i>
                        <strong>Tambah Bimbingan</strong>
                    </div>
                    <form action="{{ route('mahasiswa.store_bimbingan') }}" method="POST" class="p-4">
                        @csrf
                        <div class="mb-3">
                            <label for="id_lomba" class="form-label">Nama Lomba</label>
                            <select id="id_lomba" name="id_lomba" class="form-select" required>
                                <option value="">Pilih Lomba</option>
                                @foreach ($lombas as $lomba)
                                    <option value="{{ $lomba->id_lomba }}">{{ $lomba->nama_lomba }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label">Nama Pengaju</label>
                            <select class="form-select" id="nim" name="nim" required>
                                <option value="">Pilih Mahasiswa</option>
                                @foreach ($mahasiswas as $mhs)
                                    <option value="{{ $mhs->nim }}">{{ $mhs->nama }} ({{ $mhs->nim }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_lomba" class="form-label">Deskripsi Lomba</label>
                            <textarea id="deskripsi_lomba" name="deskripsi_lomba" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">Nama Dosen Pembimbing</label>
                            <select id="nip" name="nip" class="form-select" required>
                                <option value="">Pilih Dosen</option>
                                @foreach ($dosen as $dsn)
                                    <option value="{{ $dsn->nip }}">{{ $dsn->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                        <a href="{{ route('mahasiswa.bimbingan.index') }}" class="btn btn-secondary ms-2">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection