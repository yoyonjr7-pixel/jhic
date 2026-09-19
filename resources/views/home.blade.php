@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="css/home.css">

{{-- HALAMAN UTAMA --}}
<div class="home-page">

    {{-- Background Overlay --}}
    <div class="background-overlay"></div>

    {{-- Judul --}}
    <div class="welcome-title">
        <h1>SELAMAT DATANG DI</h1>
        <h2>SMK - SMK DARMA SISWA 1 & 2 SIDOARJO</h2>
    </div>

    {{-- Search --}}
    <div class="search-container">
        <input
            type="text"
            id="searchInput"
            placeholder="Apa yang anda cari?"
        >
        <button
            type="button"
            onclick="searchWebsite()"
        >
            <span class="search-icon">⌕</span>
            <span>Search</span>
        </button>
    </div>

    {{-- Bagian Sambutan Kepala Sekolah --}}
    <div class="principal-section">

        {{-- Card Foto Kepala Sekolah --}}
        <div class="principal-card">
            <div class="principal-img-wrapper">
                <img
                    src="profilguru/argociptononobg.png"
                    alt="Kepala Sekolah SMK Darma Siswa 1"
                    class="principal-img"
                >
            </div>

            <div class="principal-info-overlay">
                <h4 class="principal-name">Argo Ciptono, S.Kom, ST, MM.</h4>
                <p class="principal-title">Kepala Sekolah SMK Darma Siswa 1</p>
            </div>
        </div>

        {{-- Card Teks Sambutan --}}
        <div class="speech-card">
            <h3>
                Sambutan Kepala Sekolah SMK Darma Siswa 1 Sidoarjo
            </h3>

            <p class="greeting">
                Assalamu’alaikum Wr. Wb.
            </p>

            <p>
                Selamat datang di SMK Darma Siswa 1 & 2 Sidoarjo, sekolah kejuruan yang senantiasa berkomitmen untuk menjadi wadah terbaik bagi generasi muda dalam bertumbuh, mengasah potensi, dan membekali diri menghadapi tantangan masa depan.
            </p>

            <p>
                Dengan semangat inovasi dan dedikasi tinggi, kami menghadirkan lingkungan belajar yang kondusif, berkarakter, serta berorientasi pada kebutuhan dunia industri demi mencetak lulusan yang unggul dan siap kerja.
            </p>
        </div>

    </div>

</div>

<!-- BAGIAN INFORMASI & AKREDITASI -->
<div class="informasi-section">
    
    <div class="informasi-container">
        
        <!-- Header / Judul -->
        <div class="info-header">
            <h2 class="info-subtitle">Informasi</h2>
            <h1 class="info-title">SMK Darma Siswa 1 & 2 Sidoarjo</h1>
            <p class="info-address">
                Jl. Kusuma No.9-11, Berbek, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256
            </p>
        </div>

        <!-- Badge Akreditasi & NPSN -->
        <div class="accreditation-row">
            <div class="npsn-badge">
                <span class="label">NPSN MAWA 1</span>
                <span class="code">20540097</span>
            </div>

            <div class="akreditasi-badge">
                <h3>Akreditasi: A</h3>
            </div>

            <div class="npsn-badge">
                <span class="label">NPSN MAWA 2</span>
                <span class="code">20540082</span>
            </div>
        </div>

        <!-- Grid Statistik -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="507">0</span> +
                </div>
                <div class="stat-label">Jumlah Siswa/i<br>SMK Mawa 1</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="418">0</span> +
                </div>
                <div class="stat-label">Jumlah Siswa/i<br>SMK Mawa 2</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="40">0</span> +
                </div>
                <div class="stat-label">Fasilitas<br>Tersedia</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="60">0</span> +
                </div>
                <div class="stat-label">Jumlah Guru<br>& Staff</div>
            </div>
        </div>

    </div>

</div>

<!-- BAGIAN INDUSTRY COLLABORATION -->
<div class="industry-section">
    <div class="industry-container">
        
        <div class="industry-badge-wrapper">
            <div class="industry-badge">
                <h2>Industry Collaboration</h2>
            </div>
        </div>

        <div class="industry-grid">
            <div class="industry-card"><img src="industryimages/polygon.png" alt="Polygon"></div>
            <div class="industry-card"><img src="industryimages/kazumi.png" alt="Kazumi"></div>
            <div class="industry-card"><img src="industryimages/eta.png" alt="E-T-A"></div>
            <div class="industry-card"><img src="industryimages/astracom.png" alt="Astracom"></div>
            <div class="industry-card"><img src="industryimages/bumn.png" alt="BUMN"></div>
            <div class="industry-card"><img src="industryimages/astrainternational.png" alt="Astra"></div>
            <div class="industry-card"><img src="industryimages/kawai.png" alt="Kawai"></div>
            <div class="industry-card"><img src="industryimages/suzuki.png" alt="Suzuki"></div>
            <div class="industry-card"><img src="industryimages/bndtransformer.png" alt="B&D"></div>
            <div class="industry-card"><img src="industryimages/siantartop.png" alt="Siantar Top"></div>
        </div>

    </div>
</div>

<!-- BAGIAN TEFA ONLINE -->
<div class="tefa-section">
    <div class="tefa-content">
        <div class="badge-tefa">TEFA ONLINE</div>
        <h2 class="tefa-title">
            BELAJAR, BERPRODUKSI,<br>
            <span class="highlight">BERKOMPETENSI</span>
        </h2>
        <p class="tefa-desc">
            Layanan dikerjakan oleh siswa kompeten dibawah bimbingan guru berpengalaman dengan standar industri.
        </p>
        <a href="/tefa" class="btn-book">Book Now !</a>
    </div>
</div>

<!-- BAGIAN PRESTASI SISWA -->
<div class="achievement-section">
    <div class="achievement-container">
        
        <div class="achievement-header">
            <h2>PRESTASI SISWA</h2>
            <p>Smk Darma Siswa 1 Sidoarjo</p>
        </div>

        <div class="achievement-grid">
            
            <!-- Card 1 -->
            <div class="achievement-card">
                <div class="achievement-img-wrapper">
                    <img src="prestasiimages/lombapostersefest.jpg" alt="Juara 2 Lomba Poster">
                </div>
                <div class="achievement-info">
                    <div class="achievement-badge-title">JUARA 2 LOMBA POSTER</div>
                    <div class="achievement-badge-desc">Siswa kelas XI TJKT menjadi juara 2 lomba poster di sefest</div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="achievement-card">
                <div class="achievement-img-wrapper">
                    <img src="prestasiimages/lombaposterpsycoreels.png" alt="Juara 3 Lomba Psycoreels">
                </div>
                <div class="achievement-info">
                    <div class="achievement-badge-title">JUARA 3 LOMBA PSYCOREELS</div>
                    <div class="achievement-badge-desc">Siswa kelas XI SMA menjadi juara 3 lomba poster di psycoreels</div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="achievement-card">
                <div class="achievement-img-wrapper">
                    <img src="prestasiimages/lombafotografisidoarjo.png" alt="Juara 1 Lomba Fotografi">
                </div>
                <div class="achievement-info">
                    <div class="achievement-badge-title">JUARA 1 LOMBA FOTOGRAFI</div>
                    <div class="achievement-badge-desc">Siswa kelas XII multimedia menjadi juara 1 lomba street fotografi se-Kabupaten Sidoarjo</div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="achievement-card">
                <div class="achievement-img-wrapper">
                    <img src="prestasiimages/lombavlogsurabaya.png" alt="Juara 2 Lomba Vlog">
                </div>
                <div class="achievement-info">
                    <div class="achievement-badge-title">JUARA 2 LOMBA VLOG</div>
                    <div class="achievement-badge-desc">Siswa kelas X dan XI SMA menjadi juara 2 lomba vlog tingkat se-Surabaya</div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="achievement-card">
                <div class="achievement-img-wrapper">
                    <img src="prestasiimages/lombavloggerbangkertasusila.png" alt="Juara Favorit Lomba Vlog Fotografi">
                </div>
                <div class="achievement-info">
                    <div class="achievement-badge-title">JUARA FAVORIT LOMBA VLOG FOTOGRAFI</div>
                    <div class="achievement-badge-desc">Siswa kelas XII multimedia menjadi juara favorit lomba fotografi tingkat GERBANGKERTASUSILA</div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="achievement-card">
                <div class="achievement-img-wrapper">
                    <img src="prestasiimages/lombapencaksilatalfin.jpg" alt="Juara 3 Lomba Pencak Silat">
                </div>
                <div class="achievement-info">
                    <div class="achievement-badge-title">JUARA 3 LOMBA PENCAK SILAT</div>
                    <div class="achievement-badge-desc">Siswa kelas XII TKJ menjadi juara 3 lomba pencak silat</div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- BAGIAN EKSTRAKULIKULER -->
