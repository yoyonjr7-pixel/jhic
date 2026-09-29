@extends('layouts.app')

@section('title', 'Unduh Informasi')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/unduh-informasi.css') }}">
@endsection

@section('content')
<div class="download-page">
    <div class="download-shell">
        <section class="download-section">
            <h1 class="download-heading">UNDUH INFORMASI</h1>
            <p>Informasi dan dokumen sekolah yang tersedia.</p>

            @forelse ($informasi->groupBy(fn ($item) => $item->kategori ?: 'Informasi Sekolah') as $kategori => $dokumenKategori)
                <section class="download-section download-section--inner">
                    <h2 class="download-subheading">{{ rtrim($kategori, ' :') }} :</h2>
                    <div class="download-table" aria-label="Daftar {{ $kategori }}">
                        <div class="download-table__header">
                            <span>No.</span>
                            <span>Nama File</span>
                            <span>Diunggah</span>
                            <span>Aksi</span>
                        </div>
                        @foreach ($dokumenKategori as $dokumen)
                            <div class="download-table__row">
                                <span>{{ $loop->iteration }}.</span>
                                <span>{{ $dokumen->judul }}</span>
                                <span>{{ $dokumen->tanggal_publish?->locale('id')->translatedFormat('d F Y') ?? '-' }}</span>
                                @if ($dokumen->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($dokumen->file_path))
                                    <a
                                        href="{{ route('download-information.file', $dokumen->id_informasi) }}"
                                        class="download-btn"
                                        aria-label="Unduh {{ $dokumen->judul }}"
                                    >
                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                                        </svg>
                                    </a>
                                @else
                                    <span
                                        class="download-btn download-btn--disabled"
                                        title="File belum diunggah"
                                        aria-label="File {{ $dokumen->judul }} belum diunggah"
                                        aria-disabled="true"
                                    >
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12 3.5a1 1 0 0 1 1 1v8.59l2.3-2.3a1 1 0 1 1 1.4 1.42L12.7 17.7a1 1 0 0 1-1.4 0l-4-4.02a1 1 0 1 1 1.4-1.42l2.3 2.3V4.5a1 1 0 0 1 1-1Zm-7 14a1 1 0 0 1 1 1v.5h12v-.5a1 1 0 1 1 2 0v1.5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1.5a1 1 0 0 1 1-1Z"/>
                                    </svg>
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @empty
                <div class="download-table__row">
                    Belum ada dokumen yang diterbitkan.
                </div>
            @endforelse
        </section>
    </div>
</div>
@endsection
