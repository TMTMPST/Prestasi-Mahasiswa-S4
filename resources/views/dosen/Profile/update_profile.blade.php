@extends('layouts.app')

@section('content')
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
        box-shadow: 0 4px 24px rgba(12,30,71,0.07);
    }
    .lomba-card {
        border-top: 4px solid var(--accent1);
        border-radius: 18px;
        transition: transform 0.15s, box-shadow 0.15s;
        box-shadow: 0 2px 12px rgba(12,30,71,0.08);
    }
    .lomba-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(12,30,71,0.13);
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
        background: var(--primary);
        color: var(--light);
        border-bottom: none;
    }
    .card {
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(12,30,71,0.07);
        border: none;
        background: var(--light);
    }
    .form-label {
        color: var(--primary);
        font-weight: 500;
    }
    .form-control:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(247,183,29,.15);
    }
    .btn-maroon {
        background-color: var(--secondary);
        color: var(--primary);
        border: none;
        border-radius: 8px;
        transition: background 0.2s;
        font-weight: 500;
    }
    .btn-maroon:hover, .btn-maroon:focus {
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
    .btn-outline-maroon:hover, .btn-outline-maroon:focus {
        background: var(--secondary);
        color: var(--primary);
    }
</style>
<div class="container py-4">
    <div class="card dashboard-card mb-4">
        <div class="card-header">
            <strong>Update Profil Dosen</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('dosen.profile.update', $dosen->nip) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $dosen->nip) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $dosen->nama) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $dosen->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select class="form-control" id="level" name="level_display" disabled>
                        <option value="DSN" {{ old('level', $dosen->level) == 'DSN' ? 'selected' : '' }}>Dosen ( DSN )</option>
                        <option value="MHS" {{ old('level', $dosen->level) == 'MHS' ? 'selected' : '' }}>Mahasiswa ( MHS )</option>
                        <option value="ADM" {{ old('level', $dosen->level) == 'ADM' ? 'selected' : '' }}>Admin ( ADM )</option>
                    </select>
                    <!-- Kirim value sebenarnya pakai hidden input -->
                    <input type="hidden" name="level" value="{{ old('level', $dosen->level) }}">
                </div>

                <div class="mb-3">
    <label for="bidangMinat" class="form-label">Bidang Minat</label>
    <select class="form-control" id="bidangMinat" name="bidangMinat">
    <option value="">-- Pilih Bidang Minat --</option>
    @foreach($jeniss as $jenis)
        <option value="{{ $jenis->id_jenis }}" {{ old('bidangMinat', $dosen->bidangMinat) == $jenis->id_jenis ? 'selected' : '' }}>
            {{ $jenis->nama_jenis }}
        </option>
    @endforeach
</select>
</div>
                <button type="submit" class="btn btn-maroon me-2">Simpan Perubahan</button>
                <a href="{{ route('dosen.profile.index') }}" class="btn btn-outline-maroon">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
