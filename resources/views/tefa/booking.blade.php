@extends('layouts.app')

@section('title', 'TEFA Online - Booking Layanan')

@section('styles')
<link rel="stylesheet" href="/css/tefa.css">
@endsection

@section('content')

@php
    $layanan = config('tefa.layanan');

    $dipilih = request()->query('layanan');
    $terpilih = collect($layanan)->firstWhere('slug', $dipilih);

    if (! $terpilih) {
        $terpilih = $layanan[0];
    }

    $namaJurusan = config("tefa.jurusan.{$terpilih['kategori']}.label", strtoupper($terpilih['kategori']));
@endphp

<section class="booking-section">

    <div class="booking-inner">

        {{-- =========================================================
             JUDUL
        ========================================================= --}}
        <header class="booking-header">
            <div class="booking-header-line">
                <span class="booking-line"></span>
                <span class="booking-dot"></span>
                <h1 class="booking-title">Buat Booking</h1>
                <span class="booking-dot"></span>
                <span class="booking-line"></span>
            </div>

            <p class="booking-subtitle">Lengkapi Data Berikut Untuk Booking Jasa</p>
        </header>

        @if (session('success'))
            <div class="booking-alert booking-alert--success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="booking-alert booking-alert--error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="booking-layout">

            {{-- =====================================================
                 KIRI : LAYANAN YANG DIPILIH
            ===================================================== --}}
            <div class="booking-side">

                <aside class="booking-aside">

                    <div class="booking-aside-head">
                        <div class="booking-aside-icon">
                            @include('tefa.partials.icon', ['type' => $terpilih['ikon']])
                        </div>

                        <div class="booking-aside-titles">
                            <span class="booking-aside-label">Layanan di pilih :</span>
                            <span class="booking-aside-jurusan">{{ $namaJurusan }}</span>
                        </div>
                    </div>

                    <p class="booking-aside-kategori">
                        Kategori : <span>{{ $terpilih['nama'] }}</span>
                    </p>

                    <p class="booking-aside-desc">{{ $terpilih['deskripsi'] }}</p>

                    <div class="booking-aside-price">{{ $terpilih['harga'] }}</div>

                </aside>

                <a
                    href="{{ route('tefa.katalog', ['jurusan' => $terpilih['kategori']]) }}"
                    class="booking-back"
                >
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Kembali ke TEFA {{ $namaJurusan }}
                </a>

            </div>

            {{-- =====================================================
                 KANAN : FORM BOOKING
            ===================================================== --}}
            <form class="booking-form" method="POST" action="{{ route('tefa.booking.store') }}">

                @csrf

                <input type="hidden" id="layanan" name="layanan" value="{{ old('layanan', $terpilih['slug']) }}">

                <div class="booking-fields">

                    <div class="booking-field">
                        <label for="nama">Nama Lengkap :</label>
                        <input type="text" id="nama" name="nama" autocomplete="name"
                            value="{{ old('nama') }}" required>
                        @error('nama')
                            <span class="booking-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="booking-field">
                        <label for="whatsapp">No. Whatsapp :</label>
                        <input type="tel" id="whatsapp" name="whatsapp" placeholder="08xxxxxxxxxx"
                            value="{{ old('whatsapp') }}" required>
                        @error('whatsapp')
                            <span class="booking-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="booking-field">
                        <label for="tanggal">Tanggal :</label>
                        <input type="date" id="tanggal" name="tanggal"
                            value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <span class="booking-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="booking-field">
                        <label for="jam">Jam :</label>
                        <input type="time" id="jam" name="jam"
                            value="{{ old('jam') }}" required>
                        @error('jam')
                            <span class="booking-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="booking-field booking-field--full">
                    <label for="catatan">Catatan Keluhan / Kebutuhan :</label>
                    <textarea id="catatan" name="catatan" rows="5">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <span class="booking-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="booking-actions">
                    <button type="submit" class="booking-submit">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M3.4 20.4l17.45-7.48a1 1 0 0 0 0-1.84L3.4 3.6a1 1 0 0 0-1.39 1.1l1.9 6.11a1 1 0 0 0 .78.68L15 12l-10.31.51a1 1 0 0 0-.78.68l-1.9 6.11a1 1 0 0 0 1.39 1.1z"/>
                        </svg>
                        Kirim Booking
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection
