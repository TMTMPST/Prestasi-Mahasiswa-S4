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
                    @forelse ($prestasi as $index => $pres)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pres->peringkat }}</td>
                            <td>{{ $pres->dataLomba->nama_lomba }}</td>
                            <td><img src="{{ asset('storage/' . $pres->sertif) }}" alt="Sertifikat" width="100"></td>
                            <td><img src="{{ asset('storage/' . $pres->foto_bukti) }}" alt="Foto Bukti" width="100"></td>
                            <td><img src="{{ asset('storage/' . $pres->poster_lomba) }}" alt="Poster Lomba" width="100"></td>
                            <td>
                                <form action="{{ route('mahasiswa.destroy', $pres->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                    </button>
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