@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #0c1e47;
            /* Biru tua utama (bg utama welcome) */
            --secondary: #f7b71d;
            /* Kuning emas (aksen utama welcome) */
            --accent1: #f26430;
            /* Oranye (aksen tombol/ikon) */
            --accent2: #f9a11b;
            /* Oranye muda */
            --accent3: #e6e6e6;
            /* Abu terang (background) */
            --light: #ffffff;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #f8f9fa;
        }

        body {
            background: var(--accent3);
        }

        .bg-maroon {
            background-color: var(--primary) !important;
        }

        .bg-navy {
            background-color: var(--secondary) !important;
        }

        .text-maroon {
            color: var(--primary) !important;
        }

        .text-navy {
            color: var(--secondary) !important;
        }

        .dashboard-card {
            border-left: 6px solid var(--secondary);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(12, 30, 71, 0.07);
        }

        .lomba-card {
            border-top: 4px solid var(--accent1);
            border-radius: 18px;
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 2px 12px rgba(12, 30, 71, 0.08);
        }

        .lomba-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(12, 30, 71, 0.13);
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

        .btn-maroon {
            background-color: var(--secondary);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            transition: background 0.2s;
            font-weight: 500;
        }

        .btn-maroon:hover,
        .btn-maroon:focus {
            background-color: var(--primary);
            color: var(--light);
        }

        .btn-outline-maroon {
            border: 1.5px solid var(--secondary);
            color: var(--secondary);
            background: var(--light);
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }

        .btn-outline-maroon:hover,
        .btn-outline-maroon:focus {
            background: var(--secondary);
            color: var(--primary);
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

        .badge-sm {
            font-size: 0.9rem;
            /* Menyesuaikan ukuran font */
            padding: 0.5rem 1rem;
            /* Menyesuaikan padding */
        }
        .badge {
            font-weight: 500;
            /* Menjaga konsistensi berat font */
            border-radius: 8px;
            /* Menyesuaikan radius border */
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

        /* Styling for popup */
        #imagePopup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            display: none; /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 9999;
            cursor: pointer; /* Make the whole area clickable */
        }

        #popupImage {
            max-width: 90%;
            max-height: 90%;
            cursor: default; /* Make sure image itself is not clickable */
        }

        #pdfPopup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            display: none;
            /* Popup dimulai dalam keadaan tersembunyi */
            justify-content: center;
            align-items: center;
            z-index: 9998;
            /* Memastikan popup berada di atas elemen lainnya */
            cursor: pointer;
            /* Membuat seluruh area popup dapat diklik */
        }

        /* Styling iframe PDF */
        #popupPdf {
            max-width: 90%;
            max-height: 90%;
            cursor: default;
            /* Menjaga gambar PDF tidak dapat diklik */
        }

        /* Close button styling */
        #closePopup {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 30px;
            color: var(--light);
            cursor: pointer;
        }

        #closePopup:hover {
            color: var(--primary);
        }
    </style>

    <div class="container">
        <br>
        <div class="card dashboard-card shadow-sm">
            <div class="card-header ranking-header d-flex align-items-center" style="font-size:1.2rem;">
                <i class="nav-icon cil-check"></i> <strong>Verifikasi Prestasi </strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered mb-0 align-middle text-center">
                    <thead>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Lomba</th>
                            <th>Sertifikat</th>
                            <th>Foto Bukti</th>
                            <th>Foto Poster</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($verifikasis as $verifikasi)
                            <tr>
                                <td>{{ $verifikasi->peringkat }}</td>
                                <td>{{ $verifikasi->dataLomba->nama_lomba }}</td>
                                <td class="ellipsis-cell">
                                    @if ($verifikasi->sertif)
                                        <span onclick="showPopupPdf('{{ asset('storage/' . $verifikasi->sertif) }}')"
                                            style="cursor:pointer;">
                                            <i class="bi bi-file-earmark-text"></i> Lihat
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="ellipsis-cell">
                                    @if ($verifikasi->foto_bukti)
                                        <span onclick="showPopupImg('{{ asset('storage/' . $verifikasi->foto_bukti) }}')"
                                            style="cursor:pointer;">
                                            <i class="bi bi-image"></i> Lihat
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="ellipsis-cell">
                                    @if ($verifikasi->poster_lomba)
                                        <span onclick="showPopupImg('{{ asset('storage/' . $verifikasi->poster_lomba) }}')"
                                            style="cursor:pointer;">
                                            <i class="bi bi-image"></i> Lihat
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>@if (strtolower($verifikasi->verifikasi) == 'accepted')
                                        <span class="badge bg-success badge-sm">Accepted</span>
                                    @elseif(strtolower($verifikasi->verifikasi) == 'pending')
                                        <span class="badge bg-primary badge-sm">Pending</span>
                                    @else
                                        <span class="badge bg-danger badge-sm">{{ $verifikasi->verifikasi }}</span>
                                    @endif</td>
                                <td>
                                    <!-- Tombol Accept -->
                                    <form action="{{ route('admin.verifikasi.update', $verifikasi->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Accepted">
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>

                                    <!-- Tombol Reject -->
                                    <form action="{{ route('admin.verifikasi.update', $verifikasi->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
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

    <!-- Popup Image -->
    <!-- Click anywhere on the popup to close it -->
    <div id="imagePopup" onclick="hidePopupImg()"> <!-- Close the popup when clicking outside image -->
        <button id="closePopup" class="btn-close btn-close-white" aria-label="Close" onclick="hidePopupImg()"></button> <!-- Bootstrap close button -->
        <img id="popupImage" src="" alt="Popup Image">
    </div>

    <!-- Popup PDF -->
    <div id="pdfPopup" onclick="hidePopupPdf()">
        <button id="closePopup" class="btn-close btn-close-white" aria-label="Close" onclick="hidePopupPdf()"></button>
        <iframe id="popupPdf" src="" width="80%" height="90%" style="border: none;"></iframe>
    </div>

    <script>
        function showPopupImg(imageSrc) {
            const popup = document.getElementById('imagePopup');
            const popupImage = document.getElementById('popupImage');
            popupImage.src = imageSrc;
            popup.style.display = 'flex';
        }

        // Function to hide popup
        function hidePopupImg() {
            const popup = document.getElementById('imagePopup');
            popup.style.display = 'none';
        }

        function showPopupPdf(pdfSrc) {
            const popup = document.getElementById('pdfPopup');
            const popupPdf = document.getElementById('popupPdf');
            popupPdf.src = pdfSrc;
            popup.style.display = 'flex';
        }

        function hidePopupPdf() {
            const popup = document.getElementById('pdfPopup');
            popup.style.display = 'none';
        }
    </script>
@endsection
