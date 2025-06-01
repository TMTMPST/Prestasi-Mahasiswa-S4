@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Profil Dosen</strong>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>NIP</th>
                    <td>{{ $dosen->nip }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $dosen->nama }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $dosen->email }}</td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>{{ $dosen->level }}</td>
                </tr>
                <tr>
                    <th>Bidang Minat</th>
                    <td>{{ $dosen->bidangMinat }}</td>
                </tr>
            </table>
<a href="{{ route('dosen.profile.update_profile', $dosen->nip) }}" class="btn btn-primary mt-3">Update Profile</a>
        </div>
    </div>
@endsection
