@extends('layouts.app')

@section('title', 'Prestasi Sekolah')

@section('styles')
    <link rel="stylesheet" href="/css/prestasi.css">
@endsection

@section('content')

@php
    $nilai = array_column($prestasi, 'jumlah');
    $nilaiTertinggi = $nilai ? max($nilai) : 0;

    // Sumbu grafik dibulatkan ke atas kelipatan 20 agar skalanya rapi.
    $sumbuMaks = (int) (ceil(max($nilaiTertinggi, 1) / 20) * 20) + 20;
    $sumbu = range($sumbuMaks, 0, -20);

    // Ringkasan angka untuk pembaca layar (grafiknya sendiri bersifat visual).
    $ringkasan = collect($prestasi)
        ->map(function ($item) {
            return $item['tingkat'] . ' ' . $item['jumlah'];
        })
        ->implode(', ');
@endphp

<section class="prestasi-page">

    {{-- =========================================================
         PENGANTAR PRESTASI
    ========================================================= --}}
    <div class="prestasi-intro">

        <div class="prestasi-figure">
            <span class="prestasi-arch" aria-hidden="true"></span>

            <img src="/prestasiimages/prestasi-siswa.png"
                alt="Siswa SMK Darma Siswa 1 Sidoarjo meraih prestasi">
        </div>

        <div class="prestasi-intro-text">
            <h1 class="prestasi-title">PRESTASI</h1>

            <p class="prestasi-desc">
                Prestasi merupakan wujud nyata dari semangat, kerja keras, dan dedikasi
                siswa-siswi SMK Darma Siswa 1 Sidoarjo. Setiap pencapaian menjadi
                kebanggaan bagi sekolah sekaligus motivasi untuk terus mengembangkan
                potensi, meningkatkan kemampuan, dan meraih prestasi yang lebih tinggi.
                Semoga berbagai prestasi ini dapat menjadi inspirasi bagi seluruh siswa
                untuk terus berkarya dan berprestasi.
            </p>
        </div>

    </div>

    {{-- =========================================================
         GRAFIK JUMLAH PRESTASI PER TINGKAT
    ========================================================= --}}
    <div class="prestasi-chart-card">

        <div class="prestasi-chart" role="img"
            aria-label="Grafik jumlah prestasi siswa: {{ $ringkasan }}.">

            <div class="prestasi-axis" aria-hidden="true">
                @foreach ($sumbu as $tick)
                    <span class="prestasi-axis-label"
                        style="top: {{ (1 - $tick / $sumbuMaks) * 100 }}%">{{ $tick }}</span>
                @endforeach
            </div>

            <div class="prestasi-plot">
                @foreach ($sumbu as $tick)
                    <span class="prestasi-grid-line{{ $tick === 0 ? ' prestasi-grid-line--base' : '' }}"
                        style="top: {{ (1 - $tick / $sumbuMaks) * 100 }}%"></span>
                @endforeach

                <div class="prestasi-bars">
                    @foreach ($prestasi as $item)
                        <div class="prestasi-bar-col">
                            <div class="prestasi-bar"
                                style="height: {{ ($item['jumlah'] / $sumbuMaks) * 100 }}%"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="prestasi-cats">
                @foreach ($prestasi as $item)
                    <span class="prestasi-cat">{{ $item['tingkat'] }}</span>
                @endforeach
            </div>

        </div>

    </div>

    <section class="prestasi-siswa" aria-labelledby="prestasi-siswa-title">
        <div class="prestasi-siswa__heading">
            <h2 id="prestasi-siswa-title">PRESTASI SISWA</h2>
            <p>Smk Darma Siswa 1 Sidoarjo</p>
        </div>

        <div class="prestasi-siswa__grid">
            @forelse ($daftarPrestasi as $item)
                <article class="prestasi-siswa__card">
                    <div class="prestasi-siswa__image">
                        @if ($item->foto)
                            <img src="{{ $item->fotoUrl() }}" alt="{{ $item->judul_prestasi }}">
                        @else
                            <span aria-hidden="true">{{ strtoupper(substr($item->judul_prestasi, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="prestasi-siswa__info">
                        <h3>{{ $item->juara ? $item->juara . ' - ' : '' }}{{ $item->judul_prestasi }}</h3>
                        <p>
                            {{ $item->nama_pemenang }}
                            @if ($item->kelas) · {{ $item->kelas }} @endif
                            @if ($item->jurusan) · {{ $item->jurusan->nama_jurusan }} @endif
                            @if ($item->tahun) · {{ $item->tahun }} @endif
                        </p>
                        @if ($item->deskripsi)
                            <p>{{ $item->deskripsi }}</p>
                        @endif
                    </div>
                </article>
            @empty
                <p class="text-muted">Belum ada data prestasi yang diterbitkan.</p>
            @endforelse
        </div>
    </section>

</section>

@endsection
