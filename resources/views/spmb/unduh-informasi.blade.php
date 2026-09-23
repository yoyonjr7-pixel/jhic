
@extends('layouts.app')

@section('title', 'Visi dan Misi')

@section('content')
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Unduh Informasi</title>
        <link rel="stylesheet" href="{{ asset('css/unduh-informasi.css') }}" />
    </head>
    <body class="download-page">
        <main class="download-shell">
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
                        <span>Browser SPMB Smk Darma Siswa 1 Sidoarjo</span>
                        <span>12 April 2026</span>
                        <button type="button" class="download-btn" aria-label="Unduh Browser SPMB Smk Darma Siswa 1 Sidoarjo">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>

            <section class="download-section download-section--inner">
                <h3 class="download-subheading">Sertifikat Akreditasi  <span>" A " Smk Darma Siswa 1 Sidoarjo :</span></h3>

                <div class="download-table" aria-label="Daftar sertifikat akreditasi">
                    <div class="download-table__header">
                        <span>No.</span>
                        <span>Nama File</span>
                        <span>Di Unggah</span>
                        <span>Aksi</span>
                    </div>

                    <div class="download-table__row">
                        <span>1.</span>
                        <span>Sertifikat Akreditasi</span>
                        <span>02 May 2025</span>
                        <button type="button" class="download-btn" aria-label="Unduh Sertifikat Akreditasi">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </button>
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
                        <span>Juara 1 Lomba Futsal</span>
                        <span>13 Januari 2025</span>
                        <button type="button" class="download-btn" aria-label="Unduh Juara 1 Lomba Futsal">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="download-table__row">
                        <span>2.</span>
                        <span>Juara 1 Lomba Fotografi</span>
                        <span>01 Agustus 2026</span>
                        <button type="button" class="download-btn" aria-label="Unduh Juara 1 Lomba Fotografi">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="download-table__row">
                        <span>3.</span>
                        <span>Juara 2 Lomba Dance</span>
                        <span>30 February 2026</span>
                        <button type="button" class="download-btn" aria-label="Unduh Juara 2 Lomba Dance">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        </main>

        <script src="{{ asset('js/unduh-informasi.js') }}"></script>
    </body>
</html>

@endsection
