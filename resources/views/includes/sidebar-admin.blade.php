<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('admin/image/kimia-farma.jpeg') }}" style="height: 20vh; object-fit:contain;"
                    alt="">
            </div>
            {{-- <!-- Sidenav Menu Heading (Account)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Link (Alerts)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Alerts
                <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
            </a>
            <!-- Sidenav Link (Messages)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Messages
                <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
            </a> --}}


            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading mt-0">Menu</div>
            <!-- Sidenav Link (Dashboard)-->
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                href="{{ route('admin-dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>

            @can('Admin')
                <a class="nav-link {{ request()->is('admin/department*') ? 'active' : '' }}"
                    href="{{ route('department.index') }}">
                    <div class="nav-link-icon"><i data-feather="home"></i></div>
                    Data Produk
                </a>
            @endcan


            {{-- @can('Admin')
                <a class="nav-link {{ request()->is('admin/letter/create') ? 'active' : '' }}"
                    href="{{ route('letter.create') }}">
                    <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                    Tambah Arsip
                </a>
            @endcan --}}

            @can('Admin')
                <a class="nav-link {{ request()->is('admin/letter/arsip') ? 'active' : '' }}" href="{{ route('arsip') }}">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Arsip
                </a>
            @endcan
            {{-- <a class="nav-link {{ request()->is('admin/batch-record/create') ? 'active' : '' }}"
                href="{{ route('batch.create') }}">
                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                Tambah Batch Record
            </a> --}}

            <a class="nav-link {{ request()->is('admin/letter/batch-record') ? 'active' : '' }}"
                href="{{ route('batch') }}">
                <div class="nav-link-icon"><i data-feather="box"></i></div>
                Batch Record
            </a>

            @can('Admin')
                <a class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <div class="nav-link-icon"><i data-feather="user"></i></div>
                    Data User
                </a>
            @endcan


            <a class="nav-link {{ request()->is('admin/setting*') ? 'active' : '' }}"
                href="{{ route('setting.index') }}">
                <div class="nav-link-icon"><i data-feather="settings"></i></div>
                Profile
            </a>
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>
