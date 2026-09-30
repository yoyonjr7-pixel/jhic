<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"

>

<title>
    @yield('title', 'Dashboard Admin')
</title>

<!-- ================================= -->

<!-- BOOTSTRAP -->

<!-- ================================= -->

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

<!-- ================================= -->

<!-- BOOTSTRAP ICONS -->

<!-- ================================= -->

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

<!-- ================================= -->

<!-- ADMIN CSS -->

<!-- ================================= -->

<link
    rel="stylesheet"
    href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}"
>

</head>

<body>

<div class="d-flex">

<!-- ========================================= -->

<!-- SIDEBAR -->

<!-- ========================================= -->

<aside class="sidebar">

<!-- ================================= -->
<!-- BRAND -->
<!-- ================================= -->

<div class="sidebar-header">

    <div>

        <h5 class="mb-1">
            ADMIN
        </h5>

        <small>
            SMK DARMA SISWA 1 SIDOARJO
        </small>

    </div>

</div>


<!-- ================================= -->
<!-- MENU -->
<!-- ================================= -->

<nav class="sidebar-menu">


    <!-- DASHBOARD -->

    <a
        href="{{ route('dashboard') }}"
        class="menu-item {{ request()->routeIs('dashboard', 'admin.dashboard') ? 'active' : '' }}"
    >

        <i class="bi bi-grid-1x2-fill"></i>

        <span>
            Dashboard
        </span>

    </a>


    <!-- MENTORING -->

    <a
        href="{{ route('admin.mentoring') }}"
        class="menu-item {{ request()->routeIs('admin.mentoring') ? 'active' : '' }}"
    >

        <i class="bi bi-briefcase-fill"></i>

        <span>
            Mentoring
        </span>

    </a>


    <!-- ALUMNI TRACK -->

    <a
        href="{{ route('admin.alumni-track') }}"
        class="menu-item {{ request()->routeIs('admin.alumni-track', 'admin.module', 'admin.module.*') && request()->route('type') === 'alumni' ? 'active' : '' }}"
    >

        <i class="bi bi-mortarboard-fill"></i>

        <span>
            Alumni Track
        </span>

    </a>


    <!-- TEFA ONLINE -->

    <a
        href="{{ route('admin.tefa-online') }}"
        class="menu-item {{ (request()->routeIs('admin.tefa-online', 'admin.tefa.*') || (request()->routeIs('admin.module', 'admin.module.*') && request()->route('type') === 'tefa')) ? 'active' : '' }}"
    >

        <i class="bi bi-shop"></i>

        <span>
            TEFA Online
        </span>

    </a>


    <!-- PRESTASI -->

    <a
        href="{{ route('admin.module', 'prestasi') }}"
        class="menu-item {{ request()->routeIs('admin.module', 'admin.module.*') && request()->route('type') === 'prestasi' ? 'active' : '' }}"
    >

        <i class="bi bi-trophy-fill"></i>

        <span>
            Prestasi
        </span>

    </a>


    <!-- BERITA TERBARU -->

    <a
        href="{{ route('admin.module', 'berita') }}"
        class="menu-item {{ request()->routeIs('admin.module', 'admin.module.*') && request()->route('type') === 'berita' ? 'active' : '' }}"
    >

        <i class="bi bi-newspaper"></i>

        <span>
            Berita Terbaru
        </span>

    </a>


    <!-- UNDuh INFORMASI -->

    <a
        href="{{ route('admin.module', 'unduh-informasi') }}"
        class="menu-item {{ request()->routeIs('admin.module', 'admin.module.*') && request()->route('type') === 'unduh-informasi' ? 'active' : '' }}"
    >

        <i class="bi bi-cloud-arrow-down-fill"></i>

        <span>
            Unduh Informasi
        </span>

    </a>


</nav>


<!-- ================================= -->
<!-- SIDEBAR FOOTER -->
<!-- ================================= -->

<div class="sidebar-footer">


    <div class="sidebar-footer-icon">

        <i class="bi bi-shield-check"></i>

    </div>


    <div>

        <small>
            Sistem Admin
        </small>

    </div>


</div>


<!-- ================================= -->
<!-- LOGOUT -->
<!-- ================================= -->

<div class="px-3 pb-3">

    <form
        action="{{ route('logout') }}"
        method="POST"
    >

        @csrf

        <button
            type="submit"
            class="btn btn-outline-danger w-100"
        >

            <i class="bi bi-box-arrow-right me-2"></i>

            Logout

        </button>

    </form>

</div>

</aside>

<!-- ========================================= -->

<!-- MAIN CONTENT -->

<!-- ========================================= -->

<div class="main-content">

<!-- ================================= -->
<!-- NAVBAR -->
<!-- ================================= -->

<nav class="navbar admin-navbar">


    <div>

        <h5 class="admin-page-title mb-1">

            @yield('page-title', 'Dashboard')

        </h5>


        <small class="text-muted">

            Sistem Manajemen Sekolah

        </small>

    </div>


    <div class="d-flex align-items-center gap-3">


        <!-- NOTIFICATION -->

        <button
            class="notification-btn"
            type="button"
            title="Notifikasi"
        >

            <i class="bi bi-bell"></i>

            <span class="notification-dot"></span>

        </button>


        <!-- ================================= -->
        <!-- ADMIN PROFILE -->
        <!-- ================================= -->

        <div class="admin-profile">


            <!-- AVATAR -->

            <div class="admin-avatar">

                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}

            </div>


            <!-- INFO -->

            <div class="admin-profile-info">

                <div class="admin-name">

                    {{ Auth::user()->name ?? 'Admin' }}

                </div>


                <div class="admin-role">

                    Administrator

                </div>

            </div>


            <!-- DROPDOWN ICON -->

            <i
                class="bi bi-chevron-down d-none d-md-block"
                style="font-size: 11px; color: #98a2b3;"
            ></i>


        </div>


    </div>


</nav>


<!-- ================================= -->
<!-- PAGE CONTENT -->
<!-- ================================= -->

<main class="content-area">

    @yield('content')

</main>

</div>

</div>

<!-- ================================= -->

<!-- BOOTSTRAP JS -->

<!-- ================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>


