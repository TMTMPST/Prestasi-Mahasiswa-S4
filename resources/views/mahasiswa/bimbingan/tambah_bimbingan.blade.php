@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Tambah Bimbingan</strong>
        </div>
        <form action="{{ route('mahasiswa.store_bimbingan') }}" method="POST" class="p-4">
            @csrf
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
                <label for="nama_anggota" class="form-label">Nama Anggota</label>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama anggota" required>
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">Nama Dosen Pembimbing</label>
                <select id="nip" name="nip" class="form-select" required>
                    <option value="">Pilih Dosen</option>
                    @foreach ($dosen as $dsn)
                        <option value="{{ $dsn->nip }}">{{ $dsn->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
