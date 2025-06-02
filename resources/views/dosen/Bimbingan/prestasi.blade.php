@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <strong>Detail Prestasi - {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</strong>
        </div>
        <div class="card-body">
            <a href="{{ route('dosen.bimbingan') }}" class="btn btn-secondary btn-sm mb-3">← Kembali ke Daftar Bimbingan</a>

            @if($mahasiswa->prestasis->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Prestasi</th>
                        <th>Tingkat</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa->prestasis as $index => $prestasi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $prestasi->nama_lomba }}</td>
                        <td>{{ $prestasi->tingkatRelasi->nama_tingkat ?? '-' }}</td>
                        <td>{{ $prestasi->kategoriRelasi->nama_kategori ?? '-' }}</td>
                        <td>{{ $prestasi->jenisRelasi->nama_jenis ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($prestasi->tanggal_mulai)->format('Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info">Belum ada data prestasi.</div>
            @endif
        </div>
    </div>
</div>
@endsection
