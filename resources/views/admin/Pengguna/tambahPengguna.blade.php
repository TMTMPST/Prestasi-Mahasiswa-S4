@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Data Pengguna</strong>
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
                <!-- Angkatan (Hidden by Default) -->
                <div class="mb-3" id="angkatanField" style="display: none;">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input class="form-control" type="number" id="angkatan" name="angkatan"
                        placeholder="Masukkan Angkatan" aria-label="default input example">
                </div>

                <!-- Program Studi (Hidden by Default) -->
                <div class="mb-3" id="prodiField" style="display: none;">
                    <label for="program_studi" class="form-label">Program Studi</label>
                    <input class="form-control" type="text" id="prodi" name="prodi"
                        placeholder="Masukkan Program Studi" aria-label="default input example">
                </div>

                <!-- Back Button -->
                <a href="/manajemen-user" class="btn btn-secondary">Kembali</a>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">Simpan</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const levelSelect = document.getElementById('level');
            const angkatanField = document.getElementById('angkatanField');
            const prodiField = document.getElementById('prodiField');

            // Event listener untuk menangani perubahan pada select
            levelSelect.addEventListener('change', function() {
                const selectedLevel = levelSelect.value;

                // Show or hide fields based on selected level
                if (selectedLevel === 'MHS') {
                    angkatanField.style.display = 'block'; // Menampilkan input Angkatan
                    prodiField.style.display = 'block'; // Menampilkan input Program Studi
                } else {
                    angkatanField.style.display = 'none'; // Menyembunyikan input Angkatan
                    prodiField.style.display = 'none'; // Menyembunyikan input Program Studi
                }
            });
        });
    </script>
@endsection
