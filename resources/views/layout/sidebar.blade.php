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

            <!--Kelola Pengguna-->
            <li class="nav-item {{ Request::is('pengguna*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pengguna.index') }}">
                    <i class="fas fa-users-gear"></i></i> <span>Kelola Pengguna</span>
                </a>
            </li>

        @show
    </ul>


</aside>
