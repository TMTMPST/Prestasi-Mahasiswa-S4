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
    @if (session('level') == 'DSN') 
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dosen/dashboard') ? 'active' : '' }}" href="/dosen/dashboard">
                <i class="nav-icon cil-home"></i> Beranda
            </a>
        </li>
    @elseif (session('level') == 'MHS')
        <li class="nav-item">
            <a class="nav-link {{ request()->is('mahasiswa/dashboard') ? 'active' : '' }}" href="/mahasiswa/dashboard">
                <i class="nav-icon cil-home"></i> Beranda
            </a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
                <i class="nav-icon cil-home"></i> Beranda
            </a>
        </li>
    @endif

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
            <a class="nav-link" href="/Presma/index">
                <i class="nav-icon cil-settings"></i> Manajemen Presma
            </a>
        </li>
    @endif

    {{-- Student Menu Items --}}
    @if (session('level') == 'DSN')
        <li class="nav-item">
            <a class="nav-link" href="/Presma/index">
                <i class="nav-icon cil-list"></i> Prestasi Mahasiswa
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/Bimbingan/index">
                <i class="nav-icon cil-user"></i> Bimbingan
            </a>
        </li>
    @endif

    {{-- Lecturer Menu Items --}}
    @if (session('level') == 'MHS')
        <li class="nav-item">
            <a class="nav-link" href="/prestasi/index">
                <i class="nav-icon cil-list"></i> Prestasi Mahasiswa
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/bimbingan/index">
                <i class="nav-icon cil-user"></i> Bimbingan Mahasiswa
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/verifikasi/index">
                <i class="nav-icon cil-check"></i> Verifikasi Prestasi
            </a>
        </li>
    @endif
</ul>

<div class="sidebar-footer text-center d-flex align-items-center justify-content-center">
    <!-- Footer content here if needed -->
</div>