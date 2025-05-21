@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/prestasi/tambah_prestasi" class="btn btn-success mb-3">Tambah Prestasi</a>
    <br>
    <div class="card">
        <div class="card-header">
            <strong>Data Prestasi </strong>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peringkat</th>
                        <th>Nama Lomba</th>
                        <th>Sertifikat</th>
                        <th>Foto Bukti</th>
                        <th>Poster Lomba</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center">Data belum tersedia</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection