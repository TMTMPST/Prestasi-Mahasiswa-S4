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
    <div class="row mb-4">
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
                <div class="flex-shrink-0" style="min-width: 500px;">
                    <div class="card shadow-sm">
                        <div class="card-header">Rekomendasi Lomba 1</div>
                        <div class="card-body text-center" style="font-size: 1.5rem;">
                            Konten Lomba 1
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0" style="min-width: 500px;">
                    <div class="card shadow-sm">
                        <div class="card-header">Rekomendasi Lomba 2</div>
                        <div class="card-body text-center" style="font-size: 1.5rem;">
                            Konten Lomba 2
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0" style="min-width: 500px;">
                    <div class="card shadow-sm">
                        <div class="card-header">Rekomendasi Lomba 3</div>
                        <div class="card-body text-center" style="font-size: 1.5rem;">
                            Konten Lomba 3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Table di bawah rekomendasi lomba --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    Ranking Mahasiswa
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                <tr>
                                    <td>1</td>
                                    <td>Budi Santoso</td>
                                    <td>12345678</td>
                                    <td>Teknik Informatika</td>
                                    <td>Juara 1 Lomba internasional - Cyber Security</td>
                                    <td>150</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Siti Aminah</td>
                                    <td>87654321</td>
                                    <td>Sistem Informasi</td>
                                    <td>Juara 2 Lomba Internasional - FrontEnd Dev</td>
                                    <td>120</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Andi Wijaya</td>
                                    <td>11223344</td>
                                    <td>Teknik Elektro</td>
                                    <td>Juara 3 Lomba Internasional - Fullstack Dev</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Rina Marlina</td>
                                    <td>22334455</td>
                                    <td>Teknik Mesin</td>
                                    <td>Juara Harapan 1 Lomba Nasional - Robotik</td>
                                    <td>90</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Agus Pratama</td>
                                    <td>33445566</td>
                                    <td>Teknik Sipil</td>
                                    <td>Juara 1 Lomba Nasional - Konstruksi</td>
                                    <td>85</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Dewi Lestari</td>
                                    <td>44556677</td>
                                    <td>Arsitektur</td>
                                    <td>Juara 2 Lomba Nasional - Desain Bangunan</td>
                                    <td>80</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Fajar Nugroho</td>
                                    <td>55667788</td>
                                    <td>Teknik Kimia</td>
                                    <td>Juara 3 Lomba Nasional - Kimia Terapan</td>
                                    <td>75</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Lina Sari</td>
                                    <td>66778899</td>
                                    <td>Manajemen</td>
                                    <td>Juara 1 Lomba Regional - Bisnis Plan</td>
                                    <td>70</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Rizky Ramadhan</td>
                                    <td>77889900</td>
                                    <td>Akuntansi</td>
                                    <td>Juara 2 Lomba Regional - Audit</td>
                                    <td>65</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Salsa Bilqis</td>
                                    <td>88990011</td>
                                    <td>Ilmu Komunikasi</td>
                                    <td>Juara 3 Lomba Regional - Public Speaking</td>
                                    <td>60</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Yoga Prasetyo</td>
                                    <td>99001122</td>
                                    <td>Teknik Industri</td>
                                    <td>Juara Harapan 1 Lomba Nasional - Inovasi Produk</td>
                                    <td>55</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Putri Ayu</td>
                                    <td>10111213</td>
                                    <td>Teknik Lingkungan</td>
                                    <td>Juara 1 Lomba Nasional - Lingkungan Hidup</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>Bayu Saputra</td>
                                    <td>12131415</td>
                                    <td>Teknik Informatika</td>
                                    <td>Juara 2 Lomba Nasional - UI/UX Design</td>
                                    <td>45</td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td>Melati Kusuma</td>
                                    <td>13141516</td>
                                    <td>Sistem Informasi</td>
                                    <td>Juara 3 Lomba Nasional - Data Science</td>
                                    <td>40</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
