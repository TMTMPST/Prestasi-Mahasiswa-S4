@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" >
        <div class="card-header">
            <strong>Tambah Data Prestasi</strong>
        </div>
        <form action="{{ route('mahasiswa.store_prestasi') }}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            <div class="mb-3">
                <label for="peringkat" class="form-label">Peringkat</label>
                <select class="form-select" name="peringkat" id="peringkat" aria-label="Default select example">
                    <option selected>Masukkan Peringkat</option>
                    @foreach($prestasi as $rank)
                        <option value="{{ $rank->peringkat }}">{{ $rank->peringkat }}</option>
                    @endforeach
                </select>
            </div>

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
                <label for="exampleFormControlInput1" class="form-label">Sertifikat</label>
                <input class="form-control" type="file" id="sertif" name="sertif" id="sertif">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto Bukti</label>
                <input class="form-control" type="file" id="foto_bukti" name="foto_bukti" id="foto_bukti">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Poster Lomba</label>
                <input class="form-control" type="file" id="poster_lomba" name="poster_lomba" id="poster_lomba">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection