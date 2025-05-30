@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Daftar Mahasiswa Bimbingan</strong>
        </div>
        <div class="card-body">
            @if ($mahasiswa->count())
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Prestasi Tertinggi</th>
                        <th>Poin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $index => $mhs)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->prestasi_tertinggi ?? '-' }}</td>
                        <td>{{ $mhs->poin_presma }}</td>
                        <td>
                            <a href="{{ route('dosen.bimbingan.prestasi', $mhs->nim) }}" class="btn btn-primary btn-sm">Prestasi</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning">Belum ada mahasiswa bimbingan.</div>
            @endif
        </div>
    </div>
</div>
@endsection
