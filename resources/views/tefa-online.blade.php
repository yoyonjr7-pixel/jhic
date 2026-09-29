@extends('layouts.admin')

@section('title', 'TEFA Online')

@section('page-title', 'TEFA Online')

@section('content')

<!-- ========================================= -->
<!-- HEADER -->
<!-- ========================================= -->

<div class="d-flex justify-content-between align-items-start mb-4">

    <div>

        <span class="welcome-label">
            TEFA ONLINE
        </span>

        <h2 class="fw-bold mt-3 mb-1">
            TEFA Online
        </h2>

        <p class="text-muted mb-0">
            Kelola pemesanan layanan TEFA dari siswa dan pelanggan.
        </p>

    </div>

    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambahTefa"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Booking
    </button>

</div>


<!-- ========================================= -->
<!-- PESAN SUKSES -->
<!-- ========================================= -->

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


<!-- ========================================= -->
<!-- VALIDATION ERROR -->
<!-- ========================================= -->

@if($errors->any())

<div class="alert alert-danger alert-dismissible fade show" role="alert">

    <strong>Data belum berhasil diproses.</strong>

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


<!-- ========================================= -->
<!-- STATISTIK -->
<!-- ========================================= -->

<div class="row g-3 mb-4">

    <!-- TOTAL -->

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Total Booking
                    </p>

                    <h2 class="stat-number">
                        {{ $booking->count() }}
                    </h2>

                    <span class="stat-status info">
                        <i class="bi bi-collection"></i>
                        Semua pesanan
                    </span>

                </div>

                <div class="stat-icon primary">
                    <i class="bi bi-shop"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- PENDING -->

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Pending
                    </p>

                    <h2 class="stat-number">
                        {{ $booking->where('status_book', 'pending')->count() }}
                    </h2>

                    <span class="stat-status warning">
                        <i class="bi bi-clock"></i>
                        Menunggu diproses
                    </span>

                </div>

                <div class="stat-icon warning">
                    <i class="bi bi-hourglass-split"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- DIPROSES -->

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Diproses
                    </p>

                    <h2 class="stat-number">
                        {{ $booking->where('status_book', 'diproses')->count() }}
                    </h2>

                    <span class="stat-status info">
                        <i class="bi bi-arrow-repeat"></i>
                        Sedang dikerjakan
                    </span>

                </div>

                <div class="stat-icon info">
                    <i class="bi bi-arrow-repeat"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- SELESAI -->

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Selesai
                    </p>

                    <h2 class="stat-number">
                        {{ $booking->where('status_book', 'selesai')->count() }}
                    </h2>

                    <span class="stat-status success">
                        <i class="bi bi-check-circle"></i>
                        Pesanan selesai
                    </span>

                </div>

                <div class="stat-icon success">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- ========================================= -->
<!-- DATA BOOKING -->
<!-- ========================================= -->

