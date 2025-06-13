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
            --success: #28a745;
            --pending: #adb5bd;
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
            background: var(--light);
        }

        .ranking-header {
            background: linear-gradient(90deg, var(--primary) 100%);
            color: var(--light);
            border-radius: 18px 18px 0 0;
            font-size: 1.2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
        }

        .btn-maroon {
            background-color: var(--secondary);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
            box-shadow: 0 2px 8px rgba(247, 183, 29, 0.08);
        }

        .btn-maroon:hover,
        .btn-maroon:focus {
            background-color: var(--primary);
            color: var(--light);
        }

        .btn-primary,
        .btn-danger {
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--secondary);
            color: var(--primary);
            border: none;
            transition: background 0.2s, color 0.2s;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--primary);
            color: var(--light);
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #c0392b;
        }

        .table thead th {
            background-color: var(--primary);
            color: var(--light);
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-align: center;
            vertical-align: middle;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
        }

        .td-left {
            text-align: left !important;
        }

        .badge.bg-primary {
            background-color: var(--secondary) !important;
            color: var(--primary) !important;
            font-weight: 500;
            border-radius: 8px;
            padding: 0.5em 1em;
            font-size: 0.95em;
        }

        .badge.bg-success {
            background-color: var(--success) !important;
            color: #fff !important;
            font-weight: 500;
            border-radius: 8px;
            padding: 0.5em 1em;
            font-size: 0.95em;
        }

        .badge.bg-pending {
            background-color: var(--pending) !important;
            color: #fff !important;
            font-weight: 500;
            border-radius: 8px;
            padding: 0.5em 1em;
            font-size: 0.95em;
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

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: var(--light-gray);
        }

        .table tbody tr:hover {
            background: #f3f6fa;
        }

        .ellipsis-cell {
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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

        .table-responsive::-webkit-scrollbar {
            display: none;
        }

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
            background: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            display: none;
            /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 9998;
            cursor: pointer;
            /* Make the whole area clickable */
        }

        #popupImage {
            max-width: 90%;
            max-height: 90%;
            cursor: default;
            /* Make sure image itself is not clickable */
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
            z-index: 9999;
            /* Ensure close button is above everything */
        }

        #closePopup:hover {
            color: var(--primary);
        }
    </style>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 text-maroon">
                <i class="bi bi-trophy-fill me-2"></i>Manajemen Prestasi Mahasiswa
            </h3>
            <div class="d-flex justify-content-end">
                <a href="{{ route('presma.export') }}" class="btn btn-success me-2">
                    <i class="bi bi-file-earmark-excel"></i> Export to Excel
                </a>
                <a href="/manajemen-presma/create" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Prestasi
                </a>
            </div>
        </div>
        <div class="card dashboard-card shadow-sm">
            <div class="ranking-header">
                <i class="bi bi-award me-2"></i>
                <span>Prestasi Mahasiswa</span>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0 align-middle">
                    <thead>
                        <tr>
                            <th class="text-start">Nama Mahasiswa</th>
                            <th>Peringkat</th>
                            <th class="text-start">Nama Lomba</th>
                            <th class="ellipsis-cell">Sertifikat</th>
                            <th class="ellipsis-cell">Foto Bukti</th>
                            <th class="ellipsis-cell">Foto Poster</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presmas as $presma)
                            <tr>
                                <td class="td-left">
                                    <span class="avatar-initial me-2">
                                        {{ strtoupper(substr($presma->nimMahasiswa->nama ?? 'N/A', 0, 1)) }}
                                    </span>
                                    {{ $presma->nimMahasiswa->nama ?? 'N/A' }}
                                </td>
                                <td>{{ $presma->peringkat }}</td>
                                <td class="td-left">{{ $presma->dataLomba->nama_lomba }}</td>
                                <td class="ellipsis-cell">
                                    @if ($presma->sertif)
                                        <span onclick="showPopupPdf('{{ asset('storage/' . $presma->sertif) }}')"
                                            style="cursor:pointer;">
                                            <i class="bi bi-file-earmark-text"></i> Lihat
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="ellipsis-cell">
                                    @if ($presma->foto_bukti)
                                        <span onclick="showPopupImg('{{ asset('storage/' . $presma->foto_bukti) }}')"
                                            style="cursor:pointer;">
                                            <i class="bi bi-image"></i> Lihat
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="ellipsis-cell">
                                    @if ($presma->poster_lomba)
                                        <span onclick="showPopupImg('{{ asset('storage/' . $presma->poster_lomba) }}')"
                                            style="cursor:pointer;">
                                            <i class="bi bi-image"></i> Lihat
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if (strtolower($presma->verifikasi) == 'accepted')
                                        <span class="badge bg-success badge-sm">Accepted</span>
                                    @elseif(strtolower($presma->verifikasi) == 'pending')
                                        <span class="badge bg-primary badge-sm">Pending</span>
                                    @else
                                        <span class="badge bg-danger badge-sm">{{ $presma->verifikasi }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/manajemen-presma/edit/{{ $presma->id }}" class="btn btn-primary btn-sm me-1"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="/manajemen-presma/delete/{{ $presma->id }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="bi bi-emoji-frown fs-4"></i><br>
                                    Belum ada data mahasiswa
                                </td>
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
        <button id="closePopup" class="btn-close btn-close-white" aria-label="Close" onclick="hidePopupImg()"></button>
        <!-- Bootstrap close button -->
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
