@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Update Profil Dosen</strong>
        </div>
        <div class="card-body">
<form action="{{ route('dosen.profile.update', $dosen->nip) }}" method="POST">                @csrf
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
                    <input type="text" class="form-control" id="level" name="level" value="{{ old('level', $dosen->level) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="bidangMinat" class="form-label">Bidang Minat</label>
                    <input type="text" class="form-control" id="bidangMinat" name="bidangMinat" value="{{ old('bidangMinat', $dosen->bidangMinat) }}">
                </div>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
<a href="{{ route('dosen.profile.index') }}" class="btn btn-secondary">Batal</a>            </form>
        </div>
    </div>
</div>
@endsection