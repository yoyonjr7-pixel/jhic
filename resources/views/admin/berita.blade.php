@extends('layouts.admin')

@section('title', 'Berita Terbaru')

@section('page-title', 'Berita Terbaru')

@section('content')

<!-- =========================================
     HEADER
========================================= -->

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <span class="welcome-label">
            BERITA
        </span>

        <h2 class="fw-bold mt-3 mb-1">
            Berita Terbaru
        </h2>

        <p class="text-muted mb-0">
            Kelola berita dan informasi sekolah yang tampil di halaman utama.
        </p>
    </div>

    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambahBerita"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Berita
    </button>
</div>

<!-- =========================================
     ALERT SUCCESS
========================================= -->

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i>
    {{ session('success') }}

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
    ></button>
</div>

@endif

<!-- =========================================
     ALERT ERROR VALIDASI
========================================= -->

@if($errors->any())

<div class="alert alert-danger alert-dismissible fade show" role="alert">

    <strong>
        Data belum berhasil diproses.
    </strong>

    <ul class="mb-0 mt-2">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
    ></button>

</div>

@endif

<!-- =========================================
     STATISTIK
========================================= -->

<div class="row g-3 mb-4">

    <!-- TOTAL BERITA -->
    <div class="col-xl-3 col-md-6">
        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>
                    <p class="stat-label">
                        Total Berita
                    </p>

                    <h2 class="stat-number">
                        {{ $berita->count() }}
                    </h2>

                    <span class="stat-status info">
                        <i class="bi bi-newspaper"></i>
                        Semua kategori
                    </span>
                </div>

                <div class="stat-icon primary">
                    <i class="bi bi-newspaper"></i>
                </div>

            </div>

        </div>
    </div>

    <!-- KEGIATAN SEKOLAH -->
    <div class="col-xl-3 col-md-6">
        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>
                    <p class="stat-label">
                        Kegiatan Sekolah
                    </p>

                    <h2 class="stat-number">
                        {{ $berita->where('kategori', 'kegiatan')->count() }}
                    </h2>

                    <span class="stat-status success">
                        <i class="bi bi-calendar3"></i>
                        Berita kegiatan
                    </span>
                </div>

                <div class="stat-icon success">
                    <i class="bi bi-calendar3"></i>
                </div>

            </div>

        </div>
    </div>

    <!-- PENGUMUMAN -->
    <div class="col-xl-3 col-md-6">
        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>
                    <p class="stat-label">
                        Pengumuman
                    </p>

                    <h2 class="stat-number">
                        {{ $berita->where('kategori', 'pengumuman')->count() }}
                    </h2>

                    <span class="stat-status warning">
                        <i class="bi bi-megaphone"></i>
                        Berita pengumuman
                    </span>
                </div>

                <div class="stat-icon warning">
                    <i class="bi bi-megaphone"></i>
                </div>

            </div>

        </div>
    </div>

    <!-- BERITA TERBARU -->
    <div class="col-xl-3 col-md-6">
        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>
                    <p class="stat-label">
                        Berita Terbaru
                    </p>

                    <h2 class="stat-number" style="font-size: 1.25rem;">
                        {{ $berita->first()?->Tanggal?->format('d M Y') ?? '-' }}
                    </h2>

                    <span class="stat-status info">
                        <i class="bi bi-clock-history"></i>
                        {{ $berita->first()?->judul_berita ? \Illuminate\Support\Str::limit($berita->first()->judul_berita, 28) : 'Belum ada berita' }}
                    </span>
                </div>

                <div class="stat-icon info">
                    <i class="bi bi-clock-history"></i>
                </div>

            </div>

        </div>
    </div>

</div>

<!-- =========================================
     DATA BERITA
========================================= -->

