@extends('layouts.app')

@section('content')
    <style>
        :root {
            --primary: #0c1e47;
            --secondary: #f7b71d;
            --accent2: #f9a11b;
            --accent3: #e6e6e6;
            --gray: #6c757d;
            --light: #ffffff;
            --dark: #212529;
            --light-gray: #f8f9fa;
        }

        body {
            background: var(--accent3);
        }

        .custom-header {
            background: var(--primary);
            color: var(--light);
            font-weight: bold;
            letter-spacing: 1px;
            border-radius: 18px 18px 0 0;
            text-align: center;
            font-size: 1.2rem;
        }

        .custom-card {
            border: none;
            border-radius: 18px;
            background: var(--light);
            box-shadow: 0 2px 12px rgba(12, 30, 71, 0.08);
            border-top: 4px solid var(--gray);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .custom-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(12, 30, 71, 0.13);
        }

        .custom-btn-primary {
            background: var(--secondary);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }

        .custom-btn-primary:hover,
        .custom-btn-primary:focus {
            background: var(--primary);
            color: var(--light);
        }

        .custom-btn-success {
            background: var(--primary);
            color: var(--light);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }

        .custom-btn-success:hover,
        .custom-btn-success:focus {
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

        /* Tata letak baru */
        .lomba-info-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1rem 0;
        }

        .lomba-info-list li {
            display: flex;
            align-items: center;
            margin-bottom: 0.4rem;
        }

        .lomba-info-list strong {
            min-width: 110px;
            display: inline-block;
        }

        .lomba-action-group {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .custom-card .card-body {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @media (max-width: 767.98px) {
            .row-cols-md-3>.col {
                margin-bottom: 1.5rem;
            }
        }
    </style>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h4 class="custom-title mb-0">Informasi Lomba</h4>
            <button type="button" class="btn custom-btn-primary text-white" data-coreui-toggle="modal"
                data-coreui-target="#modalTambahLomba">
                + Tambah Lomba
            </button>
        </div>
<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse ($lombas as $lomba)
        @if ($lomba->verifikasi == 'Accepted')
            <div class="col d-flex">
                <div class="card shadow-sm custom-card w-100">
                    <div class="card-header custom-header">
                        {{ $lomba->nama_lomba }}
                    </div>
                    <div class="card-body">
                        <ul class="lomba-info-list">
                            <li>
                                <strong>Tingkat</strong>
                                <span class="ms-2">: {{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}</span>
                            </li>
                            <li>
                                <strong>Jenis</strong>
                                <span class="ms-2">: {{ $lomba->jenisRelasi->nama_jenis ?? '-' }}</span>
                            </li>
                        </ul>
                        <div class="card border-0 bg-light mt-auto">
                            <div class="card-body p-2">
                                <div class="lomba-action-group">
                                    <button type="button"
                                        class="btn custom-btn-primary btn-sm w-50 btn-detail-lomba"
                                        data-id="{{ $lomba->id_lomba }}" data-bs-toggle="modal"
                                        data-bs-target="#modalDetailLomba">
                                        Detail
                                    </button>
                                    <a href="{{ $lomba->link_lomba }}" target="_blank"
                                        class="btn custom-btn-success btn-sm w-50">Daftar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="col">
            <div class="alert alert-warning w-100" role="alert">
                Tidak ada informasi lomba tersedia.
            </div>
        </div>
    @endforelse
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
        <!-- Modal Detail Lomba -->
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalTambahLomba = document.getElementById('modalTambahLomba');
            if (modalTambahLomba) {
                modalTambahLomba.addEventListener('show.coreui.modal', function() {
                    fetch("{{ route('lomba.create') }}")
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('modalTambahLombaContent').innerHTML = html;
                        })
                        .catch(error => {
                            document.getElementById('modalTambahLombaContent').innerHTML =
                                '<div class="alert alert-danger">Gagal memuat form.</div>';
                            console.error(error);
                        });
                });
            }

            // Attach event listeners after DOM is ready
            function attachDetailListeners() {
                document.querySelectorAll('.btn-detail-lomba').forEach(btn => {
                    btn.removeEventListener('click', btn._detailHandler || (() => {}));
                    btn._detailHandler = function() {
                        const id = this.getAttribute('data-id');
                        const modalContent = document.getElementById('modalDetailLombaContent');
                        modalContent.innerHTML =
                            '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';
                        fetch(`/Lomba/${id}/detail`)
                            .then(res => res.text())
                            .then(html => {
                                modalContent.innerHTML = html;
                            })
                            .catch(() => {
                                modalContent.innerHTML =
                                    '<div class="alert alert-danger">Gagal memuat detail lomba.</div>';
                            });
                    };
                    btn.addEventListener('click', btn._detailHandler);
                });
            }

            attachDetailListeners();
        });
    </script>
@endsection
