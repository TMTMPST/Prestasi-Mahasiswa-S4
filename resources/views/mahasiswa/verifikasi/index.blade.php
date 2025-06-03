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
                        <th>No</th>
                        <th>Peringkat</th>
                        <th>Nama Lomba</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prestasi as $index => $pres)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pres->peringkat }}</td>
                            <td>{{ $pres->dataLomba->nama_lomba }}</td>
                            <td>{{ $pres->verifikasi }}</td>
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