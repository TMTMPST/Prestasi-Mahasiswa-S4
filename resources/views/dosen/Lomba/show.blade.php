<!-- Tambahkan link Google Fonts di bagian atas -->

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
        --font-main: 'Poppins', Arial, sans-serif;
    }

    body,
    .modal-body,
    .modal-header,
    .modal-footer,
    .list-group-item,
    .btn {
        font-family: var(--font-main);
    }

    .modal-header {
        background: var(--primary);
        color: var(--light);
        border-bottom: 2px solid var(--secondary);
    }

    .modal-title {
        color: var(--light-gray);
    }

    .btn-close {
        filter: invert(1);
    }

    .modal-body {
        background: var(--light-gray);
    }

    .list-group-item {
        background: var(--light);
        border-color: var(--accent3);
        color: var(--dark);
    }

    .list-group-item strong {
        color: var(--primary);
        min-width: 180px;
        display: inline-block;
        font-weight: 600;
    }

    a {
        color: var(--accent1);
    }

    a:hover {
        color: var(--accent2);
    }

    .modal-footer {
        background: var(--light-gray);
        border-top: 2px solid var(--secondary);
    }

    .btn-secondary {
        background: var(--secondary);
        color: var(--primary);
        border: none;
    }

    .btn-secondary:hover {
        background: var(--accent2);
        color: var(--primary);
    }
</style>

<div class="modal-body">
    <h4 class="mb-3">{{ $lomba->nama_lomba }}</h4>
    <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item">
            <strong>Penyelenggara</strong>: {{ $lomba->penyelenggara }}
        </li>
        <li class="list-group-item">
            <strong>Tingkat</strong>: {{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}
        </li>
        <li class="list-group-item">
            <strong>Jenis</strong>: {{ $lomba->jenisRelasi->nama_jenis ?? '-' }}
        </li>
        <li class="list-group-item">
            <strong>Tanggal Mulai</strong>: {{ $lomba->tgl_dibuka }}
        </li>
        <li class="list-group-item">
            <strong>Tanggal Selesai</strong>: {{ $lomba->tgl_ditutup }}
        </li>
        <li class="list-group-item">
            <strong>Alamat</strong>: {{ $lomba->alamat }}
        </li>
        <li class="list-group-item">
            <strong>Link</strong>:
            <a href="{{ $lomba->link_lomba }}" target="_blank">{{ $lomba->link_lomba }}</a>
        </li>
        <li class="list-group-item">
            <strong>Biaya</strong>:
            {{ $lomba->biaya == 0 ? 'Gratis' : 'Rp' . number_format($lomba->biaya, 0, ',', '.') }}
        </li>
        <li class="list-group-item">
            <strong>Hadiah</strong>: {{ $lomba->hadiah }}
        </li>
        <li class="list-group-item">
            <strong>Tingkat Penyelenggara</strong>: {{ $lomba->tingkat_penyelenggara }}
        </li>
        @if (!empty($lomba->file_lomba))
            <li class="list-group-item">
                <strong>File</strong>:
                <a href="{{ asset('storage/' . $lomba->file_lomba) }}" target="_blank">Download</a>
            </li>
        @endif
        @if ($authLevel == 'ADM')
            <li class="list-group-item">
                <strong>Status</strong>:
                @if ($lomba->verifikasi == 'Pending')
                    <!-- Tombol Accept dan Reject jika status Pending -->
                    <form action="{{ route('admin.lomba.update_status', $lomba->id_lomba) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="verifikasi" value="Accepted">
                        <button type="submit" class="btn btn-success">Accept</button>
                    </form>

                    <form action="{{ route('admin.lomba.update_status', $lomba->id_lomba) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="verifikasi" value="Rejected">
                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                    </form>
                @else
                    <!-- Menampilkan nilai status jika bukan Pending -->
                    <span class="badge {{ $lomba->verifikasi == 'Accepted' ? 'bg-success' : 'bg-danger text-dark' }}">
                        {{ $lomba->verifikasi }}
                    </span>
                @endif
            </li>
        @endif
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>
