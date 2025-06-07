@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Bimbingan</strong>
            </div>
            <form action="{{ route('mahasiswa.update_bimbingan', $bimbingan->id_bimbingan) }}" method="POST" class="p-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_lomba" class="form-label">Nama Lomba</label>
                    <select id="id_lomba" name="id_lomba" class="form-select" required>
                        <option value="">Pilih Lomba</option>
                        @foreach ($lombas as $lomba)
                            <option value="{{ $lomba->id_lomba }}"
                                {{ $lomba->id_lomba == old('id_lomba', $bimbingan->id_lomba) ? 'selected' : '' }}>
                                {{ $lomba->nama_lomba }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nama_pengaju" class="form-label">Nama Pengaju</label>
                    <input class="form-control" type="text" id="nama_pengaju" name="nama_pengaju"
                        value="{{ old('nama_pengaju', $bimbingan->nama_pengaju) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nip" class="form-label">Nama Dosen Pembimbing</label>
                    <select id="nip" name="nip" class="form-select" required>
                        <option value="">Pilih Dosen</option>
                        @foreach ($dosen as $dsn)
                            <option value="{{ $dsn->nip }}"
                                {{ $dsn->nip == old('nip', $bimbingan->nip) ? 'selected' : '' }}>
                                {{ $dsn->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('mahasiswa.bimbingan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
