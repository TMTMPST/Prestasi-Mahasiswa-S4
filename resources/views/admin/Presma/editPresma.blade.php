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
        body { background: var(--accent3); }
        .dashboard-card {
            border-left: 6px solid var(--secondary);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(12,30,71,0.07);
        }
        .card-header {
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 18px 18px 0 0;
            letter-spacing: 0.5px;
            background: linear-gradient(90deg, var(--primary) 100%);
            color: var(--light);
        }
        .btn-success, .btn-secondary {
            border-radius: 8px;
            font-weight: 500;
        }
        .form-label {
            font-weight: 500;
            color: var(--primary);
        }
        .form-control, .form-select {
            border-radius: 8px;
            border-color: var(--primary);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(247, 183, 29, 0.25);
        }
        .alert-danger {
            border-radius: 8px;
        }
    </style>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header">
                        <i class="bi bi-award me-2"></i>
                        Edit Data Prestasi
                    </div>
                    <form action="{{ route('admin.presma.update', $presma->id) }}" method="POST" enctype="multipart/form-data" class="p-4">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="mahasiswa" class="form-label">Mahasiswa</label>
                            <select class="form-select" name="mahasiswa" id="mahasiswa" aria-label="Default select example">
                                <option selected>Pilih Mahasiswa</option>
                                @foreach ($mahasiswa as $mhs)
                                    <option value="{{ $mhs->nim }}" {{ $presma->nimMahasiswa->nim == $mhs->nim ? 'selected' : '' }}>
                                        {{ $mhs->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="peringkat" class="form-label">Peringkat</label>
                            <select class="form-select" name="peringkat" id="peringkat" aria-label="Default select example">
                                <option value="" {{ $presma->peringkat == '' ? 'selected' : '' }}>Masukkan Peringkat</option>
                                <option value="Juara 1" {{ $presma->peringkat == 'Juara 1' ? 'selected' : '' }}>Juara 1</option>
                                <option value="Juara 2" {{ $presma->peringkat == 'Juara 2' ? 'selected' : '' }}>Juara 2</option>
                                <option value="Juara 3" {{ $presma->peringkat == 'Juara 3' ? 'selected' : '' }}>Juara 3</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_lomba" class="form-label">Nama Lomba</label>
                            <select id="id_lomba" name="id_lomba" class="form-select" required>
                                <option value="">Pilih Lomba</option>
                                @foreach ($lombas as $lomba)
                                    <option value="{{ $lomba->id_lomba }}"
                                        {{ $presma->id_lomba == $lomba->id_lomba ? 'selected' : '' }}>
                                        {{ $lomba->nama_lomba }}
                                    </option>
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

                        <input type="hidden" name="verifikasi" value="Pending">

                        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
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