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
            <div class="col-md-7">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header">
                        <i class="bi bi-person-plus-fill me-2"></i>
                        Tambah Data Pengguna
                    </div>
                    <form action="{{ url('/manajemen-user/store') }}" method="POST" class="p-4">
                        @csrf

                        <!-- Level Dropdown -->
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-select" id="level" name="level" aria-label="Default select example">
                                <option selected>Pilih Level</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id_level }}">{{ $level->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- NIM / NIP / Username -->
                        <div class="mb-3">
                            <label for="nim_nip_username" class="form-label">NIM / NIP / Username</label>
                            <input class="form-control" type="text" id="nim_nip_username" name="nim_nip_username"
                                placeholder="Default input" aria-label="default input example">
                        </div>

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Default input"
                                aria-label="default input example">
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="text" id="password" name="password" placeholder="Default input"
                                aria-label="default input example">
                        </div>

                        <!-- Additional Fields for Mahasiswa -->
                        <div class="mb-3" id="angkatanField" style="display: none;">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input class="form-control" type="number" id="angkatan" name="angkatan"
                                placeholder="Masukkan Angkatan" aria-label="default input example">
                        </div>
                        <div class="mb-3" id="prodiField" style="display: none;">
                            <label for="program_studi" class="form-label">Program Studi</label>
                            <input class="form-control" type="text" id="prodi" name="prodi"
                                placeholder="Masukkan Program Studi" aria-label="default input example">
                        </div>

                        <a href="/manajemen-user" class="btn btn-secondary">Kembali</a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const levelSelect = document.getElementById('level');
            const angkatanField = document.getElementById('angkatanField');
            const prodiField = document.getElementById('prodiField');
            levelSelect.addEventListener('change', function() {
                const selectedLevel = levelSelect.value;
                if (selectedLevel === 'MHS') {
                    angkatanField.style.display = 'block';
                    prodiField.style.display = 'block';
                } else {
                    angkatanField.style.display = 'none';
                    prodiField.style.display = 'none';
                }
            });
        });
    </script>
@endsection