<div class="dashboard-card">

    <div class="dashboard-card-header">

        <div>

            <h5 class="dashboard-card-title">
                Data Booking TEFA
            </h5>

            <p class="dashboard-card-subtitle">
                Daftar pemesanan layanan TEFA.
            </p>

        </div>


        <!-- FILTER -->

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
                    placeholder="Cari ID Booking..."
                    id="searchTefa"
                >

            </div>


            <select
                class="form-select form-select-sm"
                style="width: 150px;"
                id="filterStatusTefa"
            >

                <option value="">
                    Semua Status
                </option>

                <option value="pending">
                    Pending
                </option>

                <option value="diproses">
                    Diproses
                </option>

                <option value="selesai">
                    Selesai
                </option>

                <option value="batal">
                    Batal
                </option>

            </select>

        </div>

    </div>


    <!-- ========================================= -->
    <!-- TABLE -->
    <!-- ========================================= -->

    <div class="table-responsive">

        <table class="table dashboard-table align-middle mb-0">

            <thead>

                <tr>

                    <!-- ID BOOKING -->

                    <th>
                        ID Booking
                    </th>

                    <th>
                        Pemesan
                    </th>

                    <th>
                        Jurusan
                    </th>

                    <th>
                        Layanan
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Tanggal
                    </th>

                    <th class="text-end">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody id="tefaTableBody">

                @forelse($booking as $item)

                    <tr
                        class="tefa-row"
                        data-booking-id="{{ $item->id_book }}"
                        data-status="{{ $item->status_book }}"
                    >

                        <!-- ========================================= -->
                        <!-- ID BOOKING -->
                        <!-- ========================================= -->

                        <td>

                            <span class="badge bg-primary">
                                {{ $item->id_book }}
                            </span>

                        </td>


                        <!-- ========================================= -->
                        <!-- PEMESAN -->
                        <!-- ========================================= -->

                        <td>

                            <div class="student-info">

                                <div class="student-avatar primary">

                                    {{ strtoupper(substr($item->transaksi->nama_pelanggan ?? '?', 0, 1)) }}

                                </div>

                                <div>

                                    <strong>
                                        {{ $item->transaksi->nama_pelanggan ?? '-' }}
                                    </strong>

                                    <small class="d-block text-muted">
                                        {{ $item->transaksi->no_telp ?? 'Tidak ada nomor' }}
                                    </small>

                                </div>

                            </div>

                        </td>


                        <!-- ========================================= -->
                        <!-- JURUSAN -->
                        <!-- ========================================= -->

                        <td>

                            <span class="major-badge">

                                @if(
                                    $item->transaksi &&
                                    $item->transaksi->layanan &&
                                    $item->transaksi->layanan->jurusan
                                )

                                    {{ $item->transaksi->layanan->jurusan->nama_jurusan }}

                                @else

                                    -

                                @endif

                            </span>

                        </td>


                        <!-- ========================================= -->
                        <!-- LAYANAN -->
                        <!-- ========================================= -->

                        <td>

                            <strong>
                                {{ $item->transaksi->layanan->nama_layanan ?? '-' }}
                            </strong>

                            @if($item->transaksi->layanan)

                                <small class="d-block text-muted">

                                    Rp
                                    {{ number_format($item->transaksi->layanan->harga, 0, ',', '.') }}

                                </small>

                                @if($item->tambahan->count() > 0)

                                    <small class="d-block text-warning mt-1">

                                        <i class="bi bi-plus-circle"></i>

                                        {{ $item->tambahan->count() }}

                                        pekerjaan tambahan

                                    </small>

                                @endif

                            @endif

                        </td>


                        <!-- ========================================= -->
                        <!-- STATUS -->
                        <!-- ========================================= -->

                        <td>

                            @if($item->status_book === 'pending')

                                <span class="status-badge warning">
                                    Pending
                                </span>

                            @elseif($item->status_book === 'diproses')

                                <span class="status-badge info">
                                    Diproses
                                </span>

                            @elseif($item->status_book === 'selesai')

                                <span class="status-badge success">
                                    Selesai
                                </span>

                            @elseif($item->status_book === 'batal')

                                <span class="status-badge danger">
                                    Batal
                                </span>

                            @else

                                <span class="status-badge danger">
                                    {{ $item->status_book }}
                                </span>

                            @endif

                        </td>


                        <!-- ========================================= -->
                        <!-- TANGGAL -->
                        <!-- ========================================= -->

                        <td>

                            @if($item->transaksi && $item->transaksi->tanggal)

                                {{ $item->transaksi->tanggal->format('d M Y') }}

                            @else

                                -

                            @endif

                        </td>


                        <!-- ========================================= -->
                        <!-- AKSI -->
                        <!-- ========================================= -->

                        <td class="text-end">

                            <div class="d-inline-flex gap-1">

                                <!-- DETAIL -->

                                <button
                                    type="button"
                                    class="btn btn-sm btn-light"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDetailTefa{{ $item->id_book }}"
                                    title="Detail"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>


                                <!-- EDIT -->

                                <button
                                    type="button"
                                    class="btn btn-sm btn-light"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditTefa{{ $item->id_book }}"
                                    title="Edit"
                                >

                                    <i class="bi bi-pencil"></i>

                                </button>


                                <!-- HAPUS -->

                                <button
                                    type="button"
                                    class="btn btn-sm btn-light text-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapusTefa{{ $item->id_book }}"
                                    title="Hapus"
                                >

                                    <i class="bi bi-trash"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr id="emptyTefaRow">

                        <td
                            colspan="7"
                            class="text-center py-5"
                        >

                            <div class="text-muted">

                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                                Belum ada data booking TEFA.

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <!-- ========================================= -->
    <!-- INFO -->
    <!-- ========================================= -->

    <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">

        <small class="text-muted">

            Menampilkan

            <span id="jumlahTefa">
                {{ $booking->count() }}
            </span>

            data booking

        </small>

    </div>

</div>


<!-- ========================================= -->
<!-- MODAL TAMBAH BOOKING -->
<!-- ========================================= -->

<div
    class="modal fade"
    id="modalTambahTefa"
    tabindex="-1"
    aria-labelledby="modalTambahTefaLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">

                <div>

                    <h5
                        class="modal-title fw-bold"
                        id="modalTambahTefaLabel"
                    >
                        Tambah Booking TEFA
                    </h5>

                    <small class="text-muted">
                        Tambahkan pemesanan layanan TEFA.
                    </small>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <form
                action="{{ route('tefa.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        <!-- NAMA -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nama Pelanggan
                            </label>

                            <input
                                type="text"
                                name="nama_pelanggan"
                                class="form-control"
                                placeholder="Masukkan nama pelanggan"
                                value="{{ old('nama_pelanggan') }}"
                                required
                            >

                        </div>


                        <!-- TELEPON -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                No. Telepon
                            </label>

                            <input
                                type="text"
                                name="no_telp"
                                class="form-control"
                                placeholder="Contoh: 081234567890"
                                value="{{ old('no_telp') }}"
                            >

                        </div>


                        <!-- LAYANAN -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Layanan
                            </label>

                            <select
                                name="id_layanan"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    -- Pilih Layanan --
                                </option>

                                @foreach($layanan as $layananItem)

                                    <option
                                        value="{{ $layananItem->id_layanan }}"
                                        {{ old('id_layanan') == $layananItem->id_layanan ? 'selected' : '' }}
                                    >

                                        {{ $layananItem->nama_layanan }}

                                        @if($layananItem->jurusan)

                                            -
                                            {{ $layananItem->jurusan->nama_jurusan }}

                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- GURU -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Guru / Penanggung Jawab
                            </label>

                            <select
                                name="id_guru"
                                class="form-select"
                            >

                                <option value="">
                                    -- Pilih Guru --
                                </option>

                                @foreach($guru as $guruItem)

                                    <option
                                        value="{{ $guruItem->id_guru }}"
                                        {{ old('id_guru') == $guruItem->id_guru ? 'selected' : '' }}
                                    >

                                        {{ $guruItem->nama_guru }}

                                        @if($guruItem->jurusan)

                                            -
                                            {{ $guruItem->jurusan->nama_jurusan }}

                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- TANGGAL -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Tanggal Booking
                            </label>

                            <input
                                type="datetime-local"
                                name="tanggal"
                                class="form-control"
                                value="{{ old('tanggal') }}"
                                required
                            >

                        </div>


                        <!-- KETERANGAN -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Keterangan Booking
                            </label>

                            <input
                                type="text"
                                name="keterangan"
                                class="form-control"
                                placeholder="Contoh: Booking melalui admin"
                                value="{{ old('keterangan') }}"
                            >

                        </div>


                        <!-- DESKRIPSI -->

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Deskripsi / Keluhan
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="4"
                                placeholder="Jelaskan kebutuhan atau keluhan pelanggan..."
                                required
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

                        <i class="bi bi-plus-lg me-1"></i>

                        Simpan Booking

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- ========================================= -->
<!-- MODAL DETAIL, EDIT, HAPUS -->
<!-- ========================================= -->

@foreach($booking as $item)


<!-- ========================================= -->
<!-- MODAL DETAIL -->
<!-- ========================================= -->

