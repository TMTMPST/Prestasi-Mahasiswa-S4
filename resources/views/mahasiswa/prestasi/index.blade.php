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
            background: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            display: none;
            /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 9999;
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
        }

        #closePopup:hover {
            color: var(--primary);
        }

        /* Popup styling */
        #rejectionPopup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            cursor: pointer;
            /* Make the entire area clickable */
        }

        #rejectionForm {
            background: var(--light);
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        #closeRejectionPopup {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 30px;
            color: var(--primary);
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
    <div class="container py-4">
        <a href="/prestasi/tambah_prestasi" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle me-1"></i>Tambah Prestasi
        </a>
        <div class="card dashboard-card shadow-sm">
            <div class="card-header bg-maroon">
                <i class="bi bi-trophy me-2"></i>
                <strong>Data Prestasi</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Peringkat</th>
                            <th>Nama Lomba</th>
                            <th>Sertifikat</th>
                            <th>Foto Bukti</th>
                            <th>Poster Lomba</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prestasi as $index => $pres)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pres->peringkat }}</td>
                                <td>{{ $pres->dataLomba->nama_lomba }}</td>

                                <td>
                                    <a href="{{ asset('storage/' . $pres->sertif) }}" target="_blank"
                                        onclick="event.preventDefault(); showPopupImg('{{ asset('storage/' . $pres->sertif) }}');">
                                        <img src="{{ asset('storage/' . $pres->sertif) }}" alt="Sertifikat" width="100"
                                            style="cursor:pointer;">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $pres->foto_bukti) }}" target="_blank"
                                        onclick="event.preventDefault(); showPopupImg('{{ asset('storage/' . $pres->foto_bukti) }}');">
                                        <img src="{{ asset('storage/' . $pres->foto_bukti) }}" alt="Foto Bukti"
                                            width="100" style="cursor:pointer;">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $pres->poster_lomba) }}" target="_blank"
                                        onclick="event.preventDefault(); showPopupImg('{{ asset('storage/' . $pres->poster_lomba) }}');">
                                        <img src="{{ asset('storage/' . $pres->poster_lomba) }}" alt="Poster Lomba"
                                            width="100" style="cursor:pointer;">
                                    </a>
                                </td>
                                <td>{{ $pres->verifikasi }}</td>
                                <td>
                                    <form action="{{ route('mahasiswa.destroy', $pres->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                    <a href="{{ route('mahasiswa.edit_prestasi', $pres->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
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

    <div id="imagePopup" onclick="hidePopupImg()"> <!-- Close the popup when clicking outside image -->
        <button id="closePopup" class="btn-close btn-close-white" aria-label="Close" onclick="hidePopupImg()"></button>
        <!-- Bootstrap close button -->
        <img id="popupImage" src="" alt="Popup Image">
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
    </script>
@endsection
