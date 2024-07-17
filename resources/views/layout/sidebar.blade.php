<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}">RJ Tiket</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">RJ</a>
    </div>

    <ul class="sidebar-menu">
        @section('sidebar')
            <li class="menu-header">Menu</li>

            <!--Beranda-->
            <li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-house"></i> <span>Beranda</span>
                </a>
            </li>

            @can('admin-only')
                <!--Kelola Pengguna-->
                <li class="nav-item {{ Request::is('pengguna*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pengguna.index') }}">
                        <i class="fas fa-users-gear"></i></i> <span>Kelola Pengguna</span>
                    </a>
                </li>

                <!--Barang-->
                <li class="nav-item {{ Request::is('barang*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('barang.index') }}">
                        <i class="fas fa-box"></i></i> <span>Daftar Barang</span>
                    </a>
                </li>
            @endcan

            <!--Pengajuan-->
            <li class="nav-item {{ Request::is('pengajuan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pengajuan.index') }}">
                    <i class="fas fa-file-invoice"></i></i> <span>Daftar Pengajuan</span>
                </a>
            </li>
            <!--Riwaayat Pengajuan-->
            <li class="nav-item {{ Request::is('riwayat-pengajuan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pengajuan.riwayat') }}">
                    <i class="fas fa-clock-rotate-left"></i></i> <span>Riwayat Pengajuan</span>
                </a>
            </li>

        @show
    </ul>


</aside>
