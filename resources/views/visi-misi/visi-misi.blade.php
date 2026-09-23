@extends('layouts.app')

@section('title', 'Visi dan Misi')

@section('styles')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi dan Misi - SMK Darma Siswa 1 Sidoarjo</title>
    <link rel="stylesheet" href="{{ asset('css/visi-misi.css') }}">
</head>
<body>
    <main class="vision-page">
        <div class="vision-layout">
            <div class="vision-main">
                <div class="vision-image-slot">
                    <img src="{{ asset('images/visi-misi/visi.jpg') }}" alt="Siswa SMK Darma Siswa 1 Sidoarjo dalam kunjungan industri">
                </div>
                <section class="vision-section">
                    <h1>-Visi-</h1>
                    <p>Mewujudkan tamatan SMK yang berkepribadian nasional, berkompetensi bidang keahlian yang dimilikinya, hidup berkarya (mandiri) dan/dapat melanjutkan pendidikan yang lebih tinggi.</p>
                </section>
                <section class="vision-section">
                    <h2>-Misi-</h2>
                    <ol>
                        <li>Melaksanakan program pendidikan dan pembelajaran/pelatihan sesuai dengan peraturan/perundang-undangan yang berlaku dalam Sekolah Menengah Kejuruan.</li>
                        <li>Menjalin kerja sama yang harmonis dan pihak birokrasi yang terkait, pihak dunia usaha/industri sebagai pasangan/pasar tenaga kerja dan pihak lain yang peduli terhadap peningkatan kualitas pada dunia pendidikan.</li>
                        <li>Memperhatikan kesejahteraan semua personil yang bertugas dalam pengelolaan operasional sekolah.</li>
                        <li>Membantu peserta didik dari masyarakat ekonomi lemah yang mempunyai potensi berkembang melalui pelayanan.</li>
                    </ol>
                </section>
                <section class="vision-section vision-section--goals">
                    <h3>TUJUAN</h3>
                    <ol>
                        <li>Meningkatkan budaya tertib di lingkungan sekolah yang meliputi: tertib mengajar, tertib belajar, tertib berpakaian, tertib administrasi.</li>
                        <li>Terciptanya suasana religius dilingkungan sekolah melalui kegiatan IMTAQ melalui kegiatan intra maupun ekstrakurikuler.</li>
                        <li>Meningkatkan kinerja seluruh warga sekolah dalam upaya meningkatkan profesionalisme kerja yang ditunjang dengan sistem kerja yang cepat dan akurat.</li>
                        <li>Terlaksananya pembambahan dan penataan sarana penunjang belajar mengajar.</li>
                        <li>Terlaksananya keterampilan dalam pengolahan nilai dan mempercepat proses pengoreksian soal-soal pilihan ganda.</li>
                        <li>Terlaksananya program keterampilan komputer bagi para siswa, guru dan karyawan.</li>
                        <li>Meningkatkan kegiatan ekstrakurikuler sebagai upaya pembentukan kepribadian siswa yang ditunjang dengan ketersediaan sarana dan prasarana.</li>
                    </ol>
                </section>
            </div>
            <aside class="recent-posts">
                <h2>Recent Posts</h2>
                <a href="#">Merancang Masa Depan Gemilang: Bimbingan Karir di SMK Favorit Jawa Timur</a>
                <a href="#">Batasan Gadget Remaja: Kunci Harmoni Tanpa Perang di Rumah</a>
                <a href="#">Menemukan SMK Favorit Anda: Lingkungan Aman, Asri, dan Nyaman di Jawa Timur</a>
                <a href="#">Analisis Neuroplastisitas Siswa Terhadap Algoritma Pembelajaran Adaptif Berbasis AI pada SMK di Sidoarjo</a>
            </aside>
        </div>
    </main>
</body>
</html>

@endsection