<div class="dashboard-card">

    <!-- HEADER CARD -->
    <div class="dashboard-card-header">

        <div>
            <h5 class="dashboard-card-title">
                Daftar Berita
            </h5>

            <p class="dashboard-card-subtitle">
                Berita yang tampil di bagian "Berita Terbaru" halaman utama.
            </p>
        </div>

        <!-- SEARCH + FILTER KATEGORI -->
        <div class="d-flex gap-2">

            <div
                class="input-group input-group-sm"
                style="max-width: 260px;"
            >
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari berita..."
                    id="searchBerita"
                >
            </div>

            <select
                class="form-select form-select-sm"
                style="width: 200px;"
                id="filterKategoriBerita"
            >
                <option value="">
                    Semua Kategori
                </option>

                @foreach($kategoriList as $kode => $label)
                    <option value="{{ $kode }}">
                        {{ $label }}
                    </option>
                @endforeach
            </select>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-responsive">

        <table class="table dashboard-table align-middle mb-0">

            <thead>
                <tr>
                    <th>Berita</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th class="text-end">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody id="beritaTableBody">

                @forelse($berita as $item)

                    @php
                        $kategoriClass = match($item->kategori) {
                            'kegiatan' => 'success',
                            'prestasi' => 'primary',
                            'pengumuman' => 'warning',
                            'karya' => 'info',
                            'artikel' => 'secondary',
                            default => 'secondary',
                        };
                    @endphp

                    <tr
                        class="berita-row"
                        data-search="{{ strtolower($item->judul_berita . ' ' . ($item->kategori ?? '')) }}"
                        data-kategori="{{ strtolower($item->kategori ?? '') }}"
                    >

                        <!-- BERITA -->
                        <td>

                            <div class="d-flex align-items-center gap-3">

                                @if($item->fotoUrl())

                                    <img
                                        src="{{ $item->fotoUrl() }}"
                                        alt="{{ $item->judul_berita }}"
                                        style="width: 56px; height: 42px; object-fit: cover; border-radius: 8px;"
                                    >

                                @else

                                    <div
                                        class="stat-icon primary flex-shrink-0"
                                        style="width: 56px; height: 42px;"
                                    >
                                        <i class="bi bi-image"></i>
                                    </div>

                                @endif

                                <div>

                                    <strong>
                                        {{ $item->judul_berita }}
                                    </strong>

                                    <small class="d-block text-muted">
                                        ID #{{ $item->id_berita }}
                                    </small>

                                </div>

                            </div>

                        </td>

                        <!-- KATEGORI -->
                        <td>

                            <span class="status-badge {{ $kategoriClass }}">
                                {{ $kategoriList[$item->kategori] ?? $item->kategori ?? '-' }}
                            </span>

                        </td>

                        <!-- TANGGAL -->
                        <td>

                            <strong>
                                {{ $item->Tanggal?->format('d/m/Y') ?? '-' }}
                            </strong>

                        </td>

                        <!-- JAM -->
                        <td>

                            {{ $item->jam ? \Carbon\Carbon::parse($item->jam)->format('H:i') : '-' }}

                        </td>

                        <!-- AKSI -->
                        <td class="text-end">

                            <div class="d-inline-flex gap-1">

                                <!-- EDIT -->
                                <button
                                    type="button"
                                    class="btn btn-sm btn-light"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditBerita{{ $item->id_berita }}"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <!-- HAPUS -->
                                <button
                                    type="button"
                                    class="btn btn-sm btn-light text-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapusBerita{{ $item->id_berita }}"
                                    title="Hapus"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr id="emptyBeritaRow">

                        <td colspan="5" class="text-center py-5">

                            <div class="text-muted">

                                <i class="bi bi-newspaper fs-2 d-block mb-2"></i>

                                Belum ada data berita.

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- FOOTER -->
    <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">

        <small class="text-muted">

            Menampilkan

            <span id="jumlahBerita">
                {{ $berita->count() }}
            </span>

            data berita

        </small>

    </div>

</div>

<!-- =====================================================
     MODAL TAMBAH
===================================================== -->

<div
    class="modal fade"
    id="modalTambahBerita"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        <form
            action="{{ route('berita.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <input type="hidden" name="_form" value="tambah">

            <div class="modal-header">

                <div>
                    <h5 class="modal-title fw-bold">
                        Tambah Berita
                    </h5>

                    <small class="text-muted">
                        Tambahkan berita baru untuk halaman utama.
                    </small>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <!-- JUDUL -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Judul Berita
                        </label>

                        <input
                            type="text"
                            name="judul_berita"
                            class="form-control"
                            placeholder="Contoh: Masuk Sekolah Tahun Pelajaran 2026 - 2027"
                            value="{{ old('judul_berita') }}"
                            required
                        >

                    </div>

                    <!-- KATEGORI -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select
                            name="kategori"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Pilih Kategori
                            </option>

                            @foreach($kategoriList as $kode => $label)

                                <option
                                    value="{{ $kode }}"
                                    {{ old('kategori') === $kode ? 'selected' : '' }}
                                >
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- TANGGAL -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="Tanggal"
                            class="form-control"
                            value="{{ old('Tanggal') }}"
                            required
                        >

                    </div>

                    <!-- JAM -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Jam
                        </label>

                        <input
                            type="time"
                            name="jam"
                            class="form-control"
                            value="{{ old('jam') }}"
                        >

                        <small class="text-muted">
                            Opsional. Contoh: 08:00.
                        </small>

                    </div>

                    <!-- FOTO -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Foto Berita
                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                        </small>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Berita
                </button>

            </div>

        </form>

    </div>

