@extends('layouts.app')

@section('title', 'Berita Sekolah')

@section('content')
<main class="container py-5">
    <header class="mb-4">
        <p class="text-uppercase text-primary fw-bold mb-2">Informasi Sekolah</p>
        <h1>Berita Sekolah</h1>
        <p class="text-muted">Berita dan pengumuman terbaru SMK Darma Siswa 1 &amp; 2 Sidoarjo.</p>
    </header>

    <div class="row g-4">
        @forelse ($berita as $item)
            <article class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    @if ($item->fotoUrl())
                        <img
                            src="{{ $item->fotoUrl() }}"
                            class="card-img-top"
                            alt="{{ $item->judul_berita }}"
                            style="height: 220px; object-fit: cover;"
                        >
                    @endif
                    <div class="card-body">
                        @if ($item->kategori)
                            <span class="badge text-bg-primary mb-2">
                                {{ \App\Http\Controllers\BeritaController::KATEGORI[$item->kategori] ?? $item->kategori }}
                            </span>
                        @endif
                        <h2 class="h5 card-title">{{ $item->judul_berita }}</h2>
                        <p class="small text-muted">
                            {{ $item->Tanggal?->format('d M Y') ?? '-' }}
                            @if ($item->jam) · {{ \Carbon\Carbon::parse($item->jam)->format('g:i a') }} @endif
                        </p>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-12">
                <p class="alert alert-light border">Belum ada berita yang diterbitkan.</p>
            </div>
        @endforelse
    </div>
</main>
@endsection