<div
    class="modal fade"
    id="modalDetailTefa{{ $item->id_book }}"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">
                        Detail Booking TEFA
                    </h5>

                    <small class="text-muted">
                        Informasi lengkap pemesanan layanan.
                    </small>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <!-- DATA UTAMA -->

                <div class="row g-3">


                    <!-- ID BOOKING -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            ID Booking
                        </small>

                        <div class="mt-1">

                            <span class="badge bg-primary fs-6">
                                {{ $item->id_book }}
                            </span>

                        </div>

                    </div>


                    <!-- NAMA -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            Nama Pemesan
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $item->transaksi->nama_pelanggan ?? '-' }}
                        </div>

                    </div>


                    <!-- TELEPON -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            No. Telepon
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $item->transaksi->no_telp ?? '-' }}
                        </div>

                    </div>


                    <!-- JURUSAN -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            Jurusan
                        </small>

                        <div class="mt-1">

                            <span class="major-badge">
                                {{ $item->transaksi->layanan->jurusan->nama_jurusan ?? '-' }}
                            </span>

                        </div>

                    </div>


                    <!-- LAYANAN -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            Layanan
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $item->transaksi->layanan->nama_layanan ?? '-' }}
                        </div>

                    </div>


                    <!-- HARGA -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            Harga Layanan
                        </small>

                        <div class="fw-semibold mt-1">

                            @if($item->transaksi->layanan)

                                Rp
                                {{ number_format($item->transaksi->layanan->harga, 0, ',', '.') }}

                            @else

                                Rp 0

                            @endif

                        </div>

                    </div>


                    <!-- GURU -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            Guru Penanggung Jawab
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $item->transaksi->guru->nama_guru ?? '-' }}
                        </div>

                    </div>


                    <!-- STATUS -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            Status
                        </small>

                        <div class="mt-1">

                            @if($item->status_book === 'pending')

                                <span class="status-badge warning">
                                    Pending
                                </span>

                            @elseif($item->status_book === 'diproses')

                                <span class="status-badge info">
                                    Diproses
                                </span>

                            @elseif($item->status_book === 'selesai')

                                <span class="status-badge success">
                                    Selesai
                                </span>

                            @elseif($item->status_book === 'batal')

                                <span class="status-badge danger">
                                    Batal
                                </span>

                            @endif

                        </div>

                    </div>


                    <!-- TANGGAL -->

                    <div class="col-md-6">

                        <small class="text-muted">
                            Tanggal Booking
                        </small>

                        <div class="fw-semibold mt-1">

                            @if($item->transaksi->tanggal)

                                {{ $item->transaksi->tanggal->format('d F Y H\:i') }}

                            @else

                                -

                            @endif

                        </div>

                    </div>


                    <!-- DESKRIPSI -->

                    <div class="col-12">

                        <small class="text-muted">
                            Deskripsi Pesanan
                        </small>

                        <div class="mt-1 text-muted">
                            {{ $item->transaksi->deskripsi ?? '-' }}
                        </div>

                    </div>


                    <!-- KETERANGAN -->

                    <div class="col-12">

                        <small class="text-muted">
                            Keterangan Booking
                        </small>

                        <div class="mt-1 text-muted">
                            {{ $item->keterangan ?? '-' }}
                        </div>

                    </div>

                </div>


                <!-- ========================================= -->
                <!-- PEKERJAAN TAMBAHAN -->
                <!-- ========================================= -->

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Pekerjaan Tambahan
                        </h5>

                        <small class="text-muted">
                            Pekerjaan tambahan yang ditemukan oleh mekanik.
                        </small>

                    </div>

                </div>


                @if($item->tambahan->count() > 0)

                    @foreach($item->tambahan as $tambahan)

                        <div class="border rounded p-3 mb-2">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <strong>
                                        {{ $tambahan->nama_tambahan }}
                                    </strong>

                                    @if($tambahan->keterangan)

                                        <small class="d-block text-muted mt-1">
                                            {{ $tambahan->keterangan }}
                                        </small>

                                    @endif

                                </div>

                                <strong class="text-primary">

                                    Rp
                                    {{ number_format($tambahan->harga, 0, ',', '.') }}

                                </strong>

                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="text-center text-muted py-3 border rounded">

                        <i class="bi bi-tools fs-4 d-block mb-2"></i>

                        Belum ada pekerjaan tambahan.

                    </div>

                @endif


                <!-- ========================================= -->
                <!-- RINGKASAN HARGA -->
                <!-- ========================================= -->

                @php

                    $hargaLayanan = $item->transaksi->layanan->harga ?? 0;

                    $totalTambahan = $item->tambahan->sum('harga');

                    $totalKeseluruhan = $hargaLayanan + $totalTambahan;

                @endphp


                <div class="border rounded p-3 mt-3">

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted">
                            Harga Layanan
                        </span>

                        <span>

                            Rp
                            {{ number_format($hargaLayanan, 0, ',', '.') }}

                        </span>

                    </div>


                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted">
                            Pekerjaan Tambahan
                        </span>

                        <span>

                            Rp
                            {{ number_format($totalTambahan, 0, ',', '.') }}

                        </span>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between">

                        <strong>
                            Total Keseluruhan
                        </strong>

                        <strong class="text-primary">

                            Rp
                            {{ number_format($totalKeseluruhan, 0, ',', '.') }}

                        </strong>

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

            </div>

        </div>

    </div>

</div>


<!-- ========================================= -->
<!-- MODAL EDIT BOOKING -->
<!-- ========================================= -->

