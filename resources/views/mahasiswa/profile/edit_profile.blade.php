@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Edit Profil Mahasiswa</strong>
        </div>
        <form method="POST" action="{{ route('mahasiswa.profile.update', $mahasiswa->nim) }}" class="p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input class="form-control" type="text" id="nim" name="nim" value="{{ $mahasiswa->nim }}"  readonly>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input class="form-control" type="text" id="nama" name="nama" value="{{ $mahasiswa->nama }}" readonly>
            </div>

            <div class="mb-3">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input class="form-control" type="number" id="angkatan" name="angkatan" value="{{ $mahasiswa->angkatan }}" readonly>
            </div>

            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <input class="form-control" type="text" id="prodi" name="prodi" value="{{ $mahasiswa->prodi }}" readonly>
            </div>

            <div class="mb-3">
                <label for="poin_presma" class="form-label">Poin Prestasi Mahasiswa</label>
                <input class="form-control" type="number" id="poin_presma" name="poin_presma" value="{{ $mahasiswa->poin_presma }}" readonly>
            </div>

            <div class="mb-3">
                <label for="prestasi_tertinggi" class="form-label">Prestasi Tertinggi</label>
                <input class="form-control" type="text" id="prestasi_tertinggi" name="prestasi_tertinggi" value="{{ $mahasiswa->prestasi_tertinggi }}" readonly>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{ $mahasiswa->email }}" required>
            </div>

            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <input class="form-control" type="text" id="level" name="level" value="{{ $mahasiswa->level }}" readonly>
            </div>

           <div class="mb-3">
                <label for="keahlian" class="form-label">Keahlian (Pilih Salah Satu Jenis Lomba)</label>
                <select class="form-select" name="keahlian" id="keahlian">
                    <option value="" disabled selected>-- Pilih Keahlian --</option>
                    @foreach($jenis_lomba as $item)
                        <option value="{{ $item->id_jenis }}"
                            {{ $mahasiswa->keahlian->pluck('id_jenis')->contains($item->id_jenis) ? 'selected' : '' }}>
                            {{ $item->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection