@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Profil Dosen</strong>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>NIP</th>
                    <td>{{ $dosen->nip }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $dosen->nama }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $dosen->email }}</td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>{{ $dosen->level }}</td>
                </tr>
                <tr>
                    <th>Bidang Minat</th>
                    <td>{{ $dosen->bidangMinat }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <strong>Daftar Prestasi Mahasiswa</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Prestasi</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Data belum tersedia</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection