    <a class="header-brand" href="#">Sistem Prestasi Mahasiswa</a>
    <ul class="header-nav">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="headerDropdownMenuLink" role="button"
            data-coreui-toggle="dropdown" aria-expanded="false">
            Akun
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="headerDropdownMenuLink">
            <a class="dropdown-item" href="#">Photo</a>
            <a class="dropdown-item" href="#">Profile</a>
            
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Anda yakin ingin logout?')">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                    Logout
                </button>
            </form>
        </div>
    </li>
</ul>

