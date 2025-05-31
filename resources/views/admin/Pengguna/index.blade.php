@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/manajemen-user/tambah" class="btn btn-success mb-3">Tambah Pengguna</a>
    <br>
    <div class="card">
        <div class="card-header">
            <strong>Data Pengguna</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Nama</th>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengguna as $item)
                        <tr>
                            <td>{{ $item->level }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nim ?? $item->nip ?? $item->username }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection