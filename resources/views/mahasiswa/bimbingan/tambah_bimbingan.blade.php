@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" >
        <div class="card-header">
            <strong>Tambah Bimbingan</strong>
        </div>
        <form action="" class="p-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Lomba</label>
                <input class="form-control" type="text" placeholder="Default input" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="nama_lomba" class="form-label">Nama Anggota</label>
                <input class="form-control" type="text" placeholder="Default input" aria-label="default input example">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Dosen Pembimbing</label>
                <input class="form-control" type="text" placeholder="Default input" aria-label="default input example">
            </div>
            <a href="#" class="btn btn-success">Simpan</a>
        </form>
    </div>
</div>
@endsection