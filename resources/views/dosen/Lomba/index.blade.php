@extends('layouts.app')

@section('content')
<style>
    .custom-header {
        background: #953c37;
        color: #fff;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .custom-card {
        border: none;
        border-radius: 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .custom-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 8px 24px #2c3e5026;
    }
    .custom-btn-primary {
        background: #953c37;
        border: none;
    }
    .custom-btn-primary:hover {
        background: #2c3e50;
    }
    .custom-btn-success {
        background: #2c3e50;
        border: none;
    }
    .custom-btn-success:hover {
        background: #953c37;
    }
    .custom-title {
        color: #2c3e50;
        font-weight: bold;
        letter-spacing: 1px;
    }
</style>
<div class="container py-4">
    <h4 class="mb-4 custom-title">Informasi Lomba</h4>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($lombas as $lomba)
            <div class="col">
                <div class="card shadow-sm h-100 custom-card">
                    <div class="card-header custom-header">
                        {{ $lomba->nama_lomba }}
                    </div>
                    <div class="card-body" style="font-size: 1rem;">
                        <p><strong>Tingkat:</strong> {{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}</p>
                        <p><strong>Kategori:</strong> {{ $lomba->kategoriRelasi->nama_kategori ?? '-' }}</p>
                        <p><strong>Jenis:</strong> {{ $lomba->jenisRelasi->nama_jenis ?? '-' }}</p>
                        <p><strong>Penyelenggara:</strong> {{ $lomba->penyelenggara }}</p>
                        <p><strong>Mulai:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal_mulai)->format('d M Y') }}</p>
                        <p><strong>Selesai:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal_selesai)->format('d M Y') }}</p>

                        <div class="mt-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="btn custom-btn-primary btn-sm text-white">Detail</a>
                                        <a href="https://docs.google.com/forms/d/19H28i0qObFYdjkMxXbRN_eOjimVQlGO1L6rKW6-sqXc/edit" target="_blank" class="btn custom-btn-success btn-sm text-white">Daftar</a>
                                    </div>
                                </div>
                            </div>
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

