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
        BERITA TERBARU
    </span>

    <h2 class="fw-bold mt-3 mb-1">
        Berita Sekolah
    </h2>

    <p class="text-muted mb-0">
        Kelola informasi dan berita terbaru sekolah.
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
     ALERT ERROR
========================================= -->

@if($errors->any())

<div class="alert alert-danger alert-dismissible fade show" role="alert">

<strong>
    Data belum berhasil diproses.
</strong>

<ul class="mb-0 mt-2">

    @foreach($errors->all() as $error)

        <li>
            {{ $error }}
        </li>

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

                    Semua berita

                </span>

            </div>


            <div class="stat-icon primary">

                <i class="bi bi-newspaper"></i>

            </div>

        </div>

    </div>

</div>


<!-- TERBIT -->

<div class="col-xl-3 col-md-6">

    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>

                <p class="stat-label">
                    Berita Terbit
                </p>

                <h2 class="stat-number">

                    {{ $berita->where('status', 'Terbit')->count() }}

                </h2>

                <span class="stat-status success">

                    <i class="bi bi-check-circle"></i>

                    Sudah dipublikasikan

                </span>

            </div>


            <div class="stat-icon success">

                <i class="bi bi-check-circle-fill"></i>

            </div>

        </div>

    </div>

</div>


<!-- DRAFT -->

<div class="col-xl-3 col-md-6">

    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>

                <p class="stat-label">
                    Draft
                </p>

                <h2 class="stat-number">

                    {{ $berita->where('status', 'Draft')->count() }}

                </h2>

                <span class="stat-status warning">

                    <i class="bi bi-pencil-square"></i>

                    Belum diterbitkan

                </span>

            </div>


            <div class="stat-icon warning">

                <i class="bi bi-file-earmark-text"></i>

            </div>

        </div>

    </div>

</div>


<!-- KATEGORI -->

<div class="col-xl-3 col-md-6">

    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>

                <p class="stat-label">
                    Kategori
                </p>

                <h2 class="stat-number">

                    {{ $berita->whereNotNull('kategori')->where('kategori', '!=', '')->unique('kategori')->count() }}

                </h2>

                <span class="stat-status info">

                    <i class="bi bi-tags"></i>

                    Jenis berita

                </span>

            </div>


            <div class="stat-icon info">

                <i class="bi bi-tags-fill"></i>

            </div>

        </div>

    </div>

</div>

</div>

<!-- =========================================
     DATA BERITA
========================================= -->

<div class="dashboard-card">

<!-- CARD HEADER -->

<div class="dashboard-card-header">

    <div>

        <h5 class="dashboard-card-title">
            Data Berita
        </h5>

        <p class="dashboard-card-subtitle">
            Daftar berita dan informasi sekolah.
        </p>

    </div>


    <!-- SEARCH + FILTER -->

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
            style="width: 150px;"
            id="filterStatusBerita"
        >

            <option value="">
                Semua Status
            </option>

            <option value="terbit">
                Terbit
            </option>

            <option value="draft">
                Draft
            </option>

        </select>

    </div>

</div>


<!-- =========================================
     TABLE
========================================= -->

