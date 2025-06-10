@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #0c1e47;
        --secondary: #f7b71d;
        --accent1: #f26430;
        --accent3: #e6e6e6;
        --light: #ffffff;
        --gray: #6c757d;
        --light-gray: #f8f9fa;
        --accepted: #28a745;
    }
    body { background: var(--accent3); }
    .dashboard-card {
        border-left: 6px solid var(--secondary);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(12, 30, 71, 0.07);
        background: var(--light);
    }
    .card-header.bg-maroon {
        background-color: var(--primary) !important;
        color: var(--light);
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 18px 18px 0 0;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
    }
    .table thead th {
        background-color: var(--primary);
        color: var(--light);
        font-size: 1rem;
        letter-spacing: 0.5px;
    }
    .table tbody tr {
        transition: background 0.15s;
    }
    .table tbody tr:hover {
        background: var(--light-gray);
    }
    .btn-danger {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-danger:hover,
    .btn-danger:focus {
        background: var(--primary);
        color: var(--light);
        border-color: var(--primary);
    }
    .status-accepted {
        color: var(--accepted);
        font-weight: bold;
    }
</style>
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header bg-maroon">
                    <strong>Verifikasi Prestasi</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Peringkat</th>
                                    <th>Nama Lomba</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($prestasi as $index => $pres)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pres->peringkat }}</td>
                                        <td>{{ $pres->dataLomba->nama_lomba }}</td>
                                        <td>
                                            @if(strtolower($pres->verifikasi) == 'accepted')
                                                <span class="status-accepted">{{ $pres->verifikasi }}</span>
                                            @else
                                                {{ $pres->verifikasi }}
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('mahasiswa.destroy', $pres->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data mahasiswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection