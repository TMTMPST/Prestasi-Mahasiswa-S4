@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #9a3324;
        --secondary: #0c1e47;
        --accent1: #f26430;
        --accent2: #f7b71d;
        --accent3: #f9a11b;
        --light: #ffffff;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #f8f9fa;
    }
    .custom-header {
        background: var(--primary);
        color: var(--light);
        font-weight: bold;
        letter-spacing: 1px;
    }
    .custom-card {
        border: none;
        border-radius: 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
        background: var(--light);
    }
    .custom-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 8px 24px var(--secondary)26;
    }
    .custom-btn-primary {
        background: var(--primary);
        border: none;
        color: var(--light);
    }
    .custom-btn-primary:hover {
        background: var(--secondary);
        color: var(--light);
    }
    .custom-btn-success {
        background: var(--secondary);
        border: none;
        color: var(--light);
    }
    .custom-btn-success:hover {
        background: var(--accent1);
        color: var(--light);
    }
    .custom-title {
        color: var(--secondary);
        font-weight: bold;
        letter-spacing: 1px;
    }
    .card.border-0.bg-light {
        background: var(--light-gray) !important;
    }
    .alert-warning {
        background: var(--accent2);
        color: var(--dark);
        border: none;
    }
    .spinner-border.text-primary {
        color: var(--primary) !important;
    }
</style>
<div class="container py-4">
    <h4 class="mb-4 custom-title">Informasi Lomba</h4>
    <div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn custom-btn-primary text-white" data-coreui-toggle="modal" data-coreui-target="#modalTambahLomba">
    + Tambah Lomba
</button>    </div>

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
<!-- Modal Tambah Lomba -->
<div class="modal fade" id="modalTambahLomba" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body" id="modalTambahLombaContent">
        <!-- Konten form akan dimuat lewat AJAX -->
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalTambahLomba');

    modal.addEventListener('show.coreui.modal', function () {
        // Load form create via AJAX
        fetch("{{ route('lomba.create') }}")
            .then(response => response.text())
            .then(html => {
                document.getElementById('modalTambahLombaContent').innerHTML = html;
            })
            .catch(error => {
                document.getElementById('modalTambahLombaContent').innerHTML = '<div class="alert alert-danger">Gagal memuat form.</div>';
                console.error(error);
            });
    });
});
</script>

@endsection
