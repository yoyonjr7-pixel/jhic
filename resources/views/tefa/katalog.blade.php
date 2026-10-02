@extends('layouts.app')

@section('title', 'TEFA Online - Katalog Layanan')

@section('styles')
<link rel="stylesheet" href="/css/tefa.css">
@endsection

@section('content')

@php
    $layanan = config('tefa.layanan');

    $jurusan = config('tefa.jurusan');

    $kategoriAktif = request()->query('jurusan', 'tsm');

    if (! array_key_exists($kategoriAktif, $jurusan)) {
        $kategoriAktif = 'tsm';
    }
@endphp

{{-- =========================================================
     HERO / HEADER KATALOG
========================================================= --}}
<section class="tefa-hero">

    <div class="tefa-hero-inner">

        <div class="tefa-hero-text">
            <span class="tefa-hero-badge">Katalog</span>
            <h1 class="tefa-hero-title">Pilih Layanan</h1>
            <p class="tefa-hero-desc">
                Pilih layanan yang anda butuhkan dan lakukan
                booking secara online secara mudah dan cepat
            </p>

            <div class="tefa-filters" id="tefaFilters">
                @foreach ($jurusan as $kode => $data)
                    <button
                        type="button"
                        class="tefa-pill @if ($kode === $kategoriAktif) is-active @endif"
                        data-filter="{{ $kode }}"
                    >{{ $data['label'] }}</button>
                @endforeach
            </div>
        </div>

        <div class="tefa-hero-logo">
            <img src="{{ asset('images/tefalogo.png') }}" alt="Logo Teaching Factory SMK Darma Siswa 1 Sidoarjo">
        </div>

    </div>

</section>

{{-- =========================================================
     GRID KARTU LAYANAN
========================================================= --}}
<section class="tefa-catalog">

    <div class="tefa-grid" id="tefaGrid">

        @foreach ($layanan as $item)
            <article
                class="tefa-card"
                data-category="{{ $item['kategori'] }}"
                @if ($item['kategori'] !== $kategoriAktif) style="display: none;" @endif
            >

                <div class="tefa-card-head">

                    <div class="tefa-card-icon">
                        @include('tefa.partials.icon', ['type' => $item['ikon']])
                    </div>

                    <div class="tefa-card-info">
                        <h3 class="tefa-card-title">{{ $item['nama'] }}</h3>
                        <p class="tefa-card-desc">{{ $item['deskripsi'] }}</p>
                    </div>

                </div>

                <div class="tefa-card-divider"></div>

                <div class="tefa-card-price">{{ $item['harga'] }}</div>

                <a
                    href="{{ route('tefa.booking') }}?layanan={{ $item['slug'] }}"
                    class="tefa-btn-booking"
                >
                    Booking
                </a>

            </article>
        @endforeach

    </div>

    <p class="tefa-empty" id="tefaEmpty">
        Belum ada layanan untuk jurusan ini.
    </p>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pills = document.querySelectorAll('.tefa-pill');
    const cards = document.querySelectorAll('.tefa-card');
    const empty = document.getElementById('tefaEmpty');

    function applyFilter(filter) {
        let visible = 0;

        pills.forEach(function (pill) {
            pill.classList.toggle('is-active', pill.getAttribute('data-filter') === filter);
        });

        cards.forEach(function (card) {
            const show = card.getAttribute('data-category') === filter;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        empty.style.display = visible === 0 ? 'block' : 'none';

        if (window.history && window.history.replaceState) {
            const url = new URL(window.location.href);
            url.searchParams.set('jurusan', filter);
            window.history.replaceState({}, '', url);
        }
    }

    pills.forEach(function (pill) {
        pill.addEventListener('click', function () {
            applyFilter(this.getAttribute('data-filter'));
        });
    });

    const activePill = document.querySelector('.tefa-pill.is-active') || pills[0];
    if (activePill) {
        applyFilter(activePill.getAttribute('data-filter'));
    }
});
</script>

@endsection
