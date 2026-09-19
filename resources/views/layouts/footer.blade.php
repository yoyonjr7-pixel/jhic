<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Footer</title>

    <link rel="stylesheet" href="/css/footer.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
</head>

<body>

<footer class="site-footer">

    <div class="footer-container">

        {{-- =========================================
             KOLOM 1 - IDENTITAS SEKOLAH
        ========================================== --}}

        <div class="footer-school">

            {{-- LOGO --}}
            <div class="footer-logo">

                <img
                    src="/images/logomawa.webp"
                    alt="Logo SMK Darma Siswa"
                >

            </div>


            {{-- DESKRIPSI --}}
            <p class="footer-description">

                Bersama SMK Darma Siswa Sidoarjo, jadilah generasi emas,
                berakhlak, dan inovatif.

            </p>


            {{-- =========================================
                 CONTACT
            ========================================== --}}

            <div class="footer-contact">


                {{-- EMAIL --}}
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>

                    <div class="contact-content">

                        <span class="contact-label">
                            Email
                        </span>

                        <a href="mailto:smkdarmasiswa1sidoarjo@gmail.com">
                            smkdarmasiswa1sidoarjo@gmail.com
                        </a>

                    </div>

                </div>


                {{-- TELEPON --}}
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>

                    <div class="contact-content">

                        <span class="contact-label">
                            Telepon
                        </span>

                        <a href="tel:0983982871289812873">
                            0983-98287128-9812873
                        </a>

                    </div>

                </div>


                {{-- ALAMAT --}}
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>

                    <div class="contact-content">

                        <span class="contact-label">
                            Alamat
                        </span>

                        <span class="contact-address">
                            Jl. Kusuma No. 9-11, Berbek, Kec. Waru,
                            Kabupaten Sidoarjo, Jawa Timur 61256
                        </span>

                    </div>

                </div>


            </div>


            {{-- =========================================
                 SOCIAL MEDIA
            ========================================== --}}

            <div class="footer-social">

                <a href="https://facebook.com"
                class="social-icon facebook"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Facebook">

                    <i class="bi bi-facebook"></i>

                </a>


                <a href="https://www.instagram.com/dyounxzz/?next=%2F"
                class="social-icon instagram"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Instagram">

                    <i class="bi bi-instagram"></i>

                </a>


                <a href="https://tiktok.com"
                class="social-icon tiktok"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="TikTok">

                    <i class="bi bi-tiktok"></i>

                </a>


                <a href="https://whatsapp.com"
                class="social-icon whatsapp"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="WhatsApp">

                    <i class="bi bi-whatsapp"></i>

                </a>

            </div>

        </div>
        {{-- <<< PENUTUP .footer-school (INI YANG TADI HILANG) --}}


        {{-- =========================================
             KOLOM 2 - MENU UTAMA
        ========================================== --}}

        <div class="footer-menu">

            <h3>MENU UTAMA :</h3>

            <ul>

                <li>
                    <a href="/">Beranda</a>
                </li>

                <li>
                    <a href="#">Tentang sekolah</a>
                </li>

                <li>
                    <a href="#">Program keahlian</a>
                </li>

                <li>
                    <a href="#">Karir</a>
                </li>

                <li>
                    <a href="#">Alumni</a>
                </li>

                <li>
                    <a href="/tefa">Tefa online</a>
                </li>

                <li>
                    <a href="/virtualtour">School tour</a>
                </li>

                <li>
                    <a href="#">Unduh informasi</a>
                </li>

            </ul>

        </div>


        {{-- =========================================
             KOLOM 3 - BERITA SEKOLAH
        ========================================== --}}

        <div class="footer-news">

            <h3>BERITA SEKOLAH :</h3>

            <ul>

                <li>
                    <a href="#">Kegiatan sekolah</a>
                </li>

                <li>
                    <a href="#">Prestasi</a>
                </li>

                <li>
                    <a href="#">Pengumuman</a>
                </li>

                <li>
                    <a href="#">Karya & inovasi siswa</a>
                </li>

                <li>
                    <a href="#">Artikel</a>
                </li>

            </ul>


            {{-- =========================================
                 LOKASI
            ========================================== --}}

            <div class="footer-location">

                <h3>LOKASI SEKOLAH :</h3>

                <div class="map-container">

                    <iframe
                        src="https://www.google.com/maps?q=SMK%20Darma%20Siswa%201%20Sidoarjo&output=embed"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================
         COPYRIGHT
    ========================================== --}}

    <div class="footer-bottom">

        <p>
            © {{ date('Y') }} SMK Darma Siswa Sidoarjo.
            All Rights Reserved.
        </p>

    </div>

</footer>

</body>
</html>