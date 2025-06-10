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
            <div class="col-md-15">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header text-center">
                        <i></i>
                        Tambah Lomba
                    </div>
                    <div class="card-body">
                        <form action="/manajemen-lomba/store" method="POST">
                            @csrf
                            <!-- Nama Lomba -->
                            <div class="mb-3">
                                <label for="nama_lomba" class="form-label">Nama Lomba</label>
                                <input type="text" class="form-control" id="nama_lomba" name="nama_lomba" required>
                            </div>

                            <!-- Tingkat -->
                            <div class="mb-3">
                                <label for="tingkat_id" class="form-label">Tingkat</label>
                                <select class="form-select" id="tingkat_id" name="tingkat" required>
                                    <option value="">Pilih Tingkat</option>
                                    @foreach ($tingkats as $tingkat)
                                        <option value="{{ $tingkat->id_tingkat }}">{{ $tingkat->nama_tingkat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Jenis -->
                            <div class="mb-3">
                                <label for="jenis_id" class="form-label">Jenis</label>
                                <select class="form-select" id="jenis_id" name="jenis" required>
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($jeniss as $jenis)
                                        <option value="{{ $jenis->id_jenis }}">{{ $jenis->nama_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tingkat Penyelenggara -->
                            <div class="mb-3">
                                <label for="tingkat_penyelenggara" class="form-label">Tingkat Penyelenggara</label>
                                <select class="form-select" id="tingkat_penyelenggara" name="tingkat_penyelenggara" required>
                                    <option value="">Pilih Tingkat Penyelenggara</option>
                                    <option value="Internal Kampus / Komunitas Lokal">Internal Kampus / Komunitas Lokal</option>
                                    <option value="Kampus Lain / Organisasi Mahasiswa Nasional">Kampus Lain / Organisasi Mahasiswa Nasional</option>
                                    <option value="Perusahaan / Start-up Teknologi">Perusahaan / Start-up Teknologi</option>
                                    <option value="Lembaga Pemerintah / Kementerian">Lembaga Pemerintah / Kementerian</option>
                                    <option value="Asosiasi Profesional / Internasional (IEEE, ACM, Google, dsb)">Asosiasi Profesional / Internasional (IEEE, ACM, Google, dsb)</option>
                                </select>
                            </div>

                            <!-- Penyelenggara -->
                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                            
                            <!-- Link -->
                            <div class="mb-3">
                                <label for="link_lomba" class="form-label">Link Lomba</label>
                                <input type="text" class="form-control" id="link_lomba" name="link_lomba" required>
                            </div>

                            <!-- Biaya -->
                            <div class="mb-3">
                                <label for="biaya" class="form-label">Biaya</label>
                                <input type="number" class="form-control" id="biaya" 
                                value="0" name="biaya" required>
                            </div>

                            <!-- Hadiah -->
                            <div class="mb-3">
                                <label for="hadiah" class="form-label">Hadiah</label>
                                <input type="text" class="form-control" id="hadiah" 
                                name="hadiah" value="0" required>
                            </div>

                            <input type="hidden" name="verifikasi" value="Pending">

                            <!-- Tanggal Mulai -->
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Dibuka</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tgl_dibuka" required>
                            </div>

                            <!-- Tanggal Selesai -->
                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Ditutup</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tgl_ditutup" required>
                            </div>

                            <a href="/manajemen-lomba" class="btn btn-secondary">Kembali</a>
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
    </div>
@endsection