<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Diperbaiki: Ditambahkan user-scalable=no agar kontrol sentuh Pannellum di HP lebih stabil -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Virtual Tour Sekolah</title>

    <!-- Pannellum CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/vtur.css">
</head>

<body>

    <!-- Loading Screen -->
    <div id="tour-loading">
        <div class="loading-content">
            <!-- LOGO (Disamakan path-nya) -->
            <img src="images/logomawa.webp" alt="Logo Sekolah" class="loading-logo">

            <div class="school-name">SMK DHARMA SISWA SIDOARJO</div>

            <div class="loading-title" id="loading-title">
                Memuat Virtual Tour
            </div>

            <div class="loading-progress">
                <div id="loading-progress-bar" class="loading-progress-bar"></div>
            </div>

            <div class="loading-percent" id="loading-percent">0%</div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-logo" id="home-logo">
            <img src="images/logomawa.webp" alt="Logo Sekolah">
        </div>

        <button
            type="button"
            class="nav-toggle"
            id="nav-toggle"
            aria-label="Buka menu"
            aria-expanded="false"
            aria-controls="navbar-menu"
        >
            <span class="nav-toggle-bar"></span>
            <span class="nav-toggle-bar"></span>
            <span class="nav-toggle-bar"></span>
        </button>

        <div class="navbar-menu" id="navbar-menu">
            <div class="nav-item">
                <a href="/" class="nav-link">Beranda</a>
            </div>

            <div class="nav-item has-dropdown">
                <button
                    type="button"
                    class="nav-link nav-dropdown-toggle"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <span>Lantai 1</span>
                    <span class="nav-caret"></span>
                </button>
                <ul class="nav-dropdown" data-dropdown="lantai1"></ul>
            </div>

            <div class="nav-item has-dropdown">
                <button
                    type="button"
                    class="nav-link nav-dropdown-toggle"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <span>Lantai 2</span>
                    <span class="nav-caret"></span>
                </button>
                <ul class="nav-dropdown" data-dropdown="lantai2"></ul>
            </div>

            <div class="nav-item has-dropdown">
                <button
                    type="button"
                    class="nav-link nav-dropdown-toggle"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <span>Lantai 3</span>
                    <span class="nav-caret"></span>
                </button>
                <ul class="nav-dropdown" data-dropdown="lantai3"></ul>
            </div>
        </div>
    </nav>

    <!-- Panorama Container -->
    <div id="panorama"></div>

    <!-- Virtual Tour JavaScript -->
    <script src="js/vtur.js"></script>

</body>
</html>