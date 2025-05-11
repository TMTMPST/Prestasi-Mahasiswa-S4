
@extends('dosen.layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Informasi Lomba</h4>

    <div class="row">
        @foreach ($lombas as $lomba)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $lomba->nama_lomba }}</h5>
                        <p class="card-text">
                            <strong>Penyelenggara:</strong> {{ $lomba->penyelenggara }}<br>
                            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal)->format('d M Y') }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dosen.lomba.show', $lomba->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            <a href="{{ route('dosen.lomba.daftar', $lomba->id) }}" class="btn btn-success btn-sm">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
