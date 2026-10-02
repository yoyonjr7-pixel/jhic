@extends('layouts.admin')

@section('title', 'Prestasi')

@section('page-title', 'Prestasi')

@section('content')

<!-- =========================================
     HEADER
========================================= -->

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <span class="welcome-label">
            PRESTASI
        </span>

    <h2 class="fw-bold mt-3 mb-1">
        Prestasi Siswa
    </h2>

    <p class="text-muted mb-0">
        Kelola data prestasi dan pencapaian siswa.
    </p>
</div>

<button
    type="button"
    class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#modalTambahPrestasi"
>
    <i class="bi bi-plus-lg me-1"></i>
    Tambah Prestasi
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

<!-- TOTAL -->
<div class="col-xl-3 col-md-6">
    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>
                <p class="stat-label">
                    Total Prestasi
                </p>

                <h2 class="stat-number">
                    {{ $prestasi->count() }}
                </h2>

                <span class="stat-status info">
                    <i class="bi bi-trophy"></i>
                    Semua pencapaian
                </span>
            </div>

            <div class="stat-icon primary">
                <i class="bi bi-trophy-fill"></i>
            </div>

        </div>

    </div>
</div>


<!-- JUARA 1 -->
<div class="col-xl-3 col-md-6">
    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>
                <p class="stat-label">
                    Juara 1
                </p>

                <h2 class="stat-number">
                    {{ $prestasi->filter(function ($item) {
                        return in_array(strtolower(trim($item->juara ?? '')), ['1', 'juara 1', 'juara i', 'i']);
                    })->count() }}
                </h2>

                <span class="stat-status success">
                    <i class="bi bi-award"></i>
                    Peringkat pertama
                </span>
            </div>

            <div class="stat-icon success">
                <i class="bi bi-award-fill"></i>
            </div>

        </div>

    </div>
</div>


<!-- TINGKAT NASIONAL -->
<div class="col-xl-3 col-md-6">
    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>
                <p class="stat-label">
                    Tingkat Nasional
                </p>

                <h2 class="stat-number">
                    {{ $prestasi->filter(function ($item) {
                        return strtolower(trim($item->tingkat ?? '')) === 'nasional';
                    })->count() }}
                </h2>

                <span class="stat-status info">
                    <i class="bi bi-globe2"></i>
                    Kompetisi nasional
                </span>
            </div>

            <div class="stat-icon info">
                <i class="bi bi-globe2"></i>
            </div>

        </div>

    </div>
</div>


<!-- TAHUN TERBARU -->
<div class="col-xl-3 col-md-6">
    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>
                <p class="stat-label">
                    Tahun Terbaru
                </p>

                <h2 class="stat-number">
                    {{ $prestasi->max('tahun') ?? '-' }}
                </h2>

                <span class="stat-status warning">
                    <i class="bi bi-calendar-event"></i>
                    Pencapaian terbaru
                </span>
            </div>

            <div class="stat-icon warning">
                <i class="bi bi-calendar-event"></i>
            </div>

        </div>

    </div>
</div>

</div>

<!-- =========================================
     DATA PRESTASI
========================================= -->

<div class="dashboard-card">

<!-- HEADER CARD -->
<div class="dashboard-card-header">

    <div>
        <h5 class="dashboard-card-title">
            Data Prestasi
        </h5>

        <p class="dashboard-card-subtitle">
            Daftar pencapaian dan prestasi siswa.
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
                placeholder="Cari prestasi..."
                id="searchPrestasi"
            >
        </div>


        <select
            class="form-select form-select-sm"
            style="width: 160px;"
            id="filterTingkatPrestasi"
        >
            <option value="">
                Semua Tingkat
            </option>

            <option value="sekolah">
                Sekolah
            </option>

            <option value="kecamatan">
                Kecamatan
            </option>

            <option value="kota">
                Kota
            </option>

            <option value="provinsi">
                Provinsi
            </option>

            <option value="nasional">
                Nasional
            </option>

            <option value="internasional">
                Internasional
            </option>
        </select>

    </div>

