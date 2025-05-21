@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/bimbingan/tambah_bimbingan" class="btn btn-success mb-3">Tambah Bimbingan</a>
    <br>
    <div class="card">
        <div class="card-header">
            <strong>Data Bimbingan</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lomba</th>
                        <th>Nama Anggota</th>
                        <th>Nama Dosen Pembimbing</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="text-center">Data belum tersedia</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection