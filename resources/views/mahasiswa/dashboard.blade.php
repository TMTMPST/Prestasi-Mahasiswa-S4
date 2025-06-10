@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    :root {
        --primary: #0c1e47;
        --secondary: #f7b71d;
        --accent1: #f26430;
        --accent2: #f9a11b;
        --accent3: #e6e6e6;
        --light: #ffffff;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #f8f9fa;
    }
    body { background: var(--accent3); }
    .bg-maroon { background-color: var(--primary) !important; }
    .bg-navy { background-color: var(--secondary) !important; }
    .text-maroon { color: var(--primary) !important; }
    .text-navy { color: var(--secondary) !important; }
    .dashboard-card {
        border-left: 6px solid var(--secondary);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(12, 30, 71, 0.07);
        background: var(--light);
    }
    .lomba-card {
        border-top: 4px solid var(--accent1);
        border-radius: 18px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 12px rgba(12, 30, 71, 0.08);
        position: relative;
        overflow: hidden;
        background: var(--light);
    }
    .lomba-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    .lomba-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(12, 30, 71, 0.15);
        border-top-color: var(--secondary);
    }
    .lomba-card:hover::before {
        left: 100%;
    }
    .lomba-card:hover .card-header {
        background: linear-gradient(135deg, var(--accent1), var(--secondary)) !important;
    }
    .lomba-card .card-header {
        background: linear-gradient(90deg, var(--primary) 100%);
        color: var(--light);
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 18px 18px 0 0;
        letter-spacing: 0.5px;
        padding: 0.75rem 1.25rem;
    }
    .lomba-card .card-body {
        font-size: 0.97rem;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex: 1 1 auto;
    }
    .lomba-card .info-row {
        margin-bottom: 0.5rem;
    }
    .lomba-card .info-label {
        font-weight: 500;
        color: var(--primary);
        min-width: 90px;
        display: inline-block;
    }
    .btn-detail {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--light);
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.2s;
        min-width: 90px;
    }
    .btn-detail:hover,
    .btn-detail:focus {
        background: var(--primary);
        color: var(--light);
        border-color: var(--primary);
    }
    .btn-daftar {
        background: var(--secondary);
        color: var(--primary);
        font-weight: 500;
        border-radius: 8px;
        border: none;
        transition: all 0.2s;
        min-width: 90px;
    }
    .btn-daftar:hover,
    .btn-daftar:focus {
        background: var(--primary);
        color: var(--light);
    }
    .ranking-header {
        background: linear-gradient(90deg, var(--primary) 100%);
        color: var(--light);
        border-radius: 18px 18px 0 0;
    }
    .card-header {
        font-weight: 600;
        font-size: 1.1rem;
        border-radius: 18px 18px 0 0;
        letter-spacing: 0.5px;
    }
    .table thead th {
        background-color: var(--primary);
        color: var(--light);
        font-size: 1rem;
        letter-spacing: 0.5px;
    }
    .badge.bg-primary {
        background-color: var(--secondary) !important;
        color: var(--primary) !important;
        font-weight: 500;
        border-radius: 8px;
        padding: 0.5em 1em;
    }
    .avatar-initial {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: var(--primary);
        color: var(--light);
        text-align: center;
        line-height: 30px;
        font-size: 1.2rem;
        margin-right: 6px;
    }
    .table tbody tr {
        transition: background 0.15s;
    }
    .table tbody tr:hover {
        background: var(--light-gray);
    }
    .d-flex.flex-nowrap.overflow-auto::-webkit-scrollbar,
    .table-responsive::-webkit-scrollbar {
        display: none;
    }
    .d-flex.flex-nowrap.overflow-auto,
    .table-responsive {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    /* Slider style */
    .slide-container {
        position: relative;
    }
    .slide-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background: var(--primary);
        border: none;
        border-radius: 50%;
        color: var(--light);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(12, 30, 71, 0.3);
    }
    .slide-nav:hover {
        background: var(--secondary);
        color: var(--primary);
        transform: translateY(-50%) scale(1.1);
    }
    .slide-nav.prev { left: -20px; }
    .slide-nav.next { right: -20px; }
    .slide-nav:disabled {
        opacity: 0.3;
        cursor: not-allowed;
        transform: translateY(-50%) scale(0.9);
    }
    .slide-nav:disabled:hover {
        background: var(--gray);
        transform: translateY(-50%) scale(0.9);
    }
    .slide-indicators {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 20px;
    }
    .slide-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--gray);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .slide-dot.active {
        background: var(--secondary);
        transform: scale(1.2);
    }
    .slide-scroll {
        scroll-behavior: smooth;
    }
