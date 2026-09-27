
@extends('layouts.app')

@section('title', 'Visi dan Misi')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/unduh-informasi.css') }}">
@endsection

@section('content')
<div class="download-page">
    <div class="download-shell">
            <section class="download-section">
                <h2 class="download-heading">UNDUH FILE :</h2>

                <div class="download-table" aria-label="Daftar unduh file">
                    <div class="download-table__header">
                        <span>No.</span>
                        <span>Nama File</span>
                        <span>Di Unggah</span>
                        <span>Aksi</span>
                    </div>
                    <div class="download-table__row">
                         <span>1.</span>

                         <span>
                         Brosur SPMB Smk Darma Siswa 1 Sidoarjo
                         </span>

                         <span>12 April 2026</span>

                         <a
                         href="{{ asset('images/spmb/brosur-spmb-2026-2027.png') }}"
                           class="download-btn"
                         download
                         aria-label="Unduh Brosur SPMB Smk Darma Siswa 1 Sidoarjo"
                         >
                          <svg viewBox="0 0 24 24" aria-hidden="true">
                         <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1-1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                   </svg>
                  </a>
                 </div>
                </div>
            </section>

            <section class="download-section download-section--inner">
                <h3 class="download-subheading">Prospek Pekerjaan / Lulusan  <span> Smk Darma Siswa 1 Sidoarjo :</span></h3>

                <div class="download-table" aria-label="Daftar sertifikat akreditasi">
                    <div class="download-table__header">
                        <span>No.</span>
                        <span>Nama File</span>
                        <span>Di Unggah</span>
                        <span>Aksi</span>
                    </div>

                    <div class="download-table__row">
                        <span>1.</span>
                        <span>Prospek Pekerjaan / Lulusan </span>
                        <span>02 May 2025</span>
                        <a href="{{ asset('images/spmb/prospek-pekerjaan-lulusan.png') }}"
                        class="download-btn"
                        download
                        aria-label="Unduh Prospek Pekerjaan / Lulusan Smk Darma Siswa 1 Sidoarjo">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            <section class="download-section download-section--inner">
                <h3 class="download-subheading">Prestasi Terbaru :</h3>

                <div class="download-table" aria-label="Daftar prestasi terbaru">
                    <div class="download-table__header">
                        <span>No.</span>
                        <span>Nama File</span>
                        <span>Di Unggah</span>
                        <span>Aksi</span>
                    </div>

                    <div class="download-table__row">
                        <span>1.</span>
                        <span>Juara 3 Lomba Poster</span>
                        <span>13 Januari 2025</span>
                        <a href="{{ asset('images/spmb/prestasi/juara-3-lomba-poster.png') }}"
                        class="download-btn"
                        download
                        aria-label="Unduh Brosur SPMB Smk Darma Siswa 1 Sidoarjo">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="download-table__row">
                        <span>2.</span>
                        <span>Juara 1 Lomba Fotografi</span>
                        <span>01 Agustus 2026</span>
                        <a href="{{ asset('images/spmb/prestasi/juara-1-lomba-fotografi.png') }}"
                        class="download-btn"
                        download
                        aria-label="Unduh Brosur SPMB Smk Darma Siswa 1 Sidoarjo">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="download-table__row">
                        <span>3.</span>
                        <span>Juara 3 Lomba Pencak Silat</span>
                        <span>30 February 2026</span>
                        <a href="{{ asset('images/spmb/prestasi/juara-3-lomba-pencak-silat.png') }}"
                        class="download-btn"
                        download
                        aria-label="Unduh Brosur SPMB Smk Darma Siswa 1 Sidoarjo">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
