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
<link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">

</head>

<body>

<div class="d-flex">

<!-- ========================================= -->

<!-- SIDEBAR -->

<!-- ========================================= -->

<aside class="sidebar" id="admin-sidebar">

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
        href="/dashboard"
        class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}"
    >

        <i class="bi bi-grid-1x2-fill"></i>

        <span>
            Dashboard
        </span>

    </a>

    <!-- DATA SISWA -->

    <a
        href="{{ route('siswa.index') }}"
        class="menu-item {{ request()->is('siswa*') ? 'active' : '' }}"
    >

        <i class="bi bi-people-fill"></i>

        <span>
            Data Siswa
        </span>

    </a>


    <!-- MENTORING -->

    <a
        href="{{ route('mentoring.index') }}"
        class="menu-item {{ request()->is('mentoring*') ? 'active' : '' }}"
    >

        <i class="bi bi-briefcase-fill"></i>

        <span>
            Mentoring
        </span>

    </a>

    <!-- PENDAFTAR SPMB -->

    <a
        href="{{ route('spmb-pendaftar.index') }}"
        class="menu-item {{ request()->is('spmb-pendaftar*') ? 'active' : '' }}"
    >

        <i class="bi bi-person-vcard-fill"></i>

        <span>
            Pendaftar SPMB
        </span>

    </a>


    <!-- ALUMNI TRACK -->

    <a
        href="/alumni-track"
        class="menu-item {{ request()->is('alumni-track') ? 'active' : '' }}"
    >

        <i class="bi bi-mortarboard-fill"></i>

        <span>
            Alumni Track
        </span>

    </a>

    <!-- LOWONGAN PEKERJAAN -->

    <a
        href="{{ route('lowongan.index') }}"
        class="menu-item {{ request()->is('lowongan-pekerjaan*') ? 'active' : '' }}"
    >

        <i class="bi bi-briefcase"></i>

        <span>
            Lowongan Pekerjaan
        </span>

    </a>


    <!-- TEFA ONLINE -->

    <a
        href="/tefa-online"
        class="menu-item {{ request()->is('tefa-online*') ? 'active' : '' }}"
    >

        <i class="bi bi-shop"></i>

        <span>
            TEFA Online
        </span>

    </a>


    <!-- PRESTASI -->

    <a
        href="{{ route('prestasi.index') }}"
        class="menu-item {{ request()->is('admin/prestasi*') ? 'active' : '' }}"
    >

        <i class="bi bi-trophy-fill"></i>

        <span>
            Prestasi
        </span>

    </a>


    <!-- BERITA TERBARU -->

    <a
        href="{{ route('berita.index') }}"
        class="menu-item {{ request()->is('berita*') ? 'active' : '' }}"
    >

        <i class="bi bi-newspaper"></i>

        <span>
            Berita Terbaru
        </span>

    </a>


    <!-- UNDuh INFORMASI -->

    <a
        href="{{ route('unduh-informasi.index') }}"
        class="menu-item {{ request()->is('unduh-informasi*') ? 'active' : '' }}"
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

<button
    type="button"
    class="sidebar-overlay"
    aria-label="Tutup menu navigasi"
    tabindex="-1"
></button>

<!-- ========================================= -->

<!-- MAIN CONTENT -->

<!-- ========================================= -->

<div class="main-content">

<!-- ================================= -->
<!-- NAVBAR -->
<!-- ================================= -->

<nav class="navbar admin-navbar">


    <div class="d-flex align-items-center gap-3">

        <button
            type="button"
            class="admin-sidebar-toggle"
            aria-label="Buka menu navigasi"
            aria-controls="admin-sidebar"
            aria-expanded="false"
        >
            <i class="bi bi-list"></i>
        </button>

        <div>

            <h5 class="admin-page-title mb-1">

                @yield('page-title', 'Dashboard')

            </h5>


            <small class="text-muted">

                Sistem Manajemen Sekolah

            </small>

        </div>
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

<script>
    (() => {
        const sidebar = document.querySelector('.sidebar');
        const toggle = document.querySelector('.admin-sidebar-toggle');
        const overlay = document.querySelector('.sidebar-overlay');

        if (!sidebar || !toggle || !overlay) {
            return;
        }

        const closeSidebar = () => {
            document.body.classList.remove('sidebar-open');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.setAttribute('aria-label', 'Buka menu navigasi');
        };

        toggle.addEventListener('click', () => {
            const isOpen = document.body.classList.toggle('sidebar-open');
            toggle.setAttribute('aria-expanded', String(isOpen));
            toggle.setAttribute(
                'aria-label',
                isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'
            );
        });

        overlay.addEventListener('click', closeSidebar);

        sidebar.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeSidebar);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });
    })();
</script>

</body>

</html>
