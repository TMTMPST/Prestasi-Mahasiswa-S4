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
        .dashboard-card {
            border-left: 6px solid var(--secondary);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(12,30,71,0.07);
        }
        .card-header {
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 18px 18px 0 0;
            letter-spacing: 0.5px;
            background: linear-gradient(90deg, var(--primary) 100%);
            color: var(--light);
        }
        .btn-success, .btn-secondary {
            border-radius: 8px;
            font-weight: 500;
        }
        .form-label {
            font-weight: 500;
            color: var(--primary);
        }
        .form-control, .form-select {
            border-radius: 8px;
            border-color: var(--primary);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(247, 183, 29, 0.25);
        }
        .alert-danger {
            border-radius: 8px;
        }
    </style>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card dashboard-card shadow-sm">
                    <div class="card-header">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Program Studi
                    </div>
                    <form action="{{ route('admin.prodi.update', $programStudi->id_prodi) }}" method="POST" class="p-4">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="kode_prodi" class="form-label">Kode Program Studi</label>
                            <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" 
                                value="{{ old('kode_prodi', $programStudi->kode_prodi) }}" placeholder="Contoh: TI, SI, RPL" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_prodi" class="form-label">Nama Program Studi</label>
                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" 
                                value="{{ old('nama_prodi', $programStudi->nama_prodi) }}" placeholder="Masukkan nama program studi" required>
                        </div>

                        <div class="mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <select class="form-select" id="jenjang" name="jenjang" required>
                                <option value="">Pilih Jenjang</option>
                                <option value="D3" {{ old('jenjang', $programStudi->jenjang) == 'D3' ? 'selected' : '' }}>D3 (Diploma 3)</option>
                                <option value="D4" {{ old('jenjang', $programStudi->jenjang) == 'D4' ? 'selected' : '' }}>D4 (Diploma 4)</option>
                                <option value="S1" {{ old('jenjang', $programStudi->jenjang) == 'S1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                                <option value="S2" {{ old('jenjang', $programStudi->jenjang) == 'S2' ? 'selected' : '' }}>S2 (Magister)</option>
                                <option value="S3" {{ old('jenjang', $programStudi->jenjang) == 'S3' ? 'selected' : '' }}>S3 (Doktor)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fakultas" class="form-label">Fakultas</label>
                            <input type="text" class="form-control" id="fakultas" name="fakultas" 
                                value="{{ old('fakultas', $programStudi->fakultas) }}" placeholder="Masukkan nama fakultas" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif" {{ old('status', $programStudi->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ old('status', $programStudi->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" 
                                placeholder="Masukkan deskripsi program studi">{{ old('deskripsi', $programStudi->deskripsi) }}</textarea>
                        </div>

                        <a href="{{ route('admin.prodi.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Update</button>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
