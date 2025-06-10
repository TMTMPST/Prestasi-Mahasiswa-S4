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
            <div class="col-md-7">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Edit Data Pengguna
                    </div>
                    <form action="{{ route('admin.pengguna.update', $pengguna->nim ?? ($pengguna->nip ?? $pengguna->username)) }}"
                        method="POST" class="p-4">
                        @csrf
                        @method('PUT')

                        <!-- Level Dropdown -->
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select name="level" id="level" class="form-select">
                                <option value="MHS" {{ $pengguna->level == 'MHS' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="DSN" {{ $pengguna->level == 'DOS' ? 'selected' : '' }}>Dosen</option>
                                <option value="ADM" {{ $pengguna->level == 'ADM' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <!-- Nama Input -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $pengguna->nama }}"
                                required>
                        </div>

                        <!-- NIM / NIP / Username Input -->
                        <div class="mb-3">
                            <label for="nim_nip_username" class="form-label">
                                @if ($pengguna->level == 'MHS')
                                    NIM
                                @elseif($pengguna->level == 'DSN')
                                    NIP
                                @else
                                    Username
                                @endif
                            </label>
                            <input type="text" name="nim_nip_username" id="nim_nip_username" class="form-control"
                                value="{{ $pengguna->level == 'MHS' ? $pengguna->nim : ($pengguna->level == 'DSN' ? $pengguna->nip : $pengguna->username) }}"
                                required>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>

                        <!-- Additional Fields for Mahasiswa -->
                        <div class="mb-3" id="angkatanField" style="display: none;">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input class="form-control" type="number" id="angkatan" name="angkatan"
                                value="{{ $pengguna->angkatan }}" aria-label="default input example">
                        </div>

                        <div class="mb-3" id="prodiField" style="display: none;">
                            <label for="program_studi" class="form-label">Program Studi</label>
                            <input class="form-control" type="text" id="prodi" name="prodi"
                                value="{{ $pengguna->prodi }}" aria-label="default input example">
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

            function toggleFields() {
                if (levelSelect.value === 'MHS') {
                    angkatanField.style.display = 'block';
                    prodiField.style.display = 'block';
                } else {
                    angkatanField.style.display = 'none';
                    prodiField.style.display = 'none';
                }
            }

            levelSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
@endsection