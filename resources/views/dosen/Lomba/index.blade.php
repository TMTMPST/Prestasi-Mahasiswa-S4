@extends('dosen.layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Informasi Lomba</h4>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($lombas as $lomba)
            <div class="col">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        {{ $lomba->nama_lomba }}
                    </div>
                    <div class="card-body" style="font-size: 1rem;">
                        <p><strong>Tingkat:</strong> {{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}</p>
                        <p><strong>Kategori:</strong> {{ $lomba->kategoriRelasi->nama_kategori ?? '-' }}</p>
                        <p><strong>Jenis:</strong> {{ $lomba->jenisRelasi->nama_jenis ?? '-' }}</p>
                        <p><strong>Penyelenggara:</strong> {{ $lomba->penyelenggara }}</p>
                        <p><strong>Mulai:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal_mulai)->format('d M Y') }}</p>
                        <p><strong>Selesai:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal_selesai)->format('d M Y') }}</p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="#" class="btn btn-primary btn-sm">Detail</a>
                            <a href="https://docs.google.com/forms/d/19H28i0qObFYdjkMxXbRN_eOjimVQlGO1L6rKW6-sqXc/edit" target="_blank" class="btn btn-success btn-sm">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-warning w-100" role="alert">
                    Tidak ada informasi lomba tersedia.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