</div>


<!-- TABLE -->
<div class="table-responsive">

    <table class="table dashboard-table align-middle mb-0">

        <thead>
            <tr>
                <th>Prestasi</th>
                <th>Pemenang</th>
                <th>Jurusan</th>
                <th>Tingkat</th>
                <th>Juara</th>
                <th>Tahun</th>
                <th class="text-end">
                    Aksi
                </th>
            </tr>
        </thead>


        <tbody id="prestasiTableBody">

            @forelse($prestasi as $item)

                <tr
                    class="prestasi-row"
                    data-search="
                        {{ strtolower(
                            ($item->judul_prestasi ?? '') . ' ' .
                            ($item->nama_pemenang ?? '') . ' ' .
                            ($item->kelas ?? '') . ' ' .
                            ($item->jurusan->nama_jurusan ?? '') . ' ' .
                            ($item->tingkat ?? '') . ' ' .
                            ($item->juara ?? '') . ' ' .
                            ($item->tahun ?? '')
                        ) }}
                    "
                    data-tingkat="{{ strtolower($item->tingkat ?? '') }}"
                >

                    <!-- PRESTASI -->
                    <td>

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="stat-icon primary flex-shrink-0"
                                style="width: 42px; height: 42px;"
                            >
                                <i class="bi bi-trophy-fill"></i>
                            </div>

                            <div>

                                <strong>
                                    {{ $item->judul_prestasi }}
                                </strong>

                                @if($item->deskripsi)
                                    <small class="d-block text-muted">
                                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 55) }}
                                    </small>
                                @endif

                            </div>

                        </div>

                    </td>


                    <!-- PEMENANG -->
                    <td>

                        <div class="student-info">

                            <div class="student-avatar primary">
                                {{ strtoupper(substr($item->nama_pemenang ?? '?', 0, 1)) }}
                            </div>

                            <div>

                                <strong>
                                    {{ $item->nama_pemenang }}
                                </strong>

                                @if($item->kelas)
                                    <small class="d-block text-muted">
                                        {{ $item->kelas }}
                                    </small>
                                @endif

                            </div>

                        </div>

                    </td>


                    <!-- JURUSAN -->
                    <td>

                        <span class="major-badge">
                            {{ $item->jurusan->nama_jurusan ?? '-' }}
                        </span>

                    </td>


                    <!-- TINGKAT -->
                    <td>

                        @if($item->tingkat)

                            @php
                                $tingkatClass = match(strtolower($item->tingkat)) {
                                    'nasional' => 'success',
                                    'internasional' => 'info',
                                    'provinsi' => 'primary',
                                    'kota' => 'warning',
                                    'kecamatan' => 'warning',
                                    'sekolah' => 'info',
                                    default => 'info',
                                };
                            @endphp

                            <span class="status-badge {{ $tingkatClass }}">
                                {{ $item->tingkat }}
                            </span>

                        @else

                            <span class="text-muted">
                                -
                            </span>

                        @endif

                    </td>


                    <!-- JUARA -->
                    <td>

                        @if($item->juara)

                            <span class="badge bg-primary">
                                <i class="bi bi-award me-1"></i>
                                {{ $item->juara }}
                            </span>

                        @else

                            <span class="text-muted">
                                -
                            </span>

                        @endif

                    </td>


                    <!-- TAHUN -->
                    <td>

                        <strong>
                            {{ $item->tahun ?? '-' }}
                        </strong>

                    </td>


                    <!-- AKSI -->
                    <td class="text-end">

                        <div class="d-inline-flex gap-1">

                            <!-- DETAIL -->
                            <button
                                type="button"
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDetailPrestasi{{ $item->id_prestasi }}"
                                title="Detail"
                            >
                                <i class="bi bi-eye"></i>
                            </button>


                            <!-- EDIT -->
                            <button
                                type="button"
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditPrestasi{{ $item->id_prestasi }}"
                                title="Edit"
                            >
                                <i class="bi bi-pencil"></i>
                            </button>


                            <!-- HAPUS -->
                            <button
                                type="button"
                                class="btn btn-sm btn-light text-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalHapusPrestasi{{ $item->id_prestasi }}"
                                title="Hapus"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>

                    </td>

                </tr>

            @empty

                <tr id="emptyPrestasiRow">

                    <td colspan="7" class="text-center py-5">

                        <div class="text-muted">

                            <i class="bi bi-trophy fs-2 d-block mb-2"></i>

                            Belum ada data prestasi.

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

        <span id="jumlahPrestasi">
            {{ $prestasi->count() }}
        </span>

        data prestasi

    </small>

