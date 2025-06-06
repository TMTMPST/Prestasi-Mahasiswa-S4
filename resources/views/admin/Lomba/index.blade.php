@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/manajemen-lomba/create" class="btn btn-success mb-3">Tambah Lomba</a>
        <br>
        <div class="card">
            <div class="card-header">
                <strong>Data Lomba</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Lomba</th>
                            <th>Tingkat</th>
                            <th>Jenis</th>
                            <th>Tingkat Penyelenggara</th>
                            <th>Penyelenggara</th>
                            <th>Alamat</th>
                            <th>Link</th>
                            <th>Biaya Pendaftaran</th>
                            <th>Hadiah</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lombas as $lomba)
                            <tr>
                                <td>{{ $lomba->nama_lomba }}</td>
                                <td>{{ $lomba->tingkatRelasi->nama_tingkat }}</td>
                                <td>{{ $lomba->jenisRelasi->nama_jenis }}</td>
                                <td>{{ $lomba->tingkat_penyelenggara }}</td>
                                <td>{{ $lomba->penyelenggara }}</td>
                                <td>{{ $lomba->alamat }}</td>
                                <td><a href="{{ $lomba->link_lomba }}">Klik</a></td>
                                <td>{{ $lomba->biaya == 0 ? 'Gratis' : "Rp".$lomba->biaya }}</td>
                                <td>{{ $lomba->hadiah }}</td>
                                <td>{{ $lomba->tgl_dibuka }}</td>
                                <td>{{ $lomba->tgl_ditutup }}</td>
                                <td>
                                    <a href="/manajemen-lomba/edit/{{ $lomba->id_lomba }}" class="btn btn-primary">Edit</a>
                                    <form action="/manajemen-lomba/delete/{{ $lomba->id_lomba }}" method="POST" style="display:inline;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus lomba ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
