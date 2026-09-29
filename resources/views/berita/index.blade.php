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
                    @if ($item->foto)
                        <img
                            src="{{ asset('storage/' . $item->foto) }}"
                            class="card-img-top"
                            alt="{{ $item->judul }}"
                            style="height: 220px; object-fit: cover;"
                        >
                    @endif
                    <div class="card-body">
                        @if ($item->kategori)
                            <span class="badge text-bg-primary mb-2">{{ $item->kategori }}</span>
                        @endif
                        <h2 class="h5 card-title">{{ $item->judul }}</h2>
                        <p class="small text-muted">
                            {{ $item->tanggal_publish?->format('d M Y') ?? $item->created_at?->format('d M Y') }}
                            @if ($item->penulis) · {{ $item->penulis }} @endif
                        </p>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 180) }}</p>
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
