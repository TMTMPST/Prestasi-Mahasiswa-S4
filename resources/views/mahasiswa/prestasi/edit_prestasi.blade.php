@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    :root {
        --primary: #0c1e47;
        --secondary: #f7b71d;
        --accent1: #f26430;
        --accent3: #e6e6e6;
        --light: #ffffff;
    }
    body { background: var(--accent3); }
    .dashboard-card {
        border-left: 6px solid var(--secondary);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(12, 30, 71, 0.07);
        background: var(--light);
    }
    .card-header.bg-maroon {
        background-color: var(--primary) !important;
        color: var(--light);
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 18px 18px 0 0;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
    }
    .form-label {
        color: var(--primary);
        font-weight: 500;
    }
    .btn-success {
        background: var(--secondary);
        color: var(--primary);
        font-weight: 500;
        border-radius: 8px;
        border: none;
        transition: all 0.2s;
    }
    .btn-success:hover,
    .btn-success:focus {
        background: var(--primary);
        color: var(--light);
    }
    .btn-secondary {
        border-radius: 8px;
    }
</style>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header bg-maroon">
                    <i class="bi bi-pencil-square me-2"></i>
                    <strong>Edit Data Prestasi</strong>
                </div>
                <form action="{{ route('mahasiswa.update_prestasi', $prestasi->id) }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="peringkat" class="form-label">Peringkat</label>
                        <select class="form-select" name="peringkat" id="peringkat" required>
                            <option disabled value="">Masukkan Peringkat</option>
                            <option value="1" {{ old('peringkat', $prestasi->peringkat) == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('peringkat', $prestasi->peringkat) == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('peringkat', $prestasi->peringkat) == '3' ? 'selected' : '' }}>3</option>
                            @foreach($peringkat_lain ?? [] as $rank)
                                @if(!in_array($rank, ['1','2','3']))
                                    <option value="{{ $rank }}" {{ old('peringkat', $prestasi->peringkat) == $rank ? 'selected' : '' }}>
                                        {{ $rank }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_lomba" class="form-label">Nama Lomba</label>
                        <select id="id_lomba" name="id_lomba" class="form-select" required>
                            <option value="">Pilih Lomba</option>
                            @foreach ($lombas as $lomba)
                                <option value="{{ $lomba->id_lomba }}" 
                                    {{ old('id_lomba', $prestasi->id_lomba) == $lomba->id_lomba ? 'selected' : '' }}>
                                    {{ $lomba->nama_lomba }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sertif" class="form-label">Sertifikat</label>
                        <input class="form-control" type="file" id="sertif" name="sertif">
                        @if($prestasi->sertif)
                            <small class="text-muted">File lama: {{ basename($prestasi->sertif) }}</small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="foto_bukti" class="form-label">Foto Bukti</label>
                        <input class="form-control" type="file" id="foto_bukti" name="foto_bukti">
                        @if($prestasi->foto_bukti)
                            <small class="text-muted">File lama: {{ basename($prestasi->foto_bukti) }}</small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="poster_lomba" class="form-label">Poster Lomba</label>
                        <input class="form-control" type="file" id="poster_lomba" name="poster_lomba">
                        @if($prestasi->poster_lomba)
                            <small class="text-muted">File lama: {{ basename($prestasi->poster_lomba) }}</small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i>Simpan
                    </button>
                    <a href="{{ route('mahasiswa.prestasi.index') }}" class="btn btn-secondary ms-2">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection