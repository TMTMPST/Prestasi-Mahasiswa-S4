@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Lomba</strong>
            </div>

            <div class="card-body">
                <form action="/manajemen-lomba/store" method="POST">
                    @csrf
                    <!-- Nama Lomba -->
                    <div class="mb-3">
                        <label for="nama_lomba" class="form-label">Nama Lomba</label>
                        <input type="text" class="form-control" id="nama_lomba" name="nama_lomba" required>
                    </div>

                    <!-- Tingkat -->
                    <div class="mb-3">
                        <label for="tingkat_id" class="form-label">Tingkat</label>
                        <select class="form-select" id="tingkat_id" name="tingkat" required>
                            <option value="">Pilih Tingkat</option>
                            @foreach ($tingkats as $tingkat)
                                <option value="{{ $tingkat->id_tingkat }}">{{ $tingkat->nama_tingkat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jenis -->
                    <div class="mb-3">
                        <label for="jenis_id" class="form-label">Jenis</label>
                        <select class="form-select" id="jenis_id" name="jenis" required>
                            <option value="">Pilih Jenis</option>
                            @foreach ($jeniss as $jenis)
                                <option value="{{ $jenis->id_jenis }}">{{ $jenis->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tingkat Penyelenggara -->
                    <div class="mb-3">
                        <label for="tingkat_penyelenggara" class="form-label">Tingkat Penyelenggara</label>
                        <select class="form-select" id="tingkat_penyelenggara" name="tingkat_penyelenggara" required>
                            <option value="">Pilih Tingkat Penyelenggara</option>
                            <option value="Internal Kampus / Komunitas Lokal">Internal Kampus / Komunitas Lokal</option>
                            <option value="Kampus Lain / Organisasi Mahasiswa Nasional">Kampus Lain / Organisasi Mahasiswa Nasional</option>
                            <option value="Perusahaan / Start-up Teknologi">Perusahaan / Start-up Teknologi</option>
                            <option value="Lembaga Pemerintah / Kementerian">Lembaga Pemerintah / Kementerian</option>
                            <option value="Asosiasi Profesional / Internasional (IEEE, ACM, Google, dsb)">Asosiasi Profesional / Internasional (IEEE, ACM, Google, dsb)</option>
                        </select>
                    </div>

                    <!-- Penyelenggara -->
                    <div class="mb-3">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                        <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    
                    <!-- Link -->
                    <div class="mb-3">
                        <label for="link_lomba" class="form-label">Link Lomba</label>
                        <input type="text" class="form-control" id="link_lomba" name="link_lomba" required>
                    </div>

                    <!-- Biaya -->
                    <div class="mb-3">
                        <label for="biaya" class="form-label">Biaya</label>
                        <input type="number" class="form-control" id="biaya" 
                        value="0" name="biaya" required>
                    </div>

                    <!-- Hadiah -->
                    <div class="mb-3">
                        <label for="hadiah" class="form-label">Hadiah</label>
                        <input type="text" class="form-control" id="hadiah" 
                        name="hadiah" value="0" required>
                    </div>

                    <input type="hidden" name="verifikasi" value="Pending">

                    <!-- Tanggal Mulai -->
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Dibuka</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tgl_dibuka" required>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Ditutup</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tgl_ditutup" required>
                    </div>

                    <a href="/manajemen-lomba" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
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
