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

        body {
            background: var(--accent3);
        }

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
                        <strong>Tambah Data Prestasi</strong>
                    </div>
                    <form action="{{ route('mahasiswa.store_prestasi') }}" method="POST" enctype="multipart/form-data"
                        class="p-4">
                        @csrf
                        <div class="mb-3">
                            <label for="peringkat" class="form-label">Peringkat</label>
                            <select class="form-select" name="peringkat" id="peringkat" aria-label="Default select example">
                                <option selected>Masukkan Peringkat</option>
                                <option value="Juara 1">Juara 1</option>
                                <option value="Juara 2">Juara 2</option>
                                <option value="Juara 3">Juara 3</option>
                            </select>
                        </div>

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
                            <label for="sertif" class="form-label">Sertifikat</label>
                            <input class="form-control" type="file" id="sertif" name="sertif">
                        </div>

                        <div class="mb-3">
                            <label for="foto_bukti" class="form-label">Foto Bukti</label>
                            <input class="form-control" type="file" id="foto_bukti" name="foto_bukti">
                        </div>

                        <div class="mb-3">
                            <label for="poster_lomba" class="form-label">Poster Lomba</label>
                            <input class="form-control" type="file" id="poster_lomba" name="poster_lomba">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                        <a href="{{ route('mahasiswa.prestasi.index') }}" class="btn btn-secondary ms-2">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </a>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
