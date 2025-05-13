@extends('dosen.layouts.app')

@section('content')
<div class="container">
    {{-- Card besar di bawah --}}
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as Dosen!') }}
                </div>
            </div>
        </div>
    </div>

    <div class="my-4"></div>

    {{-- Rekomendasi Lomba --}}
    <div class="row mb-10">
        <div class="col-12">
            <div 
                class="d-flex flex-nowrap overflow-auto" 
                style="gap: 1rem; padding-bottom: 8px; scrollbar-width: none; -ms-overflow-style: none;"
            >
                <style>
                    .d-flex.flex-nowrap.overflow-auto::-webkit-scrollbar {
                        display: none;
                    }
                    .d-flex.flex-nowrap.overflow-auto {
                        padding-right: 16px;
                    }
                </style>

                @forelse ($lombas->take(4) as $lomba)
                    <div class="flex-shrink-0" style="min-width: 600px; max-width: 700px;">
                        <div class="card shadow-sm h-100">
                            <div class="card-header text-truncate">
                                {{ $lomba->nama_lomba }}
                            </div>
                            <div class="card-body" style="font-size: 0.95rem;">
                                <div class="row">
                                    <div class="col-6">
                                        <p><strong>Tingkat:</strong> {{ $lomba->tingkatRelasi->nama_tingkat ?? '-' }}</p>
                                        <p><strong>Kategori:</strong> {{ $lomba->kategoriRelasi->nama_kategori ?? '-' }}</p>
                                        <p><strong>Jenis:</strong> {{ $lomba->jenisRelasi->nama_jenis ?? '-' }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p><strong>Penyelenggara:</strong> {{ $lomba->penyelenggara }}</p>
                                        <p><strong>Mulai:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal_mulai)->format('d M Y') }}</p>
                                        <p><strong>Selesai:</strong> {{ \Carbon\Carbon::parse($lomba->tanggal_selesai)->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="#" class="btn btn-primary btn-sm">Detail</a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                @empty
                    <div class="flex-shrink-0" style="min-width: 600px;">
                        <div class="alert alert-warning mb-0 w-100">
                            Tidak ada informasi lomba tersedia.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Ranking Mahasiswa --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    Ranking Mahasiswa
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto; scrollbar-width: none; -ms-overflow-style: none;">
                        <style>
                            .table-responsive::-webkit-scrollbar {
                                display: none;
                            }
                        </style>
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Program Studi</th>
                                    <th>Prestasi Tertinggi</th>
                                    <th>Poin Presma</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswa as $index => $mhs)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $mhs->nama }}</td>
                                        <td>{{ $mhs->nim }}</td>
                                        <td>{{ $mhs->prodi }}</td>
                                        <td>{{ $mhs->prestasi_tertinggi }}</td>
                                        <td>{{ $mhs->poin_presma }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data mahasiswa</td>
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
