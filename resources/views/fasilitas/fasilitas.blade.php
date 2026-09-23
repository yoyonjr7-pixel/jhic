@extends('layouts.app')

@section('title', 'Fasilitas Sekolah')

@section('styles')
    <link rel="stylesheet" href="/css/fasilitas.css">
@endsection

@section('content')

<div class="facilities-page">

    {{-- =========================================================
         PENGANTAR FASILITAS
    ========================================================= --}}
    <section class="facilities-intro" aria-labelledby="facilities-title">

        <div class="facilities-container facilities-intro__content">

            <div class="image-slot image-slot--intro">
                <img src="{{ asset('fasilitasimages/fasilitas.jpg') }}"
                    alt="Gedung dan lingkungan SMK Darma Siswa 1 Sidoarjo">
            </div>

            <div class="facilities-intro__copy">
                <h1 id="facilities-title">FASILITAS</h1>

                <p>
                    Fasilitas sekolah menjadi salah satu pendukung penting dalam menciptakan proses
                    pembelajaran yang nyaman, efektif, dan berkualitas. SMK Darma Siswa 1 Sidoarjo
                    menyediakan berbagai fasilitas untuk menunjang kegiatan akademik, praktik,
                    pengembangan keterampilan, serta aktivitas siswa. Melalui fasilitas yang tersedia,
                    diharapkan seluruh siswa dapat belajar, berkembang, dan mempersiapkan diri
                    menghadapi dunia kerja dengan lebih baik.
                </p>
            </div>

        </div>

    </section>

    {{-- =========================================================
         DAFTAR FASILITAS
    ========================================================= --}}
    <section class="facilities-list" aria-labelledby="facilities-list-title">

        <div class="facilities-container">

            <h2 id="facilities-list-title">
                Fasilitas Penunjang Belajar &amp; Berkarya SMK Darma Siswa 1 Sidoarjo
            </h2>

            <div class="facility-grid">

                <article class="facility-card">
                    <div class="image-slot facility-card__image">
                        <img src="{{ asset('fasilitasimages/aula.jpg') }}"
                            alt="Aula SMK Darma Siswa 1 Sidoarjo">
                    </div>

                    <div class="facility-card__body">
                        <h3>AULA</h3>
                        <p>
                            Aula multifungsi yang digunakan untuk kegiatan sekolah seperti seminar,
                            workshop, pertemuan wali murid, hingga acara internal dan eksternal sekolah.
                        </p>
                    </div>
                </article>

                <article class="facility-card">
                    <div class="image-slot facility-card__image">
                        <img src="{{ asset('fasilitasimages/gedung.jpg') }}"
                            alt="Gedung SMK Darma Siswa 1 Sidoarjo">
                    </div>

                    <div class="facility-card__body">
                        <h3>GEDUNG SMK</h3>
                        <p>
                            Gedung utama SMK Darma Siswa 1 Sidoarjo yang representatif dengan desain
                            modern serta fasilitas lengkap untuk menunjang kegiatan akademik maupun
                            non-akademik siswa.
                        </p>
                    </div>
                </article>

                <article class="facility-card">
                    <div class="image-slot facility-card__image">
                        <img src="{{ asset('fasilitasimages/kantin.jpg') }}"
                            alt="Kantin SMK Darma Siswa 1 Sidoarjo">
                    </div>

                    <div class="facility-card__body">
                        <h3>KANTIN</h3>
                        <p>
                            Kantin merupakan fasilitas sekolah untuk tempat makan dan ruang bersosialisasi
                            yang bersih dan nyaman. Kantin sekolah menjual berbagai macam pilihan makanan
                            berat maupun makanan ringan.
                        </p>
                    </div>
                </article>

            </div>

        </div>

    </section>

</div>

@endsection

