{{-- filepath: d:\weblanjut\Prestasi-Mahasiswa-S4\resources\views\layouts\header.blade.php --}}
<style>
    .profile-dropdown {
        position: relative;
    }

    .profile-photo {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid var(--secondary);
        cursor: pointer;
        transition: all 0.3s ease;
        object-fit: cover;
    }

    .profile-photo:hover {
        border-color: var(--accent1);
        transform: scale(1.05);
    }

    .profile-initial {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--accent1));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid var(--secondary);
    }

    .profile-initial:hover {
        border-color: var(--accent1);
        transform: scale(1.05);
    }

    .profile-dropdown .dropdown-menu {
        min-width: 200px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
    }

    .profile-dropdown .dropdown-item {
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .profile-dropdown .dropdown-item i {
        margin-right: 0.75rem;
        width: 16px;
        text-align: center;
    }

    .profile-dropdown .dropdown-item:hover {
        background-color: var(--light-gray);
        padding-left: 2rem;
    }

    .profile-dropdown .dropdown-divider {
        margin: 0.5rem 0;
        border-top: 1px solid #e9ecef;
    }

    .user-info {
        padding: 1rem 1.5rem 0.5rem;
        border-bottom: 1px solid #e9ecef;
        margin-bottom: 0.5rem;
    }

    .user-name {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.25rem;
    }

    .user-role {
        font-size: 0.85rem;
        color: var(--gray);
    }
</style>

<a class="header-brand" href="#">
    <span style="color: var(--primary); font-weight: 700;">SIMPRES</span>
</a>

<ul class="header-nav">
    <li class="nav-item profile-dropdown dropdown">
        <a class="nav-link p-0 dropdown" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

            @if(isset($authUser) && $authUser->photo)
                <img src="{{ asset('storage/photos/' . $authUser->photo) }}" alt="Profile" class="profile-photo">
            @else
                <div class="profile-initial">
                    {{ isset($authUser) ? strtoupper(substr($authUser->nama ?? 'U', 0, 1)) : 'U' }}
                </div>
            @endif
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            @if(isset($authUser))
                <div class="user-info">
                    <div class="user-name">{{ $authUser->nama ?? 'User' }}</div>
                    <div class="user-role">
                        @if(isset($authLevel))
                            @if($authLevel == 'ADM') Administrator
                            @elseif($authLevel == 'DSN') Dosen
                            @elseif($authLevel == 'MHS') Mahasiswa
                                @else User
                            @endif
                        @endif
                    </div>
                </div>
            @endif

            @if(isset($authLevel))
                @if($authLevel == 'DSN')
                    <a class="dropdown-item" href="{{ route('dosen.profile.index') }}">
                        <i class="bi bi-person-gear"></i>Edit Profile
                    </a>
                @elseif($authLevel == 'MHS')
                    <a class="dropdown-item" href="{{ route('mahasiswa.profile.index') }}">
                        <i class="bi bi-person-gear"></i>Edit Profile
                    </a>
                @elseif($authLevel == 'ADM')
                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                        <i class="bi bi-person-gear"></i>Edit Profile
                    </a>
                @else
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person-gear"></i>Edit Profile
                    </a>
                @endif
            @endif

            <div class="dropdown-divider"></div>

            <form action="{{ route('logout') }}" method="POST" class="m-0" onsubmit="return confirmLogout()">
                @csrf
                <button type="submit" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right"></i>Logout
                </button>
            </form>
        </div>
    </li>
</ul>

<script>
    function confirmLogout() {
        return confirm('Apakah Anda yakin ingin logout?');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        const dropdown = document.querySelector('.profile-dropdown');
        const dropdownMenu = dropdown?.querySelector('.dropdown-menu');

        if (dropdown && !dropdown.contains(event.target)) {
            if (dropdownMenu?.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
            }
        }
    });
</script>