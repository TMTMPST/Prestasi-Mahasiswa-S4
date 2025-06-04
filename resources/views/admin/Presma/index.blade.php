@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/manajemen-presma/create" class="btn btn-success mb-3">Tambah Prestasi</a>
        <br>
        <div class="card">
            <div class="card-header">
                <strong>Prestasi Mahasiswa</strong>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Peringkat</th>
                            <th>Nama Lomba</th>
                            <th style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Sertifikat</th>
                            <th style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Foto Bukti</th>
                            <th style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                Foto Poster</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presmas as $presma)
                            <tr>
                                <td>Mahasiswa</td>
                                <td>{{ $presma->peringkat }}</td>
                                <td>{{ $presma->dataLomba->nama_lomba }}</td>
                                <td
                                    style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $presma->sertif }}</td>
                                <td
                                    style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $presma->foto_bukti }}</td>
                                <td
                                    style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $presma->poster_lomba }}</td>
                                <td>{{ $presma->verifikasi }}</td>
                                <td>
                                    <a href="/manajemen-presma/edit/{{ $presma->id }}" class="btn btn-primary">Edit</a>
                                    <form action="/manajemen-presma/delete/{{ $presma->id }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data mahasiswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