</div>

</div>

<!-- =====================================================
     MODAL TAMBAH
===================================================== -->

<div
    class="modal fade"
    id="modalTambahPrestasi"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        <form
            action="{{ route('prestasi.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="modal-header">

                <div>
                    <h5 class="modal-title fw-bold">
                        Tambah Prestasi
                    </h5>

                    <small class="text-muted">
                        Tambahkan pencapaian siswa.
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
                            Judul Prestasi
                        </label>

                        <input
                            type="text"
                            name="judul_prestasi"
                            class="form-control"
                            placeholder="Contoh: Lomba Kompetensi Siswa"
                            value="{{ old('judul_prestasi') }}"
                            required
                        >

                    </div>


                    <!-- PEMENANG -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Pemenang
                        </label>

                        <input
                            type="text"
                            name="nama_pemenang"
                            class="form-control"
                            placeholder="Nama siswa"
                            value="{{ old('nama_pemenang') }}"
                            required
                        >

                    </div>


                    <!-- KELAS -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Kelas
                        </label>

                        <input
                            type="text"
                            name="kelas"
                            class="form-control"
                            placeholder="Contoh: XII TKJ 1"
                            value="{{ old('kelas') }}"
                        >

                    </div>


                    <!-- JURUSAN -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Jurusan
                        </label>

                        <select
                            name="id_jurusan"
                            class="form-select"
                        >

                            <option value="">
                                Pilih Jurusan
                            </option>

                            @foreach($jurusan as $itemJurusan)

                                <option
                                    value="{{ $itemJurusan->id_jurusan }}"
                                    {{ old('id_jurusan') == $itemJurusan->id_jurusan ? 'selected' : '' }}
                                >
                                    {{ $itemJurusan->nama_jurusan }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- TINGKAT -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tingkat
                        </label>

                        <select
                            name="tingkat"
                            class="form-select"
                        >

                            <option value="">
                                Pilih Tingkat
                            </option>

                            <option value="Sekolah">
                                Sekolah
                            </option>

                            <option value="Kecamatan">
                                Kecamatan
                            </option>

                            <option value="Kota">
                                Kota
                            </option>

                            <option value="Provinsi">
                                Provinsi
                            </option>

                            <option value="Nasional">
                                Nasional
                            </option>

                            <option value="Internasional">
                                Internasional
                            </option>

                        </select>

                    </div>


                    <!-- JUARA -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Juara / Peringkat
                        </label>

                        <input
                            type="text"
                            name="juara"
                            class="form-control"
                            placeholder="Contoh: Juara 1"
                            value="{{ old('juara') }}"
                        >

                    </div>


                    <!-- TAHUN -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tahun
                        </label>

                        <input
                            type="number"
                            name="tahun"
                            class="form-control"
                            min="2000"
                            max="2100"
                            placeholder="Contoh: 2026"
                            value="{{ old('tahun') }}"
                        >

                    </div>


                    <!-- FOTO -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Foto Prestasi
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


                    <!-- DESKRIPSI -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="4"
                            placeholder="Deskripsi singkat mengenai prestasi..."
                        >{{ old('deskripsi') }}</textarea>

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
                    Simpan Prestasi
                </button>

            </div>

        </form>

    </div>

</div>

</div>

<!-- =====================================================
     MODAL DETAIL
===================================================== -->

@foreach($prestasi as $item)

<div
    class="modal fade"
    id="modalDetailPrestasi{{ $item->id_prestasi }}"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        <div class="modal-header">

            <div>
                <h5 class="modal-title fw-bold">
                    Detail Prestasi
                </h5>

                <small class="text-muted">
                    Informasi lengkap pencapaian siswa.
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
                <div class="col-md-4">

                    @if($item->foto)

                        <img
                            src="{{ $item->fotoUrl() }}"
                            alt="{{ $item->judul_prestasi }}"
                            class="img-fluid rounded-3 w-100"
                            style="max-height: 260px; object-fit: cover;"
                        >

                    @else

                        <div
                            class="d-flex align-items-center justify-content-center bg-light rounded-3"
                            style="height: 220px;"
                        >
                            <div class="text-center text-muted">

                                <i class="bi bi-image fs-1 d-block mb-2"></i>

                                Tidak ada foto

                            </div>
                        </div>

                    @endif

                </div>


                <!-- INFORMASI -->
                <div class="col-md-8">

                    <span class="welcome-label">
                        PRESTASI
                    </span>

                    <h4 class="fw-bold mt-2">
                        {{ $item->judul_prestasi }}
                    </h4>


                    <div class="row g-3 mt-1">

                        <div class="col-sm-6">

                            <small class="text-muted d-block">
                                Nama Pemenang
                            </small>

                            <strong>
                                {{ $item->nama_pemenang }}
                            </strong>

                        </div>


                        <div class="col-sm-6">

                            <small class="text-muted d-block">
                                Kelas
                            </small>

                            <strong>
                                {{ $item->kelas ?? '-' }}
                            </strong>

                        </div>


                        <div class="col-sm-6">

                            <small class="text-muted d-block">
                                Jurusan
                            </small>

                            <strong>
                                {{ $item->jurusan->nama_jurusan ?? '-' }}
                            </strong>

                        </div>


                        <div class="col-sm-6">

                            <small class="text-muted d-block">
                                Tingkat
                            </small>

                            <strong>
                                {{ $item->tingkat ?? '-' }}
                            </strong>

                        </div>


                        <div class="col-sm-6">

                            <small class="text-muted d-block">
                                Juara
                            </small>

                            <strong>
                                {{ $item->juara ?? '-' }}
                            </strong>

                        </div>


                        <div class="col-sm-6">

                            <small class="text-muted d-block">
                                Tahun
                            </small>

                            <strong>
                                {{ $item->tahun ?? '-' }}
                            </strong>

                        </div>

                    </div>

                </div>


                <!-- DESKRIPSI -->
                @if($item->deskripsi)

                    <div class="col-12">

                        <div class="bg-light rounded-3 p-3">

                            <h6 class="fw-bold mb-2">
                                <i class="bi bi-card-text me-1"></i>
                                Deskripsi
                            </h6>

                            <p class="text-muted mb-0">
                                {{ $item->deskripsi }}
                            </p>

                        </div>

                    </div>

                @endif

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
                data-bs-target="#modalEditPrestasi{{ $item->id_prestasi }}"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit
            </button>

        </div>

    </div>

</div>

</div>

<!-- =====================================================
     MODAL EDIT
===================================================== -->

<div
    class="modal fade"
    id="modalEditPrestasi{{ $item->id_prestasi }}"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        <form
            action="{{ route('prestasi.update', $item->id_prestasi) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <div class="modal-header">

                <div>
                    <h5 class="modal-title fw-bold">
                        Edit Prestasi
                    </h5>

                    <small class="text-muted">
                        Perbarui data pencapaian siswa.
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
                            Judul Prestasi
                        </label>

                        <input
                            type="text"
                            name="judul_prestasi"
                            class="form-control"
                            value="{{ $item->judul_prestasi }}"
                            required
                        >

                    </div>


                    <!-- PEMENANG -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Pemenang
                        </label>

                        <input
                            type="text"
                            name="nama_pemenang"
                            class="form-control"
                            value="{{ $item->nama_pemenang }}"
                            required
                        >

                    </div>


                    <!-- KELAS -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Kelas
                        </label>

                        <input
                            type="text"
                            name="kelas"
                            class="form-control"
                            value="{{ $item->kelas }}"
                        >

                    </div>


                    <!-- JURUSAN -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Jurusan
                        </label>

                        <select
                            name="id_jurusan"
                            class="form-select"
                        >

                            <option value="">
                                Pilih Jurusan
                            </option>

                            @foreach($jurusan as $itemJurusan)

                                <option
                                    value="{{ $itemJurusan->id_jurusan }}"
                                    {{ $item->id_jurusan == $itemJurusan->id_jurusan ? 'selected' : '' }}
                                >
                                    {{ $itemJurusan->nama_jurusan }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- TINGKAT -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tingkat
                        </label>

                        <select
                            name="tingkat"
                            class="form-select"
                        >

                            <option value="">
                                Pilih Tingkat
                            </option>

                            <option value="Sekolah" {{ strtolower($item->tingkat ?? '') === 'sekolah' ? 'selected' : '' }}>
                                Sekolah
                            </option>

                            <option value="Kecamatan" {{ strtolower($item->tingkat ?? '') === 'kecamatan' ? 'selected' : '' }}>
                                Kecamatan
                            </option>

                            <option value="Kota" {{ strtolower($item->tingkat ?? '') === 'kota' ? 'selected' : '' }}>
                                Kota
                            </option>

                            <option value="Provinsi" {{ strtolower($item->tingkat ?? '') === 'provinsi' ? 'selected' : '' }}>
                                Provinsi
                            </option>

                            <option value="Nasional" {{ strtolower($item->tingkat ?? '') === 'nasional' ? 'selected' : '' }}>
                                Nasional
                            </option>

                            <option value="Internasional" {{ strtolower($item->tingkat ?? '') === 'internasional' ? 'selected' : '' }}>
                                Internasional
                            </option>

                        </select>

                    </div>


                    <!-- JUARA -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Juara / Peringkat
                        </label>

                        <input
                            type="text"
                            name="juara"
                            class="form-control"
                            value="{{ $item->juara }}"
                        >

                    </div>


                    <!-- TAHUN -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tahun
                        </label>

                        <input
                            type="number"
                            name="tahun"
                            class="form-control"
                            min="2000"
                            max="2100"
                            value="{{ $item->tahun }}"
                        >

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
                                Foto saat ini tersedia. Upload foto baru jika ingin menggantinya.
                            </small>

                        @endif

                    </div>


                    <!-- DESKRIPSI -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="4"
                        >{{ $item->deskripsi }}</textarea>

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
     MODAL HAPUS
===================================================== -->

<div
    class="modal fade"
    id="modalHapusPrestasi{{ $item->id_prestasi }}"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        <div class="modal-header">

            <h5 class="modal-title fw-bold">
                Hapus Prestasi
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
                Yakin ingin menghapus data ini?
            </h5>

            <p class="text-muted mb-0">

                Data prestasi

                <strong>
                    "{{ $item->judul_prestasi }}"
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
                action="{{ route('prestasi.destroy', $item->id_prestasi) }}"
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

    const searchInput = document.getElementById('searchPrestasi');
    const filterTingkat = document.getElementById('filterTingkatPrestasi');
    const rows = document.querySelectorAll('.prestasi-row');
    const jumlah = document.getElementById('jumlahPrestasi');

    function filterPrestasi() {

        const keyword = searchInput.value
            .toLowerCase()
            .trim();

        const tingkat = filterTingkat.value
            .toLowerCase()
            .trim();

        let visibleCount = 0;

        rows.forEach(function (row) {

            const searchData =
                row.dataset.search.toLowerCase();

            const rowTingkat =
                row.dataset.tingkat.toLowerCase();

            const cocokSearch =
                searchData.includes(keyword);

            const cocokTingkat =
                !tingkat || rowTingkat === tingkat;

            if (cocokSearch && cocokTingkat) {

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
            filterPrestasi
        );
    }


    if (filterTingkat) {
        filterTingkat.addEventListener(
            'change',
            filterPrestasi
        );
    }

});

</script>

@endsection