<div class="extracurricular-section">
    <div class="extracurricular-container">

        <h2 class="extracurricular-title">Ekstrakulikuler</h2>

        <div class="extracurricular-grid">

            <!-- Card 1: PMR -->
            <div class="extracurricular-card">
                <div class="extracurricular-icon-wrapper">
                    <img src="ekstrakulikuler/pmr.png" alt="PMR">
                </div>
                <span class="extracurricular-name">PMR</span>
            </div>

            <!-- Card 2: BASKET -->
            <div class="extracurricular-card">
                <div class="extracurricular-icon-wrapper">
                    <img src="ekstrakulikuler/basket.png" alt="BASKET">
                </div>
                <span class="extracurricular-name">BASKET</span>
            </div>

            <!-- Card 3: FUTSAL -->
            <div class="extracurricular-card">
                <div class="extracurricular-icon-wrapper">
                    <img src="ekstrakulikuler/futsal.png" alt="FUTSAL">
                </div>
                <span class="extracurricular-name">FUTSAL</span>
            </div>

            <!-- Card 4: BANJARI -->
            <div class="extracurricular-card">
                <div class="extracurricular-icon-wrapper">
                    <img src="ekstrakulikuler/banjari.png" alt="BANJARI">
                </div>
                <span class="extracurricular-name">BANJARI</span>
            </div>

        </div>

    </div>
</div>

<!-- BAGIAN BERITA TERBARU -->
<div class="news-section">
    <div class="news-container">

        <div class="news-header">
            <h2>Berita Terbaru</h2>
            <p>SMK Darma Siswa 1 Sidoarjo</p>
        </div>

        <div class="news-layout">

            <div class="news-grid" id="newsGrid">

                <!-- Card 1 -->
                <article class="news-card" data-category="kegiatan">
                    <div class="news-img-wrapper">
                        <img
                            src="beritaimages/masuksekolahtahunpelajaran.jpg"
                            alt="Masuk Sekolah Tahun Pelajaran 2025 - 2026"
                            data-title="Masuk Sekolah"
                            onerror="newsImageFallback(this)"
                        >
                    </div>
                    <div class="news-body">
                        <h3 class="news-title">Masuk Sekolah Tahun Pelajaran 2025 - 2026</h3>
                        <div class="news-meta">
                            <span>July 2, 2025</span>
                            <span class="news-dot">&bull;</span>
                            <span>4 Comments</span>
                        </div>
                    </div>
                </article>

                <!-- Card 2 -->
                <article class="news-card" data-category="kegiatan">
                    <div class="news-img-wrapper">
                        <img
                            src="beritaimages/pelepasansiswa2024-2025.jpg"
                            alt="Pelepasan Siswa Smk Darma Siswa Sidoarjo 2024 - 2025"
                            data-title="Pelepasan Siswa"
                            onerror="newsImageFallback(this)"
                        >
                    </div>
                    <div class="news-body">
                        <h3 class="news-title">Pelepasan Siswa Smk Darma Siswa Sidoarjo 2024 - 2025</h3>
                        <div class="news-meta">
                            <span>May 26, 2025</span>
                            <span class="news-dot">&bull;</span>
                            <span>2 Comments</span>
                        </div>
                    </div>
                </article>

                <!-- Card 3 -->
                <article class="news-card" data-category="artikel">
                    <div class="news-img-wrapper">
                        <img
                            src="beritaimages/caramenghitungpajak.jpg"
                            alt="Cara Menghitung Pajak Dalam Transaksi bisnis"
                            data-title="Pajak Transaksi Bisnis"
                            onerror="newsImageFallback(this)"
                        >
                    </div>
                    <div class="news-body">
                        <h3 class="news-title">Cara Menghitung Pajak Dalam Transaksi bisnis</h3>
                        <div class="news-meta">
                            <span>November 30, 2024</span>
                            <span class="news-dot">&bull;</span>
                            <span>No Comments</span>
                        </div>
                    </div>
                </article>

                <!-- Card 4 -->
                <article class="news-card" data-category="pengumuman">
                    <div class="news-img-wrapper">
                        <img
                            src="beritaimages/harirayaidulfitri1446H.jpg"
                            alt="Selamat Hari Raya Idul Fitri 1446 H - SMK Darma Siswa 1 &amp; 2 Sidoarjo"
                            data-title="Idul Fitri 1446 H"
                            onerror="newsImageFallback(this)"
                        >
                    </div>
                    <div class="news-body">
                        <h3 class="news-title">Selamat Hari Raya Idul Fitri 1446 H - SMK DARMA SISWA 1 &amp; 2 SIDOARJO</h3>
                        <div class="news-meta">
                            <span>March 28, 2025</span>
                            <span class="news-dot">&bull;</span>
                            <span>9:58 am</span>
                        </div>
                    </div>
                </article>

                <!-- Card 5 -->
                <article class="news-card" data-category="pengumuman">
                    <div class="news-img-wrapper">
                        <img
                            src="beritaimages/tahunbaruislam1447H.jpg"
                            alt="Menyambut Tahun Baru Islam 1447 H Dengan Semangat Hijriah"
                            data-title="Tahun Baru Islam 1447 H"
                            onerror="newsImageFallback(this)"
                        >
                    </div>
                    <div class="news-body">
                        <h3 class="news-title">Menyambut Tahun Baru Islam 1447 H Dengan Semangat Hijriah</h3>
                        <div class="news-meta">
                            <span>June 27, 2025</span>
                            <span class="news-dot">&bull;</span>
                            <span>7:49 am</span>
                        </div>
                    </div>
                </article>

                <!-- Card 6 -->
                <article class="news-card" data-category="karya">
                    <div class="news-img-wrapper">
                        <img
                            src="beritaimages/meningkatkankecepatanmotor.jpg"
                            alt="Tips meningkatkan kecepatan motor tanpa merusak mesin"
                            data-title="Tips Motor"
                            onerror="newsImageFallback(this)"
                        >
                    </div>
                    <div class="news-body">
                        <h3 class="news-title">Tips meningkatkan kecepatan motor tanpa merusak mesin</h3>
                        <div class="news-meta">
                            <span>March 8, 2025</span>
                            <span class="news-dot">&bull;</span>
                            <span>8:30 am</span>
                        </div>
                    </div>
                </article>

            </div>

            <aside class="news-sidebar">
                <div class="news-sidebar-title">KATEGORI</div>
                <ul class="news-category-list">
                    <li class="news-category-item is-active" data-filter="semua">SEMUA</li>
                    <li class="news-category-item" data-filter="kegiatan">KEGIATAN SEKOLAH</li>
                    <li class="news-category-item" data-filter="prestasi">PRESTASI</li>
                    <li class="news-category-item" data-filter="pengumuman">PENGUMUMAN</li>
                    <li class="news-category-item" data-filter="karya">KARYA &amp; INOVASI SISWA</li>
                    <li class="news-category-item" data-filter="artikel">ARTIKEL</li>
                </ul>
            </aside>

        </div>

    </div>
