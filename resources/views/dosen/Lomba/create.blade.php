@extends('layouts.app')

@section('content')
    
<style>
    .custom-bg-primary {
        background: #f15a29 !important;
        color: #fff !important;
    }
    .custom-btn-primary {
        background: #f15a29 !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600;
        transition: box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(241,90,41,0.15);
    }
    .custom-btn-primary:hover {
        box-shadow: 0 4px 16px rgba(241,90,41,0.25);
        opacity: 0.95;
    }
    .custom-label {
        color: #f15a29 !important;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .custom-form-control {
        border-radius: 8px;
        border: 1.5px solid #e0e0e0;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .custom-form-control:focus {
        border-color: #f15a29;
        box-shadow: 0 0 0 0.2rem rgba(241,90,41,.15);
    }
    .custom-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 6px 32px rgba(241,90,41,0.10);
        background: #fff;
        overflow: hidden;
    }
    .custom-card .card-header {
        border-bottom: none;
        padding: 1.5rem 2rem;
    }
    .custom-card .card-body {
        padding: 2rem;
    }
    .custom-form-section {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .custom-btn-cancel {
        background: #fff !important;
        color: #141ee4 !important;
        border: 1.5px solid #141ee4 !important;
        font-weight: 600;
        transition: background 0.2s, color 0.2s;
    }
    .custom-btn-cancel:hover {
        background: #f1f3ff !important;
        color: #f15a29 !important;
        border-color: #f15a29 !important;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card custom-card shadow-lg">
                <div class="card-header custom-bg-primary text-white text-center">
                    <h4 class="mb-0 fw-bold">Form Penambahan Lomba</h4>
                </div>
                <div class="card-body">
                    <form id="formTambahLomba" method="POST" action="{{ route('lomba.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-form-section">
                            <div class="mb-3">
                                <label for="nama_lomba" class="form-label custom-label">Nama Lomba</label>
                                <input type="text" class="form-control custom-form-control" name="nama_lomba" required placeholder="Lomba Intenal Competition">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tingkat" class="form-label custom-label">Tingkat</label>
                                    <select class="form-select custom-form-control" name="tingkat_id" required>
                                        <option value="">Pilih Tingkat</option>
                                        @foreach($tingkats as $tingkat)
                                        <option value="{{ $tingkat->id }}">{{ $tingkat->nama_tingkat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kategori" class="form-label custom-label">Kategori</label>
                                    <select class="form-select custom-form-control" name="kategori_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jenis" class="form-label custom-label">Jenis</label>
                                    <select class="form-select custom-form-control" name="jenis_id" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach($jeniss as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="penyelenggara" class="form-label custom-label">Penyelenggara</label>
                                    <input type="text" class="form-control custom-form-control" name="penyelenggara" required placeholder="Jurusan Teknologi Informasi">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_mulai" class="form-label custom-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control custom-form-control" name="tanggal_mulai" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_selesai" class="form-label custom-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control custom-form-control" name="tanggal_selesai" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="file_lomba" class="form-label custom-label">Upload File (Gambar / PDF)</label>
                                <input type="file" class="form-control custom-form-control" name="file_lomba" accept=".jpg,.jpeg,.png,.pdf" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn custom-btn-primary px-4">Simpan</button>
                            <button type="button" class="btn custom-btn-cancel px-4" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
