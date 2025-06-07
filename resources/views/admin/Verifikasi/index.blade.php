@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="card">
            <div class="card-header">
                <strong>Verifikasi Prestasi </strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Lomba</th>
                            <th>Sertifikat</th>
                            <th>Foto Bukti</th>
                            <th>Foto Poster</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($verifikasis as $verifikasi)
                            <tr>
                                <td>{{ $verifikasi->peringkat }}</td>
                                <td>{{ $verifikasi->dataLomba->nama_lomba }}</td>
                                <td>{{ $verifikasi->sertif }}</td>
                                <td>{{ $verifikasi->foto_bukti }}</td>
                                <td>{{ $verifikasi->poster_lomba }}</td>
                                <td>{{ $verifikasi->verifikasi }}</td>
                                <td>
                                    <!-- Tombol Accept -->
                                    <form action="{{ route('admin.verifikasi.update', $verifikasi->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Accepted">
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>

                                    <!-- Tombol Reject -->
                                    <form action="{{ route('admin.verifikasi.update', $verifikasi->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
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
