@extends('layouts.app')

@section('title', 'SPMB')

@section('styles')
    <link rel="stylesheet" href="/css/spmb.css">
@endsection

@section('content')

<div class="spmb-page">

    <section class="spmb-hero">
        <div class="spmb-hero__copy">
            <h1>ELEVATE YOUR FUTURE</h1>
            <p>Elevate your future! Gabung SMK / SMA Darma Siswa Sidoarjo dan cetak karir digital anda sekarang</p>
            <div class="spmb-hero__actions">
                <a href="#alur" class="spmb-button spmb-button--blue">Daftar Sekarang</a>
                <a href="#alur" class="spmb-button spmb-button--orange">Formulir</a>
            </div>
        </div>
        <div class="spmb-hero__image">
            <span class="spmb-hero__arch" aria-hidden="true"></span>
            <img src="{{ asset('images/spmb/spmb.jpg') }}" alt="Siswa SPMB">
        </div>
    </section>

    <main class="spmb-shell">

        <section class="spmb-process" id="alur">
            <h2>ALUR PENDAFTARAN <strong>SISWA BARU</strong></h2>

            <div class="spmb-timeline">
                <div class="spmb-step spmb-step--right">
                    <div class="spmb-step__icon">
                        <img src="{{ asset('images/spmb/formulir.jpg') }}" alt="">
                    </div>
                    <div class="spmb-step__number">1</div>
                    <div class="spmb-step__text">
                        <h3>ISI FORMULIR</h3>
                        <p>Lakukan pendaftaran online maupun offline dan lengkapi formulir dengan data diri yang benar. Segera selesaikan pembayaran biaya pendaftaran untuk melanjutkan ke tahap berikutnya.</p>
                    </div>
                </div>

                <div class="spmb-step spmb-step--left">
                    <div class="spmb-step__icon">
                        <img src="{{ asset('images/spmb/pendaftaran.jpg') }}" alt="">
                    </div>
                    <div class="spmb-step__number">2</div>
                    <div class="spmb-step__text">
                        <h3>PENDAFTARAN</h3>
                        <p>Proses: Mengirimkan formulir yang telah diisi dan melakukan pembayaran biaya pendaftaran sesuai dengan ketentuan yang berlaku.</p>
                    </div>
                </div>

                <div class="spmb-step spmb-step--right">
                    <div class="spmb-step__icon">
                        <img src="{{ asset('images/spmb/daftar.jpg') }}" alt="">
                    </div>
                    <div class="spmb-step__number">3</div>
                    <div class="spmb-step__text">
                        <h3>DAFTAR ULANG</h3>
                        <p>Proses: Melengkapi berbagai dokumen serta persyaratan administrasi yang dibutuhkan untuk proses daftar ulang.</p>
                    </div>
                </div>

                <div class="spmb-step spmb-step--left">
                    <div class="spmb-step__icon">
                        <img src="{{ asset('images/spmb/penerimaan.jpg') }}" alt="">
                    </div>
                    <div class="spmb-step__number">4</div>
                    <div class="spmb-step__text">
                        <h3>PENERIMAAN</h3>
                        <p>Proses: Tahap akhir di mana seluruh proses telah selesai dan calon siswa resmi diterima sebagai bagian dari sekolah.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

</div>

@endsection