<div class="table-responsive">

    <table class="table dashboard-table align-middle mb-0">

        <thead>

            <tr>

                <th>Berita</th>

                <th>Kategori</th>

                <th>Penulis</th>

                <th>Status</th>

                <th>Tanggal</th>

                <th class="text-end">
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody id="beritaTableBody">


            @forelse($berita as $item)


                <tr
                    class="berita-row"
                    data-search="{{ strtolower(
                        ($item->judul ?? '') . ' ' .
                        ($item->kategori ?? '') . ' ' .
                        ($item->penulis ?? '') . ' ' .
                        ($item->isi ?? '')
                    ) }}"
                    data-status="{{ strtolower($item->status ?? '') }}"
                >


                    <!-- BERITA -->

                    <td>

                        <div class="d-flex align-items-center gap-3">


                            <!-- THUMBNAIL -->

                            @if($item->foto)

                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->judul }}"
                                    class="rounded-3 flex-shrink-0"
                                    style="
                                        width: 55px;
                                        height: 55px;
                                        object-fit: cover;
                                    "
                                >

                            @else

                                <div
                                    class="stat-icon primary flex-shrink-0"
                                    style="
                                        width: 55px;
                                        height: 55px;
                                    "
                                >

                                    <i class="bi bi-newspaper"></i>

                                </div>

                            @endif


                            <div>

                                <strong>
                                    {{ $item->judul }}
                                </strong>


                                <small class="d-block text-muted">

                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($item->isi),
                                        60
                                    ) }}

                                </small>

                            </div>

                        </div>

                    </td>


                    <!-- KATEGORI -->

                    <td>

                        @if($item->kategori)

                            <span class="major-badge">
                                {{ $item->kategori }}
                            </span>

                        @else

                            <span class="text-muted">
                                -
                            </span>

                        @endif

                    </td>


                    <!-- PENULIS -->

                    <td>

                        <div class="student-info">

                            <div class="student-avatar primary">

                                {{ strtoupper(
                                    substr(
                                        $item->penulis ?? 'A',
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <div>

                                <strong>
                                    {{ $item->penulis ?? 'Admin' }}
                                </strong>

                            </div>

                        </div>

                    </td>


                    <!-- STATUS -->

                    <td>

                        @if($item->status === 'Terbit')

                            <span class="status-badge success">
                                Terbit
                            </span>

                        @else

                            <span class="status-badge warning">
                                Draft
                            </span>

                        @endif

                    </td>


                    <!-- TANGGAL -->

                    <td>

                        @if($item->tanggal_publish)

                            <strong>
                                {{ $item->tanggal_publish->format('d M Y') }}
                            </strong>

                        @else

                            <span class="text-muted">
                                -
                            </span>

                        @endif

                    </td>


                    <!-- AKSI -->

                    <td class="text-end">

                        <div class="d-inline-flex gap-1">


                            <!-- DETAIL -->

                            <button
                                type="button"
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDetailBerita{{ $item->id_berita }}"
                                title="Detail"
                            >

                                <i class="bi bi-eye"></i>

                            </button>


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

                    <td
                        colspan="6"
                        class="text-center py-5"
                    >

                        <div class="text-muted">

                            <i class="bi bi-newspaper fs-2 d-block mb-2"></i>

                            Belum ada berita.

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
     MODAL TAMBAH BERITA
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


            <!-- HEADER -->

            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">
                        Tambah Berita
                    </h5>

                    <small class="text-muted">
                        Tambahkan berita atau informasi sekolah.
                    </small>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <!-- BODY -->

            <div class="modal-body">

                <div class="row g-3">


                    <!-- JUDUL -->

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Judul Berita
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            placeholder="Contoh: Siswa SMK Raih Juara Kompetisi Nasional"
                            value="{{ old('judul') }}"
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
                        >

                            <option value="">
                                Pilih Kategori
                            </option>

                            <option value="Akademik">
                                Akademik
                            </option>

                            <option value="Prestasi">
                                Prestasi
                            </option>

                            <option value="Kegiatan">
                                Kegiatan
                            </option>

                            <option value="Pengumuman">
                                Pengumuman
                            </option>

                            <option value="Sekolah">
                                Sekolah
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

                        </select>

                    </div>


                    <!-- PENULIS -->

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Penulis
                        </label>

                        <input
                            type="text"
                            name="penulis"
                            class="form-control"
                            placeholder="Nama penulis"
                            value="{{ old('penulis') }}"
                        >

                    </div>


                    <!-- TANGGAL -->

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tanggal Publikasi
                        </label>

                        <input
                            type="date"
                            name="tanggal_publish"
                            class="form-control"
                            value="{{ old('tanggal_publish', date('Y-m-d')) }}"
                        >

                    </div>


                    <!-- STATUS -->

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option
                                value="Draft"
                                {{ old('status', 'Draft') === 'Draft' ? 'selected' : '' }}
                            >
                                Draft
                            </option>

                            <option
                                value="Terbit"
                                {{ old('status') === 'Terbit' ? 'selected' : '' }}
                            >
                                Terbit
                            </option>

                        </select>

                    </div>


                    <!-- FOTO -->

                    <div class="col-12">

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


                    <!-- ISI -->

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Isi Berita
                        </label>

                        <textarea
                            name="isi"
                            class="form-control"
                            rows="7"
                            placeholder="Tulis isi berita di sini..."
                            required
                        >{{ old('isi') }}</textarea>

                    </div>

                </div>

            </div>


            <!-- FOOTER -->

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
     MODAL DETAIL + EDIT + HAPUS
===================================================== -->

@foreach($berita as $item)

<!-- =====================================================
     DETAIL
===================================================== -->

<div
    class="modal fade"
    id="modalDetailBerita{{ $item->id_berita }}"
    tabindex="-1"
    aria-hidden="true"
>

<div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 shadow">


        <div class="modal-header">

            <div>

                <h5 class="modal-title fw-bold">
                    Detail Berita
                </h5>

                <small class="text-muted">
                    Informasi lengkap berita sekolah.
                </small>

            </div>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
            ></button>

        </div>


        <div class="modal-body">

            <div class="row g-4">


                <!-- FOTO -->

                @if($item->foto)

                    <div class="col-12">

                        <img
                            src="{{ asset('storage/' . $item->foto) }}"
                            alt="{{ $item->judul }}"
                            class="img-fluid rounded-3 w-100"
                            style="
                                max-height: 320px;
                                object-fit: cover;
                            "
                        >

                    </div>

                @endif


                <!-- INFORMASI -->

                <div class="col-12">

                    <span class="welcome-label">
                        {{ $item->kategori ?? 'BERITA' }}
                    </span>


                    <h3 class="fw-bold mt-2 mb-2">
                        {{ $item->judul }}
                    </h3>


                    <div class="d-flex flex-wrap gap-3 text-muted mb-4">

                        <span>

                            <i class="bi bi-person me-1"></i>

                            {{ $item->penulis ?? 'Admin' }}

                        </span>


                        <span>

                            <i class="bi bi-calendar3 me-1"></i>

                            @if($item->tanggal_publish)

                                {{ $item->tanggal_publish->format('d M Y') }}

                            @else

                                -

                            @endif

                        </span>


                        <span>

                            <i class="bi bi-circle-fill me-1"
                               style="font-size: 7px;"></i>

                            {{ $item->status }}

                        </span>

                    </div>


                    <div class="bg-light rounded-3 p-4">

                        <p
                            class="text-muted mb-0"
                            style="white-space: pre-line;"
                        >
                            {{ $item->isi }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn btn-light"
                data-bs-dismiss="modal"
            >
                Tutup
            </button>


            <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                data-bs-toggle="modal"
                data-bs-target="#modalEditBerita{{ $item->id_berita }}"
            >

                <i class="bi bi-pencil me-1"></i>

                Edit

            </button>

        </div>

    </div>

</div>

</div>

<!-- =====================================================
     EDIT
===================================================== -->

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


            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">
                        Edit Berita
                    </h5>

                    <small class="text-muted">
                        Perbarui informasi berita.
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
                            name="judul"
                            class="form-control"
                            value="{{ $item->judul }}"
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
                        >

                            <option value="">
                                Pilih Kategori
                            </option>

                            <option
                                value="Akademik"
                                {{ $item->kategori === 'Akademik' ? 'selected' : '' }}
                            >
                                Akademik
                            </option>

                            <option
                                value="Prestasi"
                                {{ $item->kategori === 'Prestasi' ? 'selected' : '' }}
                            >
                                Prestasi
                            </option>

                            <option
                                value="Kegiatan"
                                {{ $item->kategori === 'Kegiatan' ? 'selected' : '' }}
                            >
                                Kegiatan
                            </option>

                            <option
                                value="Pengumuman"
                                {{ $item->kategori === 'Pengumuman' ? 'selected' : '' }}
                            >
                                Pengumuman
                            </option>

                            <option
                                value="Sekolah"
                                {{ $item->kategori === 'Sekolah' ? 'selected' : '' }}
                            >
                                Sekolah
                            </option>

                            <option
                                value="Lainnya"
                                {{ $item->kategori === 'Lainnya' ? 'selected' : '' }}
                            >
                                Lainnya
                            </option>

                        </select>

                    </div>


                    <!-- PENULIS -->

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Penulis
                        </label>

                        <input
                            type="text"
                            name="penulis"
                            class="form-control"
                            value="{{ $item->penulis }}"
                        >

                    </div>


                    <!-- TANGGAL -->

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tanggal Publikasi
                        </label>

                        <input
                            type="date"
                            name="tanggal_publish"
                            class="form-control"
                            value="{{ $item->tanggal_publish?->format('Y-m-d') }}"
                        >

                    </div>


                    <!-- STATUS -->

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option
                                value="Draft"
                                {{ $item->status === 'Draft' ? 'selected' : '' }}
                            >
                                Draft
                            </option>

                            <option
                                value="Terbit"
                                {{ $item->status === 'Terbit' ? 'selected' : '' }}
                            >
                                Terbit
                            </option>

                        </select>

                    </div>


                    <!-- FOTO -->

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Ganti Foto
                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >


                        @if($item->foto)

                            <small class="text-muted d-block mt-2">

                                Foto saat ini tersedia.
                                Upload foto baru jika ingin menggantinya.

                            </small>

                        @endif

                    </div>


                    <!-- ISI -->

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Isi Berita
                        </label>

                        <textarea
                            name="isi"
                            class="form-control"
                            rows="7"
                            required
                        >{{ $item->isi }}</textarea>

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

                    <i class="bi bi-save me-1"></i>

                    Simpan Perubahan

                </button>

            </div>


        </form>

    </div>

</div>

</div>

<!-- =====================================================
     HAPUS
===================================================== -->

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
                style="
                    width: 70px;
                    height: 70px;
                "
            >

                <i class="bi bi-trash text-danger fs-3"></i>

            </div>


            <h5 class="fw-bold">
                Yakin ingin menghapus berita ini?
            </h5>


            <p class="text-muted mb-0">

                Berita

                <strong>
                    "{{ $item->judul }}"
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
     SEARCH & FILTER
========================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('searchBerita');

    const filterStatus =
        document.getElementById('filterStatusBerita');

    const rows =
        document.querySelectorAll('.berita-row');

    const jumlah =
        document.getElementById('jumlahBerita');


    function filterBerita() {

        const keyword =
            searchInput.value
                .toLowerCase()
                .trim();


        const status =
            filterStatus.value
                .toLowerCase()
                .trim();


        let visibleCount = 0;


        rows.forEach(function (row) {

            const searchData =
                row.dataset.search.toLowerCase();


            const rowStatus =
                row.dataset.status.toLowerCase();


            const cocokSearch =
                searchData.includes(keyword);


            const cocokStatus =
                !status ||
                rowStatus === status;


            if (cocokSearch && cocokStatus) {

                row.style.display = '';

                visibleCount++;

            } else {

                row.style.display = 'none';

            }

        });


        jumlah.textContent = visibleCount;

    }


    if (searchInput) {

        searchInput.addEventListener(
            'input',
            filterBerita
        );

    }


    if (filterStatus) {

        filterStatus.addEventListener(
            'change',
            filterBerita
        );

    }

});

</script>

@endsection
