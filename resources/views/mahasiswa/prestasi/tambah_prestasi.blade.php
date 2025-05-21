@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" >
        <div class="card-header">
            <strong>Tambah Data Prestasi</strong>
        </div>
        <form action="" class="p-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Peringkat</label>
                <input class="form-control" type="text" placeholder="Default input" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="nama_lomba" class="form-label">Nama Lomba</label>
                <input class="form-control" type="text" placeholder="Default input" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Sertifikat</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto Bukti</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Poster Lomba</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <a href="#" class="btn btn-success">Simpan</a>
        </form>
    </div>
</div>
@endsection