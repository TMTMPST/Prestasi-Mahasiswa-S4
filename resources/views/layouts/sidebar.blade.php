<div class="sidebar-header text-center">
    <div class="sidebar-brand text-center"><b>SIMPRES</b></div>
    <button class="btn btn-lg btn-primary me-10 sidebar-toggler d-none d-lg-block" type="button" data-coreui-toggle="unfoldable" onclick="document.querySelector('.sidebar').classList.toggle('sidebar-unfoldable')">
    </button>
</div>

<ul class="sidebar-nav">
    <li class="nav-title">Menu</li>

    {{-- Beranda --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->is('*/dashboard') ? 'active' : '' }}" href="/dashboard">
            <i class="nav-icon cil-home"></i> Beranda
        </a>
    </li>

    {{-- Informasi Lomba --}}
    <li class="nav-item">
        <a class="nav-link" href="/Lomba/index">
            <i class="nav-icon cil-star"></i> Informasi Lomba
            <span class="badge bg-primary ms-auto">NEW</span>
        </a>
    </li>

    {{-- Prestasi Mahasiswa --}}
    <li class="nav-item">
        <a class="nav-link" href="/prestasi-mahasiswa">
            <i class="nav-icon cil-list"></i> Prestasi Mahasiswa
        </a>
    </li>

    {{-- Riwayat Prestasi --}}
    <li class="nav-item">
        <a class="nav-link" href="/riwayat-prestasi">
            <i class="nav-icon cil-history"></i> Riwayat Prestasi
        </a>
    </li>

    {{-- Bimbingan --}}
    <li class="nav-item">
        <a class="nav-link" href="/bimbingan">
            <i class="nav-icon cil-user"></i> Bimbingan
        </a>
    </li>

    {{-- Manajemen Pengguna --}}
    <li class="nav-item">
        <a class="nav-link" href="/manajemen-user">
            <i class="nav-icon cil-people"></i> Manajemen Pengguna
        </a>
    </li>
    {{-- Manajemen Lomba --}}
    <li class="nav-item">
        <a class="nav-link" href="/manajemen-lomba">
            <i class="nav-icon cil-star"></i> Manajemen Lomba
        </a>
    </li>
    {{-- Manajemen Periode --}}
    <li class="nav-item">
        <a class="nav-link" href="/manajemen-periode">
            <i class="nav-icon cil-calendar"></i> Manajemen Periode
        </a>
    </li>
    {{-- Manajemen Presma --}}
    <li class="nav-item">
        <a class="nav-link" href="/manajemen-presma">
            <i class="nav-icon cil-settings"></i> Manajemen Presma
        </a>
    </li>
</ul>

<div class="sidebar-footer text-center d-flex align-items-center justify-content-center">
    <!-- Footer content here if needed -->
</div>
