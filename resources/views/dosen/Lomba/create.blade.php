@extends('layouts.app')

@section('content')
<style>
    .custom-header {
        background: #ef4a24;
        color: #fff;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .custom-btn-primary {
        background: #ef4a24;
        border: none;
    }
    .custom-btn-primary:hover {
        background: #2c3e50;
    }
    .custom-title {
        color: #2c3e50;
        font-weight: bold;
        letter-spacing: 1px;
    }
</style>
<div class="container py-4">
    <h4 class="mb-4 custom-title">Tambah Lomba Baru</h4>
    <div class="card shadow-sm">
        <div class="card-header custom-header">
            Formulir Lomba
        </div>
        <div class="card-body">
            <form action="{{ route('lomba.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_lomba" class="form-label">Nama Lomba</label>
                    <input type="text" class="form-control" id="nama_lomba" name="nama_lomba" required>
                </div>
                <div class="mb-3">
                    <label for="tingkat_id" class="form-label">Tingkat</label>
                    <select class="form-select" id="tingkat_id" name="tingkat_id" required>
                        <option value="">Pilih Tingkat</option>
                        @foreach($tingkats as $tingkat)
                            <option value="{{ $tingkat->id }}">{{ $tingkat->nama_tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_id" class="form-label">Jenis</label>
                    <select class="form-select" id="jenis_id" name="jenis_id" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($jeniss as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="penyelenggara" class="form-label">Penyelenggara</label>
                    <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                </div>
                <button type="submit" class="btn custom-btn-primary text-white">Simpan</button>
                <a href="{{ route('lomba.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
