<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SMK Darma Siswa</title>

    {{-- CSS Navbar --}}
    <link rel="stylesheet" href="/css/navbar.css">

    {{-- Tempat CSS tambahan dari halaman --}}
    @yield('styles')
</head>

<body>

    <header class="site-header">

        {{-- Top Section: Logo & Hamburger Toggle --}}
        <div class="header-top">

            <div class="header-container">

                <div class="logo-group">
                    <img
                        src="{{ asset('images/logomawa.webp') }}"
                        alt="Logo SMK Darma Siswa"
                        class="logo-img"
                    >
                </div>

                <!-- Tombol Hamburger (Warna Kuning di Mobile) -->
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>

            </div>

        </div>

        {{-- Bottom Section: Menu Navigasi --}}
        <nav class="navbar-menu" id="navbarMenu">

            <div class="header-container">

                <ul class="menu-list">

                    <li class="menu-item">
                        <a href="/" class="menu-link">HOME</a>
                    </li>

                    <li class="menu-item has-dropdown" id="dropdownTentang">
                        <a href="#" class="menu-link nav-dropdown-trigger" id="toggleTentang">
                            <span>TENTANG SEKOLAH</span>
                            <svg
                                class="dropdown-icon"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-link">Prestasi Sekolah</a></li>
                            <li><a href="#" class="dropdown-link">Fasilitas Sekolah</a></li>
                            <li><a href="#" class="dropdown-link">Profil Guru</a></li>
                            <li><a href="#" class="dropdown-link">Visi &amp; Misi</a></li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">JURUSAN & KARIR</a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">ALUMNI TRACK</a>
                    </li>

                    <li class="menu-item">
                        <a href="/tefa" class="menu-link">TEFA ONLINE</a>
                    </li>

                    <li class="menu-item">
                        <a href="/virtualtour" class="menu-link">SCHOOL TOUR</a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">PPDB</a>
                    </li>

                    <li class="menu-item btn-item">
                        <a
                            href="{{ asset('files/informasi.pdf') }}"
                            target="_blank"
                            class="btn-download"
                        >
                            UNDUH INFORMASI
                        </a>
                    </li>

                </ul>

            </div>

        </nav>

    </header>

    {{-- KONTEN HALAMAN --}}
    <main>
        @yield('content')
    </main>

    {{-- Script JavaScript Navigasi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menuToggle');
            const navbarMenu = document.getElementById('navbarMenu');
            const dropdownTentang = document.getElementById('dropdownTentang');
            const toggleTentang = document.getElementById('toggleTentang');

            // 1. Buka/Tutup Menu Utama di Mobile
            menuToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                navbarMenu.classList.toggle('active');
                menuToggle.classList.toggle('active');
            });

            // 2. Buka/Tutup Sub-Menu "TENTANG SEKOLAH" di Mobile
            toggleTentang.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropdownTentang.classList.toggle('is-open');
                }
            });

            // 3. Menutup Menu Saat Klik di Luar Area Navbar
            document.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    if (!navbarMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                        navbarMenu.classList.remove('active');
                        menuToggle.classList.remove('active');
                        dropdownTentang.classList.remove('is-open');
                    }
                }
            });
        });
    </script>

    @yield('scripts')

</body>

</html>