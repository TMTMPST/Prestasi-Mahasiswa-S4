@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #0c1e47;         /* Biru tua utama (bg utama welcome) */
        --secondary: #f7b71d;       /* Kuning emas (aksen utama welcome) */
        --gray: #f26430;         /* Oranye (aksen tombol/ikon) */
        --accent2: #f9a11b;         /* Oranye muda */
        --accent3: #e6e6e6;         /* Abu terang (background) */
        --light: #ffffff;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #f8f9fa;
    }
    body { background: var(--accent3); }
    .custom-header {
        background: var(--primary);
        color: var(--light);
        font-weight: bold;
        letter-spacing: 1px;
        border-radius: 18px 18px 0 0;
    }
    .custom-card {
        border: none;
        border-radius: 18px;
        transition: transform 0.2s, box-shadow 0.2s;
        background: var(--light);
        box-shadow: 0 2px 12px rgba(12,30,71,0.08);
        border-top: 4px solid var(--gray);
    }
    .custom-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(12,30,71,0.13);
    }
    .custom-btn-primary {
        background: var(--secondary);
        border: none;
        color: var(--primary);
        border-radius: 8px;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
    }
    .custom-btn-primary:hover, .custom-btn-primary:focus {
        background: var(--primary);
        color: var(--light);
    }
    .custom-btn-success {
        background: var(--primary);
        border: none;
        color: var(--light);
        border-radius: 8px;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
    }
    .custom-btn-success:hover, .custom-btn-success:focus {
        background: var(--gray);
        color: var(--light);
    }
    .custom-title {
        color: var(--primary);
        font-weight: bold;
        letter-spacing: 1px;
    }
    .card.border-0.bg-light {
        background: var(--light-gray) !important;
        border-radius: 12px;
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
</button>    
</div>

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
                                    <div class="d-flex justify-content-center">
                                        <a href="https://docs.google.com/forms/d/19H28i0qObFYdjkMxXbRN_eOjimVQlGO1L6rKW6-sqXc/edit" target="_blank" class="btn custom-btn-success btn-sm w-100">Daftar</a>
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