<div
    class="modal fade"
    id="modalEditTefa{{ $item->id_book }}"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 shadow">

            <form
                action="{{ route('tefa.update', $item->id_book) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="modal-header">

                    <div>

                        <h5 class="modal-title fw-bold">
                            Edit Booking TEFA
                        </h5>

                        <small class="text-muted">
                            Perbarui data booking dan tambahkan pekerjaan jika diperlukan.
                        </small>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">


                    <!-- ========================================= -->
                    <!-- DATA BOOKING -->
                    <!-- ========================================= -->

                    <h6 class="fw-bold mb-3">
                        Data Booking
                    </h6>


                    <div class="row g-3">


                        <!-- ID BOOKING -->

                        <div class="col-12">

                            <div class="border rounded p-3 bg-light">

                                <small class="text-muted d-block mb-1">
                                    ID Booking
                                </small>

                                <span class="badge bg-primary fs-6">
                                    {{ $item->id_book }}
                                </span>

                            </div>

                        </div>


                        <!-- NAMA -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nama Pelanggan
                            </label>

                            <input
                                type="text"
                                name="nama_pelanggan"
                                class="form-control"
                                value="{{ $item->transaksi->nama_pelanggan ?? '' }}"
                                required
                            >

                        </div>


                        <!-- TELEPON -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                No. Telepon
                            </label>

                            <input
                                type="text"
                                name="no_telp"
                                class="form-control"
                                value="{{ $item->transaksi->no_telp ?? '' }}"
                            >

                        </div>


                        <!-- LAYANAN -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Layanan
                            </label>

                            <select
                                name="id_layanan"
                                class="form-select"
                                required
                            >

                                @foreach($layanan as $layananItem)

                                    <option
                                        value="{{ $layananItem->id_layanan }}"
                                        {{ ($item->transaksi->id_layanan ?? null) == $layananItem->id_layanan ? 'selected' : '' }}
                                    >

                                        {{ $layananItem->nama_layanan }}

                                        @if($layananItem->jurusan)

                                            -
                                            {{ $layananItem->jurusan->nama_jurusan }}

                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- GURU -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Guru / Penanggung Jawab
                            </label>

                            <select
                                name="id_guru"
                                class="form-select"
                            >

                                <option value="">
                                    -- Pilih Guru --
                                </option>

                                @foreach($guru as $guruItem)

                                    <option
                                        value="{{ $guruItem->id_guru }}"
                                        {{ ($item->transaksi->id_guru ?? null) == $guruItem->id_guru ? 'selected' : '' }}
                                    >

                                        {{ $guruItem->nama_guru }}

                                        @if($guruItem->jurusan)

                                            -
                                            {{ $guruItem->jurusan->nama_jurusan }}

                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- TANGGAL -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Tanggal Booking
                            </label>

                            <input
                                type="datetime-local"
                                name="tanggal"
                                class="form-control"
                                value="{{ $item->transaksi->tanggal ? $item->transaksi->tanggal->format('Y-m-d\TH\:i') : '' }}"
                                required
                            >

                        </div>


                        <!-- STATUS -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Status Booking
                            </label>

                            <select
                                name="status_book"
                                class="form-select"
                                required
                            >

                                <option
                                    value="pending"
                                    {{ $item->status_book === 'pending' ? 'selected' : '' }}
                                >
                                    Pending
                                </option>

                                <option
                                    value="diproses"
                                    {{ $item->status_book === 'diproses' ? 'selected' : '' }}
                                >
                                    Diproses
                                </option>

                                <option
                                    value="selesai"
                                    {{ $item->status_book === 'selesai' ? 'selected' : '' }}
                                >
                                    Selesai
                                </option>

                                <option
                                    value="batal"
                                    {{ $item->status_book === 'batal' ? 'selected' : '' }}
                                >
                                    Batal
                                </option>

                            </select>

                        </div>


                        <!-- KETERANGAN -->

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Keterangan Booking
                            </label>

                            <textarea
                                name="keterangan"
                                class="form-control"
                                rows="2"
                                placeholder="Keterangan tambahan untuk booking..."
                            >{{ $item->keterangan ?? '' }}</textarea>

                        </div>


                        <!-- DESKRIPSI -->

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Deskripsi / Keluhan
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="3"
                                required
                            >{{ $item->transaksi->deskripsi ?? '' }}</textarea>

                        </div>

                    </div>


                    <!-- ========================================= -->
                    <!-- PEKERJAAN TAMBAHAN -->
                    <!-- ========================================= -->

                    <hr class="my-4">


                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Pekerjaan Tambahan
                            </h5>

                            <small class="text-muted">
                                Tambahkan pekerjaan atau biaya tambahan yang ditemukan mekanik.
                            </small>

                        </div>


                        <button
                            type="button"
                            class="btn btn-outline-primary btn-sm"
                            onclick="tambahPekerjaan({{ $item->id_book }})"
                        >

                            <i class="bi bi-plus-lg me-1"></i>

                            Tambah Pekerjaan

                        </button>

                    </div>


                    <!-- CONTAINER PEKERJAAN -->

                    <div
                        id="tambahanContainer{{ $item->id_book }}"
                        class="tambahan-container"
                    >

                        @foreach($item->tambahan as $index => $tambahan)

                            <div class="tambahan-item border rounded p-3 mb-3">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <strong>
                                        Pekerjaan Tambahan
                                    </strong>

                                    <button
                                        type="button"
                                        class="btn btn-outline-danger btn-sm"
                                        onclick="hapusPekerjaan(this)"
                                    >

                                        <i class="bi bi-trash me-1"></i>

                                        Hapus

                                    </button>

                                </div>


                                <div class="row g-3">


                                    <!-- NAMA TAMBAHAN -->

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Nama Pekerjaan
                                        </label>

                                        <input
                                            type="text"
                                            name="tambahan[{{ $index }}][nama_tambahan]"
                                            class="form-control"
                                            value="{{ $tambahan->nama_tambahan }}"
                                            placeholder="Contoh: Ganti Kampas Rem"
                                        >

                                    </div>


                                    <!-- HARGA -->

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Harga
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                Rp
                                            </span>

                                            <input
                                                type="number"
                                                name="tambahan[{{ $index }}][harga]"
                                                class="form-control"
                                                value="{{ $tambahan->harga }}"
                                                min="0"
                                                placeholder="75000"
                                            >

                                        </div>

                                    </div>


                                    <!-- KETERANGAN -->

                                    <div class="col-12">

                                        <label class="form-label fw-semibold">
                                            Keterangan
                                        </label>

                                        <textarea
                                            name="tambahan[{{ $index }}][keterangan]"
                                            class="form-control"
                                            rows="2"
                                            placeholder="Contoh: Kampas rem depan sudah aus dan perlu diganti."
                                        >{{ $tambahan->keterangan }}</textarea>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    <!-- ========================================= -->
                    <!-- JIKA BELUM ADA TAMBAHAN -->
                    <!-- ========================================= -->

                    @if($item->tambahan->count() === 0)

                        <div
                            id="emptyTambahan{{ $item->id_book }}"
                            class="text-center border rounded p-4 text-muted"
                        >

                            <i class="bi bi-tools fs-3 d-block mb-2"></i>

                            Belum ada pekerjaan tambahan.

                            <div class="small mt-1">
                                Klik "Tambah Pekerjaan" jika mekanik menemukan masalah baru.
                            </div>

                        </div>

                    @endif

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


