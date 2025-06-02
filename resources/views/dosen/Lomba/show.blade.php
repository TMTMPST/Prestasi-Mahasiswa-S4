@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Lomba</h2>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $lomba->nama_lomba }}</h4>
            <p><strong>Penyelenggara:</strong> {{ $lomba->penyelenggara }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ $lomba->tanggal_mulai }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ $lomba->tanggal_selesai }}</p>
            <p><strong>Deskripsi:</strong> {{ $lomba->deskripsi }}</p>
            <p><strong>Lokasi:</strong> {{ $lomba->lokasi }}</p>
            <a href="{{ route('dosen.lomba.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection