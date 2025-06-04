@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" >
        <div class="card-header">
            <strong>Tambah Data Prestasi</strong>
        </div>
        <form action="{{ route('mahasiswa.update_prestasi', $prestasi->id) }}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="peringkat" class="form-label">Peringkat</label>
                <select class="form-select" name="peringkat" id="peringkat" required>
                    <option disabled value="">Masukkan Peringkat</option>
                    @foreach($prestasi as $rank)
                        <option value="{{ $rank }}" {{ old('peringkat', $prestasi->peringkat) == $rank ? 'selected' : '' }}>
                            {{ $rank }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_lomba" class="form-label">Nama Lomba</label>
                <select id="id_lomba" name="id_lomba" class="form-select" required>
                    <option value="">Pilih Lomba</option>
                    @foreach ($lombas as $lomba)
                        <option value="{{ $lomba->id_lomba }}" 
                            {{ old('id_lomba', $prestasi->id_lomba) == $lomba->id_lomba ? 'selected' : '' }}>
                            {{ $lomba->nama_lomba }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="sertif" class="form-label">Sertifikat</label>
                <input class="form-control" type="file" id="sertif" name="sertif">
                @if($prestasi->sertif)
                    <small class="text-muted">File lama: {{ basename($prestasi->sertif) }}</small>
                @endif
            </div>

            <div class="mb-3">
                <label for="foto_bukti" class="form-label">Foto Bukti</label>
                <input class="form-control" type="file" id="foto_bukti" name="foto_bukti">
                @if($prestasi->foto_bukti)
                    <small class="text-muted">File lama: {{ basename($prestasi->foto_bukti) }}</small>
                @endif
            </div>

            <div class="mb-3">
                <label for="poster_lomba" class="form-label">Poster Lomba</label>
                <input class="form-control" type="file" id="poster_lomba" name="poster_lomba">
                @if($prestasi->poster_lomba)
                    <small class="text-muted">File lama: {{ basename($prestasi->poster_lomba) }}</small>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>

    </div>
</div>
@endsection