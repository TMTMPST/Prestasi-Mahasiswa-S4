<div class="sidebar-header text-center">
    <div class="sidebar-brand text-center"><b>SIMPRES</b></div>
    <button class="btn btn-lg btn-primary me-10 sidebar-toggler d-none d-lg-block" type="button" data-coreui-toggle="unfoldable" onclick="document.querySelector('.sidebar').classList.toggle('sidebar-unfoldable')">
    </button>
</div>

<ul class="sidebar-nav">
    <li class="nav-title">Menu</li>

    <li class="nav-item">
        <a class="nav-link active" href="#">
            <i class="nav-icon cil-home"></i> Beranda
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon cil-history"></i> Riwayat
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon cil-education"></i> Prestasi Mahasiswa
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon cil-star"></i> Informasi Lomba 
            <span class="badge bg-primary ms-auto">NEW</span>
        </a>
    </li>





    <li class="nav-item nav-group show">
        <a class="nav-link nav-group-toggle" href="#">
            <i class="nav-icon cil-puzzle"></i> Nav dropdown
        </a>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Nav dropdown item
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Nav dropdown item
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item mt-5">
        <a class="nav-link" href="https://coreui.io">
            <i class="nav-icon cil-cloud-download"></i> bang kerjain dong banggggg
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="https://coreui.io/pro/">
            <i class="nav-icon cil-layers"></i> ga ngerjain fix 
          
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://coreui.io/pro/">
            <i class="nav-icon cil-layers"></i> ga diajak presentasi
          
        </a>
    </li>
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;" onsubmit="return confirm('Anda yakin ingin logout?')">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-start w-100" style="text-decoration: none;">
                <i class="nav-icon cil-account-logout"></i> Logout
            </button>
        </form>
    </li>
    
</ul>


<div class="sidebar-footer text-center d-flex align-items-center justify-content-center">
    <!-- Footer content here if needed -->
</div>