</div>

</div>

<!-- =====================================================
     MODAL EDIT & HAPUS (per berita)
===================================================== -->

@foreach($berita as $item)

<div
    class="modal fade"
    id="modalEditBerita{{ $item->id_berita }}"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        <form
            action="{{ route('berita.update', $item->id_berita) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <input type="hidden" name="_form" value="edit">

            <div class="modal-header">

                <div>
                    <h5 class="modal-title fw-bold">
                        Edit Berita
                    </h5>

                    <small class="text-muted">
                        Perbarui informasi berita #{{ $item->id_berita }}.
                    </small>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <!-- JUDUL -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Judul Berita
                        </label>

                        <input
                            type="text"
                            name="judul_berita"
                            class="form-control"
                            value="{{ old('judul_berita', $item->judul_berita) }}"
                            required
                        >

                    </div>

                    <!-- KATEGORI -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select
                            name="kategori"
                            class="form-select"
                            required
                        >

                            @foreach($kategoriList as $kode => $label)

                                <option
                                    value="{{ $kode }}"
                                    {{ old('kategori', $item->kategori) === $kode ? 'selected' : '' }}
                                >
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- TANGGAL -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="Tanggal"
                            class="form-control"
                            value="{{ old('Tanggal', $item->Tanggal?->format('Y-m-d')) }}"
                            required
                        >

                    </div>

                    <!-- JAM -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Jam
                        </label>

                        <input
                            type="time"
                            name="jam"
                            class="form-control"
                            value="{{ old('jam', $item->jam ? \Carbon\Carbon::parse($item->jam)->format('H:i') : '') }}"
                        >

                    </div>

                    <!-- FOTO -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Ganti Foto (opsional)
                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        @if($item->fotoUrl())

                            <div class="mt-2">

                                <small class="text-muted d-block mb-1">
                                    Foto saat ini:
                                </small>

                                <img
                                    src="{{ $item->fotoUrl() }}"
                                    alt="{{ $item->judul_berita }}"
                                    class="rounded-3"
                                    style="width: 120px; height: 80px; object-fit: cover;"
                                >

                            </div>

                        @endif

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

</div>

<div
    class="modal fade"
    id="modalHapusBerita{{ $item->id_berita }}"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        <div class="modal-header">

            <h5 class="modal-title fw-bold">
                Hapus Berita
            </h5>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
            ></button>

        </div>

        <div class="modal-body text-center py-4">

            <div
                class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3"
                style="width: 70px; height: 70px;"
            >
                <i class="bi bi-trash text-danger fs-3"></i>
            </div>

            <h5 class="fw-bold">
                Yakin ingin menghapus berita ini?
            </h5>

            <p class="text-muted mb-0">

                Berita

                <strong>
                    "{{ $item->judul_berita }}"
                </strong>

                akan dihapus secara permanen.

            </p>

        </div>

        <div class="modal-footer justify-content-center">

            <button
                type="button"
                class="btn btn-light"
                data-bs-dismiss="modal"
            >
                Batal
            </button>

            <form
                action="{{ route('berita.destroy', $item->id_berita) }}"
                method="POST"
                class="d-inline"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger"
                >
                    <i class="bi bi-trash me-1"></i>
                    Ya, Hapus
                </button>

            </form>

        </div>

    </div>

</div>

</div>

@endforeach

<!-- =========================================
     SEARCH & FILTER JAVASCRIPT
========================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchBerita');
    const filterKategori = document.getElementById('filterKategoriBerita');
    const rows = document.querySelectorAll('.berita-row');
    const jumlah = document.getElementById('jumlahBerita');

    function filterBerita() {

        const keyword = searchInput.value
            .toLowerCase()
            .trim();

        const kategori = filterKategori.value
            .toLowerCase()
            .trim();

        let visibleCount = 0;

        rows.forEach(function (row) {

            const cocokSearch =
                row.dataset.search.toLowerCase().includes(keyword);

            const cocokKategori =
                !kategori || row.dataset.kategori === kategori;

            if (cocokSearch && cocokKategori) {

                row.style.display = '';
                visibleCount++;

            } else {

                row.style.display = 'none';

            }

        });

        jumlah.textContent = visibleCount;
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterBerita);
    }

    if (filterKategori) {
        filterKategori.addEventListener('change', filterBerita);
    }

    // Buka otomatis modal tambah bila ada error validasi saat menambah.
    @if($errors->any() && old('_form') === 'tambah')
    const modalTambah = new bootstrap.Modal(document.getElementById('modalTambahBerita'));
    modalTambah.show();
    @endif

});

</script>

@endsection