<!-- ========================================= -->
<!-- MODAL HAPUS -->
<!-- ========================================= -->

<div
    class="modal fade"
    id="modalHapusTefa{{ $item->id_book }}"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <form
                action="{{ route('tefa.destroy', $item->id_book) }}"
                method="POST"
            >

                @csrf

                @method('DELETE')


                <div class="modal-body text-center p-4">

                    <div
                        class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                        style="
                            width: 55px;
                            height: 55px;
                            border-radius: 14px;
                            background: #fef2f2;
                            color: #dc2626;
                            font-size: 22px;
                        "
                    >

                        <i class="bi bi-trash"></i>

                    </div>


                    <h5 class="fw-bold">
                        Hapus Booking?
                    </h5>


                    <p class="text-muted small mb-2">
                        Kamu akan menghapus booking:
                    </p>


                    <!-- ID BOOKING -->

                    <div class="mb-2">

                        <span class="badge bg-primary">
                            {{ $item->id_book }}
                        </span>

                    </div>


                    <p class="fw-semibold mb-4">
                        {{ $item->transaksi->nama_pelanggan ?? '-' }}
                    </p>


                    <p class="text-muted small mb-4">

                        Data booking ini akan dihapus dari daftar.

                        Tindakan ini tidak dapat dibatalkan.

                    </p>


                    <div class="d-flex justify-content-center gap-2">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>


                        <button
                            type="submit"
                            class="btn btn-danger"
                        >

                            <i class="bi bi-trash me-1"></i>

                            Hapus

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


