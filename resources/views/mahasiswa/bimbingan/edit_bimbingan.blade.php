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
                        <i class="bi bi-pencil-square me-2"></i>
                        <strong>Edit Bimbingan</strong>
                    </div>
                    <form action="{{ route('mahasiswa.update_bimbingan', $bimbingan->id_bimbingan) }}" method="POST" class="p-4">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_lomba" class="form-label">Nama Lomba</label>
                            <select id="id_lomba" name="id_lomba" class="form-select" required>
                                <option value="">Pilih Lomba</option>
                                @foreach ($lombas as $lomba)
                                    <option value="{{ $lomba->id_lomba }}"
                                        {{ $lomba->id_lomba == old('id_lomba', $bimbingan->id_lomba) ? 'selected' : '' }}>
                                        {{ $lomba->nama_lomba }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_pengaju" class="form-label">Nama Pengaju</label>
                            <input class="form-control" type="text" id="nama_pengaju" name="nama_pengaju"
                                value="{{ old('nama_pengaju', $bimbingan->nama_pengaju) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label">Nama Dosen Pembimbing</label>
                            <select id="nip" name="nip" class="form-select" required>
                                <option value="">Pilih Dosen</option>
                                @foreach ($dosen as $dsn)
                                    <option value="{{ $dsn->nip }}"
                                        {{ $dsn->nip == old('nip', $bimbingan->nip) ? 'selected' : '' }}>
                                        {{ $dsn->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i>Update
                            </button>
                            <a href="{{ route('mahasiswa.bimbingan.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection