<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <i class="bx bxs-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SITATIB</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Items -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="bx bxs-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('siswa.index') }}">
            <i class="bx bxs-user"></i>
            <span>Siswa</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('kriteria.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kriteria.index') }}">
            <i class="bx bxs-category-alt"></i>
            <span>Kriteria</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('subkriteria.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('subkriteria.index') }}">
            <i class="bx bxs-category-alt"></i>
            <span>Sub Kriteria</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('pelanggaran.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pelanggaran.index') }}">
            <i class="bx bx-spreadsheet"></i>
            <span>Pelanggaran</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('sanksi.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('sanksi.index') }}">
            <i class="bx bx-spreadsheet"></i>
            <span>Jenis Sanksi</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('proses-smart') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('proses-smart') }}">
            <i class="bx bx-spreadsheet"></i>
            <span>Proses SMART</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