@endforeach


<!-- ========================================= -->
<!-- JAVASCRIPT SEARCH & FILTER -->
<!-- ========================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('searchTefa');

    const filterStatus =
        document.getElementById('filterStatusTefa');

    const rows =
        document.querySelectorAll('.tefa-row');

    const jumlahTefa =
        document.getElementById('jumlahTefa');


    function filterTefa() {

        const keyword =
            searchInput.value
                .toLowerCase()
                .trim();

        const status =
            filterStatus.value;

        let jumlah = 0;


        rows.forEach(function (row) {

            const bookingId =
                row.dataset.bookingId
                    .toLowerCase();

            const rowStatus =
                row.dataset.status;


            /*
            |--------------------------------------------------------------------------
            | CEK SEARCH ID BOOKING
            |--------------------------------------------------------------------------
            |
            | Contoh:
            |
            | ID 1  -> cari "1"
            | ID 27 -> cari "27"
            | ID 125 -> cari "125"
            |
            */

            const cocokSearch =
                keyword === '' ||
                bookingId.includes(keyword);


            /*
            |--------------------------------------------------------------------------
            | CEK STATUS
            |--------------------------------------------------------------------------
            */

            const cocokStatus =
                status === '' ||
                rowStatus === status;


            /*
            |--------------------------------------------------------------------------
            | TAMPILKAN / SEMBUNYIKAN
            |--------------------------------------------------------------------------
            */

            if (
                cocokSearch &&
                cocokStatus
            ) {

                row.style.display = '';

                jumlah++;

            } else {

                row.style.display = 'none';

            }

        });


        /*
        |--------------------------------------------------------------------------
        | UPDATE JUMLAH
        |--------------------------------------------------------------------------
        */

        jumlahTefa.textContent =
            jumlah;

    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener(
        'input',
        filterTefa
    );


    /*
    |--------------------------------------------------------------------------
    | FILTER STATUS
    |--------------------------------------------------------------------------
    */

    filterStatus.addEventListener(
        'change',
        filterTefa
    );

});


/*
|--------------------------------------------------------------------------
| TAMBAH PEKERJAAN TAMBAHAN
|--------------------------------------------------------------------------
*/

function tambahPekerjaan(idBook) {

    const container =
        document.getElementById(
            'tambahanContainer' + idBook
        );


    const emptyMessage =
        document.getElementById(
            'emptyTambahan' + idBook
        );


    if (emptyMessage) {

        emptyMessage.remove();

    }


    const index =
        container.querySelectorAll(
            '.tambahan-item'
        ).length;


    const div =
        document.createElement('div');


    div.className =
        'tambahan-item border rounded p-3 mb-3';


    div.innerHTML = `

        <div class="d-flex justify-content-between align-items-center mb-3">

            <strong>
                Pekerjaan Tambahan
            </strong>

            <button
                type="button"
                class="btn btn-outline-danger btn-sm"
                onclick="hapusPekerjaan(this)"
            >

                <i class="bi bi-trash me-1"></i>

                Hapus

            </button>

        </div>


        <div class="row g-3">


            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Nama Pekerjaan
                </label>

                <input
                    type="text"
                    name="tambahan[${index}][nama_tambahan]"
                    class="form-control"
                    placeholder="Contoh: Ganti Kampas Rem"
                >

            </div>


            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Harga
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="tambahan[${index}][harga]"
                        class="form-control"
                        min="0"
                        placeholder="75000"
                    >

                </div>

            </div>


            <div class="col-12">

                <label class="form-label fw-semibold">
                    Keterangan
                </label>

                <textarea
                    name="tambahan[${index}][keterangan]"
                    class="form-control"
                    rows="2"
                    placeholder="Contoh: Kampas rem depan sudah aus dan perlu diganti."
                ></textarea>

            </div>

        </div>

    `;


    container.appendChild(div);

}


/*
|--------------------------------------------------------------------------
| HAPUS PEKERJAAN TAMBAHAN DARI FORM
|--------------------------------------------------------------------------
*/

function hapusPekerjaan(button) {

    const item =
        button.closest(
            '.tambahan-item'
        );


    if (item) {

        item.remove();

    }

}

</script>

@endsection