</style>
<div class="container py-4">
    {{-- Card besar di bawah --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header bg-maroon text-white d-flex align-items-center" style="font-size:1.2rem;">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-center align-items-center fs-5 text-maroon fw-semibold">
                        <i class="bi bi-person-badge me-2"></i>Anda login sebagai <span class="ms-1 text-navy">Mahasiswa</span>!
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Rekomendasi Lomba --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header bg-maroon text-white d-flex align-items-center">
                    <i class="bi bi-trophy me-2"></i>Rekomendasi Lomba (filtered by Profil)
                </div>
                <div class="card-body">
                    <div class="slide-container position-relative">
                        <button class="slide-nav prev" id="prevBtn" onclick="slideLeft()" aria-label="Sebelumnya">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="slide-nav next" id="nextBtn" onclick="slideRight()" aria-label="Berikutnya">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        <div class="d-flex flex-nowrap overflow-auto slide-scroll" id="lombaSlider"
                            style="gap: 1.5rem; padding-bottom: 8px;">
                            @forelse ($lombas->take(4) as $lomba)
                                <div class="flex-shrink-0" style="min-width: 350px; max-width: 400px;">
                                    <div class="card lomba-card border-0 h-100 mb-0 d-flex flex-column">
                                        <div class="card-header bg-navy text-white text-truncate">
                                            <i class="bi bi-award me-2"></i>{{ $lomba->nama_lomba }}
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-between"
                                            style="font-size: 0.97rem; flex: 1 1 auto;">
                                            <div class="mb-3">
                                                <div class="row mb-2">
                                                    <div class="col-4 fw-semibold text-maroon">Tingkat</div>
                                                    <div class="col-8">: {{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 fw-semibold text-maroon">Jenis</div>
                                                    <div class="col-8">: {{ $lomba->jenisRelasi->nama_jenis ?? '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-end gap-2"
                                                style="min-height: 38px;">
                                                <button type="button"
                                                    class="btn btn-detail btn-sm w-50 btn-detail-lomba"
                                                    data-id="{{ $lomba->id_lomba }}" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailLomba">
                                                    <i class="bi bi-info-circle me-1"></i> Detail
                                                </button>
                                                <a href="{{ $lomba->link_lomba ?? '#' }}" target="_blank" class="btn btn-daftar btn-sm w-50">
                                                    <i class="bi bi-pencil-square"></i> Daftar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="flex-shrink-0" style="min-width: 350px;">
                                    <div class="alert alert-warning mb-0 w-100 text-center">
                                        <i class="bi bi-exclamation-triangle me-2"></i>Tidak ada informasi lomba tersedia.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @if ($lombas->count() > 3)
                        <div class="slide-indicators mt-3">
                            @for ($i = 0; $i < ceil($lombas->count() / 3); $i++)
                                <div class="slide-dot{{ $i == 0 ? ' active' : '' }}"
                                    onclick="slideTo({{ $i }})"></div>
                            @endfor
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Ranking Mahasiswa --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header ranking-header d-flex align-items-center">
                    <i class="bi bi-list-ol me-2"></i>Ranking Mahasiswa
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Program Studi</th>
                                    <th>Prestasi Tertinggi</th>
                                    <th>Poin Presma</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswa as $index => $mhs)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="avatar-initial">
                                                <i class="bi bi-person-fill"></i>
                                            </span>
                                            {{ $mhs->nama }}
                                        </td>
                                        <td>{{ $mhs->nim }}</td>
                                        <td>{{ $mhs->prodi }}</td>
                                        <td>{{ $mhs->prestasi_tertinggi }}</td>
                                        <td>
                                            <span class="badge bg-primary fs-6">
                                                <i class="bi bi-star-fill me-1"></i>{{ $mhs->poin_presma }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data mahasiswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetailLomba" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header w-100 d-flex justify-content-center">
                <h5 class="modal-title text-center w-100">Detail Lomba</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDetailLombaContent">
                <!-- Konten detail lomba akan dimuat lewat AJAX -->
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let currentSlide = 0;
    const slideWidth = 370;
    const maxSlides = Math.max(0, {{ $lombas->count() }} - 3);

    function updateSlideButtons() {
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        if (prevBtn && nextBtn) {
            prevBtn.disabled = currentSlide <= 0;
            nextBtn.disabled = currentSlide >= maxSlides;
        }
        document.querySelectorAll('.slide-dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === Math.floor(currentSlide / 3));
        });
    }

    function slideLeft() {
        if (currentSlide > 0) {
            currentSlide--;
            const slider = document.getElementById('lombaSlider');
            if (slider) {
                slider.scrollTo({
                    left: currentSlide * slideWidth,
                    behavior: 'smooth'
                });
            }
            updateSlideButtons();
        }
    }

    function slideRight() {
        if (currentSlide < maxSlides) {
            currentSlide++;
            const slider = document.getElementById('lombaSlider');
            if (slider) {
                slider.scrollTo({
                    left: currentSlide * slideWidth,
                    behavior: 'smooth'
                });
            }
            updateSlideButtons();
        }
    }

    function slideTo(index) {
        currentSlide = index * 3;
        currentSlide = Math.min(currentSlide, maxSlides);
        const slider = document.getElementById('lombaSlider');
        if (slider) {
            slider.scrollTo({
                left: currentSlide * slideWidth,
                behavior: 'smooth'
            });
        }
        updateSlideButtons();
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSlideButtons();
        if ({{ $lombas->count() }} <= 3) {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            if (prevBtn && nextBtn) {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
            }
        }
        // Touch/swipe support
        let startX = 0;
        let scrollLeft = 0;
        const slider = document.getElementById('lombaSlider');
        if (slider) {
            slider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });
            slider.addEventListener('touchmove', (e) => {
                if (!startX) return;
                const x = e.touches[0].pageX - slider.offsetLeft;
                const walk = (x - startX) * 2;
                slider.scrollLeft = scrollLeft - walk;
            });
            slider.addEventListener('touchend', () => {
                startX = 0;
            });
        }
        // Modal detail lomba AJAX
        document.querySelectorAll('.btn-detail-lomba').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const modalContent = document.getElementById('modalDetailLombaContent');
                modalContent.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';
                fetch(`/dashboard/lomba/${id}/detail`)
                    .then(res => res.text())
                    .then(html => {
                        modalContent.innerHTML = html;
                    })
                    .catch(() => {
                        modalContent.innerHTML = '<div class="alert alert-danger">Gagal memuat detail lomba.</div>';
                    });
            });
        });
    });
</script>
@endsection