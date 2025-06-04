@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Edit Profile</strong>
        </div>
        <form method="POST" class="p-4">
            @csrf
            <div class="mb-3">
                <label for="nama_anggota" class="form-label">Nama</label>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama anggota" required>
            </div>

            <div class="mb-3">
                <label for="nama_anggota" class="form-label">Angkatan</label>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama anggota" required>
            </div>

            <div class="mb-3">
                <label for="nama_anggota" class="form-label">Prodi</label>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama anggota" required>
            </div>

            <div class="mb-3">
                <label for="nama_anggota" class="form-label">Poin Presma</label>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama anggota" required>
            </div>

            <div class="mb-3">
                <label for="nama_anggota" class="form-label">Prestasi Tertinggi</label>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama anggota" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