</div>

<script>
function searchWebsite() {
    const keyword = document.getElementById('searchInput').value;
    if (keyword.trim() === '') {
        alert('Silakan masukkan pencarian terlebih dahulu.');
        return;
    }
    window.location.href = "{{ url('/search') }}?q=" + encodeURIComponent(keyword);
}

function newsImageFallback(img) {
    img.onerror = null;
    const label = img.dataset.title || 'Berita Sekolah';
    const svg = '<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400">' +
        '<rect width="100%" height="100%" fill="#e2e8f0"/>' +
        '<text x="50%" y="50%" font-family="Arial, Helvetica, sans-serif" font-size="26" font-weight="bold" fill="#64748b" text-anchor="middle" dominant-baseline="middle">' +
        label +
        '</text></svg>';
    img.src = 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg);
}

document.addEventListener('DOMContentLoaded', function () {
    const categoryItems = document.querySelectorAll('.news-category-item');
    const newsCards = document.querySelectorAll('.news-card');

    categoryItems.forEach(function (item) {
        item.addEventListener('click', function () {
            const filter = this.getAttribute('data-filter');

            categoryItems.forEach(function (other) {
                other.classList.remove('is-active');
            });
            this.classList.add('is-active');

            newsCards.forEach(function (card) {
                const category = card.getAttribute('data-category');
                const visible = filter === 'semua' || category === filter;

                card.style.display = visible ? '' : 'none';

                if (visible) {
                    card.classList.remove('news-card-anim');
                    void card.offsetWidth;
                    card.classList.add('news-card-anim');
                }
            });

            if (window.matchMedia('(max-width: 1024px)').matches) {
                const newsSection = document.querySelector('.news-section');
                if (newsSection) {
                    window.scrollTo({
                        top: newsSection.getBoundingClientRect().top + window.pageYOffset,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});

document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') searchWebsite();
});

document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const inc = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(updateCount, 15);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    });
});
</script>

@endsection