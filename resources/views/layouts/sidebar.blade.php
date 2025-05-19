<div class="sidebar-header text-center">
    <div class="sidebar-brand text-center"><b>SIMPRES</b></div>
    <button class="btn btn-lg btn-primary me-10 sidebar-toggler d-none d-lg-block" type="button"
        data-coreui-toggle="unfoldable"
        onclick="document.querySelector('.sidebar').classList.toggle('sidebar-unfoldable')">
    </button>
</div>


<ul class="sidebar-nav">
    <li class="nav-title">Menu</li>

    {{-- Common menu items for all users --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->is('*/dashboard') ? 'active' : '' }}" href="/dashboard">
            <i class="nav-icon cil-home"></i> Beranda
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/Lomba/index">
            <i class="nav-icon cil-star"></i> Informasi Lomba
            @if(isset($newCompetitions) && $newCompetitions > 0)
                <span class="badge bg-primary ms-auto">NEW</span>
            @endif
        </a>
    </li>

    {{-- Administrator Menu Items --}}
    @if (session('level') == 'ADM')
        <li class="nav-item">
            <a class="nav-link" href="/manajemen-user">
                <i class="nav-icon cil-people"></i> Manajemen Pengguna
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/manajemen-lomba">
                <i class="nav-icon cil-star"></i> Manajemen Lomba
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/manajemen-periode">
                <i class="nav-icon cil-calendar"></i> Manajemen Periode
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/manajemen-presma">
                <i class="nav-icon cil-settings"></i> Manajemen Presma
            </a>
        </li>
    @endif

    {{-- Student Menu Items --}}
    @if (session('level') == 'DSN')
        <li class="nav-item">
            <a class="nav-link" href="/prestasi-mahasiswa">
                <i class="nav-icon cil-list"></i> Prestasi Mahasiswa
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/riwayat-prestasi">
                <i class="nav-icon cil-history"></i> Riwayat Prestasi
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/bimbingan">
                <i class="nav-icon cil-user"></i> Bimbingan
            </a>
        </li>
    @endif

    {{-- Lecturer Menu Items --}}
    @if (session('level') == 'MHS')
        <li class="nav-item">
            <a class="nav-link" href="/prestasi-mahasiswa">
                <i class="nav-icon cil-list"></i> Prestasi Mahasiswa
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/bimbingan-dosen">
                <i class="nav-icon cil-user"></i> Bimbingan Mahasiswa
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/verifikasi-prestasi">
                <i class="nav-icon cil-check"></i> Verifikasi Prestasi
            </a>
        </li>
    @endif
</ul>

<div class="sidebar-footer text-center d-flex align-items-center justify-content-center">
    <!-- Footer content here if needed -->
</div>