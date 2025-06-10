@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Data Prestasi</strong>
            </div>
            <form action="{{ route('admin.presma.update', $presma->id) }}" method="POST" enctype="multipart/form-data"
                class="p-4">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="mahasiswa" class="form-label">Mahasiswa</label>
                    <select class="form-select" name="mahasiswa" id="mahasiswa" aria-label="Default select example">
                        <option selected>Pilih Mahasiswa</option>
                        @foreach ($mahasiswa as $mhs)
                            <option value="{{ $mhs->nim }}" {{ $presma->nimMahasiswa->nim == $mhs->nim ? 'selected' : '' }}>
                                {{ $mhs->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="peringkat" class="form-label">Peringkat</label>
                    <select class="form-select" name="peringkat" id="peringkat" aria-label="Default select example">
                        <option value="" {{ $presma->peringkat == '' ? 'selected' : '' }}>Masukkan Peringkat</option>
                        <option value="Juara 1" {{ $presma->peringkat == 'Juara 1' ? 'selected' : '' }}>Juara 1</option>
                        <option value="Juara 2" {{ $presma->peringkat == 'Juara 2' ? 'selected' : '' }}>Juara 2</option>
                        <option value="Juara 3" {{ $presma->peringkat == 'Juara 3' ? 'selected' : '' }}>Juara 3</option>
                        <option value="Harapan 1" {{ $presma->peringkat == 'Harapan 1' ? 'selected' : '' }}>Harapan 1
                        </option>
                        <option value="Harapan 2" {{ $presma->peringkat == 'Harapan 2' ? 'selected' : '' }}>Harapan 2
                        </option>
                        <option value="Harapan 3" {{ $presma->peringkat == 'Harapan 3' ? 'selected' : '' }}>Harapan 3
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_lomba" class="form-label">Nama Lomba</label>
                    <select id="id_lomba" name="id_lomba" class="form-select" required>
                        <option value="">Pilih Lomba</option>
                        @foreach ($lombas as $lomba)
                            <option value="{{ $lomba->id_lomba }}"
                                {{ $presma->id_lomba == $lomba->id_lomba ? 'selected' : '' }}>
                                {{ $lomba->nama_lomba }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Sertifikat</label>
                    <input class="form-control" type="file" id="sertif" name="sertif" id="sertif"
                        value="{{ $presma->sertif }}">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Foto Bukti</label>
                    <input class="form-control" type="file" id="foto_bukti" name="foto_bukti" id="foto_bukti">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Poster Lomba</label>
                    <input class="form-control" type="file" id="poster_lomba" name="poster_lomba" id="poster_lomba">
                </div>

                <input type="hidden" name="verifikasi" value="Pending">

                <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
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
@endsection
