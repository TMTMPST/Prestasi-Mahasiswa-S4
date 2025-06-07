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
                            <th>Nama Pengaju</th>
                            <th>Nama Dosen Pembimbing</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bimbingan as $index => $bimb)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $bimb->lomba->nama_lomba }}</td>
                                <td>{{ $bimb->nama_pengaju }}</td>
                                
                                <td>{{ $bimb->dosen->nama }}</td>
                                <td>{{ $bimb->status }}</td>
                                <td>
                                    <form action="{{ route('mahasiswa.destroy_bimbingan', $bimb->id_bimbingan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>

                                    <a href="{{ route('mahasiswa.edit_bimbingan', $bimb->id_bimbingan) }}"
                                        class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
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
