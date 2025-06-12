@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h3 class="mt-4 mb-4 text-center"><strong>Update Lomba</strong></h3>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.lomba.update', $lomba->id_lomba) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Nama Lomba -->
                            <div class="mb-3">
                                <label for="nama_lomba" class="form-label">Nama Lomba</label>
                                <input type="text" class="form-control" id="nama_lomba" name="nama_lomba"
                                    value="{{ $lomba->nama_lomba }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Tingkat -->
                            <div class="mb-3">
                                <label for="tingkat_id" class="form-label">Tingkat</label>
                                <select class="form-select" id="tingkat_id" name="tingkat" required>
                                    <option value="">Pilih Tingkat</option>
                                    @foreach ($tingkats as $tingkat)
                                        <option value="{{ $tingkat->id_tingkat }}"
                                            @if ($lomba->tingkat == $tingkat->id_tingkat) selected @endif>
                                            {{ $tingkat->nama_tingkat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Jenis -->
                            <div class="mb-3">
                                <label for="jenis_id" class="form-label">Jenis</label>
                                <select class="form-select" id="jenis_id" name="jenis" required>
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($jeniss as $jenis)
                                        <option value="{{ $jenis->id_jenis }}" @if ($lomba->jenis == $jenis->id_jenis) selected @endif>
                                            {{ $jenis->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Tingkat Penyelenggara -->
                            <div class="mb-3">
                                <label for="tingkat_penyelenggara" class="form-label">Tingkat Penyelenggara</label>
                                <select class="form-select" id="tingkat_penyelenggara" name="tingkat_penyelenggara" required>
                                    <option value="">Pilih Tingkat Penyelenggara</option>
                                    <option value="Internal Kampus / Komunitas Lokal"
                                        {{ $lomba->tingkat_penyelenggara == 'Internal Kampus / Komunitas Lokal' ? 'selected' : '' }}>
                                        Internal Kampus / Komunitas Lokal
                                    </option>
                                    <option value="Kampus Lain / Organisasi Mahasiswa Nasional"
                                        {{ $lomba->tingkat_penyelenggara == 'Kampus Lain / Organisasi Mahasiswa Nasional' ? 'selected' : '' }}>
                                        Kampus Lain / Organisasi Mahasiswa Nasional
                                    </option>
                                    <option value="Perusahaan / Start-up Teknologi"
                                        {{ $lomba->tingkat_penyelenggara == 'Perusahaan / Start-up Teknologi' ? 'selected' : '' }}>
                                        Perusahaan / Start-up Teknologi
                                    </option>
                                    <option value="Lembaga Pemerintah / Kementerian"
                                        {{ $lomba->tingkat_penyelenggara == 'Lembaga Pemerintah / Kementerian' ? 'selected' : '' }}>
                                        Lembaga Pemerintah / Kementerian
                                    </option>
                                    <option value="Asosiasi Profesional / Internasional (IEEE, ACM, Google, dsb)"
                                        {{ $lomba->tingkat_penyelenggara == 'Asosiasi Profesional / Internasional (IEEE, ACM, Google, dsb)' ? 'selected' : '' }}>
                                        Asosiasi Profesional / Internasional (IEEE, ACM, Google, dsb)
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Penyelenggara -->
                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara"
                                    value="{{ $lomba->penyelenggara }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="{{ $lomba->alamat }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Link -->
                            <div class="mb-3">
                                <label for="link_lomba" class="form-label">Link Lomba</label>
                                <input type="text" class="form-control" id="link_lomba" value="{{ $lomba->link_lomba }}"
                                    name="link_lomba" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Biaya -->
                            <div class="mb-3">
                                <label for="biaya" class="form-label">Biaya</label>
                                <input type="number" class="form-control" id="biaya" value="{{ $lomba->biaya }}"
                                    name="biaya" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Hadiah -->
                            <div class="mb-3">
                                <label for="hadiah" class="form-label">Hadiah</label>
                                <input type="text" class="form-control" id="hadiah" name="hadiah"
                                    value="{{ $lomba->hadiah }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Tanggal Mulai -->
                            <div class="mb-3">
                                <label for="tanggal_mulai" class="form-label">Tanggal Dibuka</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tgl_dibuka"
                                    value="{{ $lomba->tgl_dibuka }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Tanggal Selesai -->
                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Ditutup</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tgl_ditutup"
                                    value="{{ $lomba->tgl_ditutup }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Verifikasi -->
                            <div class="mb-3">
                                <label for="verifikasi" class="form-label">Verifikasi</label>
                                <select class="form-select" id="verifikasi" name="verifikasi" required>
                                    <option value="">Pilih Status Verifikasi</option>
                                    <option value="Accepted"
                                        @if ($lomba->verifikasi == 'Accepted') selected @endif>Accepted</option>
                                    <option value="Rejected"
                                        @if ($lomba->verifikasi == 'Rejected') selected @endif>Rejected</option>
                                    <option value="Pending"
                                        @if ($lomba->verifikasi == 'Pending') selected @endif>Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
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
@endsection
