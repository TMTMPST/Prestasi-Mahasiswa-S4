@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>Edit Data Pengguna</strong>
            </div>
            <form action="{{ route('admin.pengguna.update', $pengguna->nim ?? ($pengguna->nip ?? $pengguna->username)) }}"
                method="POST" class="p-4">
                {{-- <form action="/manajemen-user/update/{{ $pengguna->nim ?? $pengguna->nip ?? $pengguna->username }}" method="POST" class="p-4"> --}}
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
                <!-- Angkatan (Hidden by Default) -->
                <div class="mb-3" id="angkatanField" style="display: none;">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input class="form-control" type="number" id="angkatan" name="angkatan"
                        value="{{ $pengguna->angkatan }}" aria-label="default input example">
                </div>

                <!-- Program Studi (Hidden by Default) -->
                <div class="mb-3" id="prodiField" style="display: none;">
                    <label for="program_studi" class="form-label">Program Studi</label>
                    <input class="form-control" type="text" id="prodi" name="prodi"
                        value="{{ $pengguna->prodi }}" aria-label="default input example">
                </div>

                <a href="/manajemen-user" class="btn btn-secondary">Kembali</a>
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
            toggleFields(); // Initial call to set the correct state
        });
    </script>
@endsection
