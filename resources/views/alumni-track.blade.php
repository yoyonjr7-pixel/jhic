@extends('layouts.admin')

@section('title', 'Alumni Track')

@section('page-title', 'Alumni Track')

@section('content')

<!-- HEADER -->

<div class="d-flex justify-content-between align-items-start mb-4">

<div>

    <span class="welcome-label">
        ALUMNI
    </span>

    <h2 class="fw-bold mt-3 mb-1">
        Alumni Track
    </h2>

    <p class="text-muted mb-0">
        Kelola dan pantau perkembangan alumni setelah lulus dari sekolah.
    </p>

</div>

<button
    type="button"
    class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#modalTambahAlumni"
>
    <i class="bi bi-plus-lg me-1"></i>
    Tambah Alumni
</button>

</div>

<!-- PESAN SUKSES -->

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

<!-- VALIDATION ERROR -->

@if($errors->any())

<div class="alert alert-danger alert-dismissible fade show" role="alert">

<strong>Data belum berhasil disimpan.</strong>

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

<!-- STATISTIK -->

<div class="row g-3 mb-4">

<!-- TOTAL -->

<div class="col-xl-3 col-md-6">

    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>

                <p class="stat-label">
                    Total Alumni
                </p>

                <h2 class="stat-number">
                    {{ $alumni->count() }}
                </h2>

                <span class="stat-status info">

                    <i class="bi bi-people"></i>

                    Seluruh alumni

                </span>

            </div>

            <div class="stat-icon primary">

                <i class="bi bi-mortarboard-fill"></i>

            </div>

        </div>

    </div>

</div>


<!-- BEKERJA -->

<div class="col-xl-3 col-md-6">

    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>

                <p class="stat-label">
                    Sudah Bekerja
                </p>

                <h2 class="stat-number">

                    {{ $alumni->where('status', 'bekerja')->count() }}

                </h2>

                <span class="stat-status success">

                    <i class="bi bi-briefcase-fill"></i>

                    Alumni bekerja

                </span>

            </div>

            <div class="stat-icon success">

                <i class="bi bi-briefcase-fill"></i>

            </div>

        </div>

    </div>

</div>


<!-- USAHA -->

<div class="col-xl-3 col-md-6">

    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>

                <p class="stat-label">
                    Memiliki Usaha
                </p>

                <h2 class="stat-number">

                    {{ $alumni->where('status', 'memiliki_usaha')->count() }}

                </h2>

                <span class="stat-status info">

                    <i class="bi bi-shop"></i>

                    Alumni berwirausaha

                </span>

            </div>

            <div class="stat-icon info">

                <i class="bi bi-shop"></i>

            </div>

        </div>

    </div>

</div>


<!-- MENCARI KERJA -->

<div class="col-xl-3 col-md-6">

    <div class="dashboard-stat-card">

        <div class="stat-content">

            <div>

                <p class="stat-label">
                    Mencari Kerja
                </p>

                <h2 class="stat-number">

                    {{ $alumni->where('status', 'mencari_kerja')->count() }}

                </h2>

                <span class="stat-status warning">

                    <i class="bi bi-search"></i>

                    Perlu ditindaklanjuti

                </span>

            </div>

            <div class="stat-icon warning">

                <i class="bi bi-search"></i>

            </div>

        </div>

    </div>

</div>

</div>

<!-- DATA ALUMNI -->

<div class="dashboard-card">

<div class="dashboard-card-header">

    <div>

        <h5 class="dashboard-card-title">
            Data Alumni
        </h5>

        <p class="dashboard-card-subtitle">
            Daftar alumni dan informasi aktivitas setelah lulus.
        </p>

    </div>


    <div class="d-flex gap-2">

        <!-- SEARCH -->

        <div class="input-group input-group-sm">

            <span class="input-group-text bg-white">

                <i class="bi bi-search"></i>

            </span>

            <input
                type="text"
                id="searchAlumni"
                class="form-control"
                placeholder="Cari alumni..."
            >

        </div>


        <!-- FILTER STATUS -->

        <select
            id="filterStatusAlumni"
            class="form-select form-select-sm"
            style="width: 170px;"
        >

            <option value="" selected>
                Semua Status
            </option>

            <option value="bekerja">
                Sudah Bekerja
            </option>

            <option value="memiliki_usaha">
                Memiliki Usaha
            </option>

            <option value="mencari_kerja">
                Mencari Kerja
            </option>

        </select>

    </div>

</div>


<!-- TABLE -->

<div class="table-responsive">

    <table class="table dashboard-table align-middle mb-0">

        <thead>

            <tr>

                <th>Alumni</th>

                <th>Jurusan</th>

                <th>Tahun Lulus</th>

                <th>Status</th>

                <th>Perusahaan / Usaha</th>

                <th class="text-end">
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody id="alumniTableBody">

            @forelse($alumni as $item)

                <tr
                    class="alumni-row"
                    data-status="{{ $item->status }}"
                >

                    <!-- NAMA -->

                    <td>

                        <div class="student-info">

                            <div class="student-avatar primary">

                                {{ strtoupper(substr($item->siswa->nama_siswa, 0, 1)) }}

                            </div>

                            <div>

                                <strong>

                                    {{ $item->siswa->nama_siswa }}

                                </strong>

                                <small class="d-block text-muted">

                                    Alumni {{ $item->jurusan->nama_jurusan }}

                                </small>

                            </div>

                        </div>

                    </td>


                    <!-- JURUSAN -->

                    <td>

                        <span class="major-badge">

                            {{ $item->jurusan->nama_jurusan }}

                        </span>

                    </td>


                    <!-- TAHUN -->

                    <td>

                        {{ $item->tahun_lulus }}

                    </td>


                    <!-- STATUS -->

                    <td>

                        @if($item->status === 'bekerja')

                            <span class="status-badge success">
                                Sudah Bekerja
                            </span>

                        @elseif($item->status === 'memiliki_usaha')

                            <span class="status-badge info">
                                Memiliki Usaha
                            </span>

                        @elseif($item->status === 'mencari_kerja')

                            <span class="status-badge warning">
                                Mencari Kerja
                            </span>

                        @else

                            <span class="status-badge danger">

                                {{ $item->status }}

                            </span>

                        @endif

                    </td>


                    <!-- KETERANGAN -->

                    <td>

                        @if($item->status === 'bekerja' || $item->status === 'memiliki_usaha')

                            @if($item->keterangan)

                                <span
                                    class="d-inline-block"
                                    style="max-width: 300px;"
                                >

                                    {!! nl2br(e($item->keterangan)) !!}

                                </span>

                            @else

                                -

                            @endif

                        @else

                            -

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
                                data-bs-target="#modalDetailAlumni{{ $item->id_alumni }}"
                                title="Detail"
                            >

                                <i class="bi bi-eye"></i>

                            </button>


                            <!-- EDIT -->

                            <button
                                type="button"
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditAlumni{{ $item->id_alumni }}"
                                title="Edit"
                            >

                                <i class="bi bi-pencil"></i>

                            </button>


                            <!-- HAPUS -->

                            <button
                                type="button"
                                class="btn btn-sm btn-light text-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalHapusAlumni{{ $item->id_alumni }}"
                                title="Hapus"
                            >

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center py-4">

                        <div class="text-muted">

                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                            Belum ada data alumni.

                        </div>

                    </td>

                </tr>

            @endforelse


            <!-- HASIL SEARCH KOSONG -->

            <tr id="noSearchResult" style="display: none;">

                <td colspan="6" class="text-center py-4">

                    <div class="text-muted">

                        <i class="bi bi-search fs-2 d-block mb-2"></i>

                        Data alumni tidak ditemukan.

                    </div>

                </td>

            </tr>

        </tbody>

    </table>

</div>


<!-- PAGINATION INFO -->

<div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">

    <small class="text-muted">

        Menampilkan
        <span id="jumlahAlumniDitampilkan">
            {{ $alumni->count() }}
        </span>
        dari
        <span id="jumlahAlumniTotal">
            {{ $alumni->count() }}
        </span>
        data alumni

    </small>

</div>

</div>

<!-- ===================================================== -->

<!-- MODAL TAMBAH -->

<!-- ===================================================== -->

<div
    class="modal fade"
    id="modalTambahAlumni"
    tabindex="-1"
>

<div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        <form
            action="{{ route('alumni-track.store') }}"
            method="POST"
        >

            @csrf

            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">
                        Tambah Alumni
                    </h5>

                    <small class="text-muted">
                        Tambahkan data alumni baru.
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

                    <!-- NISN -->

                    <div class="col-md-6">

                        <label class="form-label">
                            NISN
                        </label>

                        <input
                            type="text"
                            name="nisn"
                            class="form-control"
                            placeholder="Masukkan NISN"
                            value="{{ old('nisn') }}"
                            required
                        >

                    </div>


                    <!-- NAMA -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Nama Alumni
                        </label>

                        <input
                            type="text"
                            name="nama_siswa"
                            class="form-control"
                            placeholder="Masukkan nama alumni"
                            value="{{ old('nama_siswa') }}"
                            required
                        >

                    </div>


                    <!-- KELAS -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Kelas
                        </label>

                        <input
                            type="text"
                            name="kelas"
                            class="form-control"
                            placeholder="Contoh: 12 TKJ"
                            value="{{ old('kelas') }}"
                            required
                        >

                    </div>


                    <!-- JURUSAN -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Jurusan
                        </label>

                        <select
                            name="id_jurusan"
                            class="form-select"
                            required
                        >

                            <option value="" selected disabled>
                                Pilih jurusan
                            </option>

                            @foreach($jurusan as $j)

                                <option
                                    value="{{ $j->id_jurusan }}"
                                    {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}
                                >

                                    {{ $j->nama_jurusan }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- TAHUN LULUS -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Tahun Lulus
                        </label>

                        <input
                            type="number"
                            name="tahun_lulus"
                            class="form-control"
                            placeholder="Contoh: 2024"
                            value="{{ old('tahun_lulus') }}"
                            required
                        >

                    </div>


                    <!-- NO TELEPON -->

                    <div class="col-md-6">

                        <label class="form-label">
                            No. Telepon
                        </label>

                        <input
                            type="text"
                            name="no_telp"
                            class="form-control"
                            placeholder="Masukkan nomor telepon"
                            value="{{ old('no_telp') }}"
                        >

                    </div>


                    <!-- EMAIL -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email"
                            value="{{ old('email') }}"
                        >

                    </div>


                    <!-- STATUS -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option value="" selected disabled>
                                Pilih status
                            </option>

                            <option
                                value="bekerja"
                                {{ old('status') === 'bekerja' ? 'selected' : '' }}
                            >
                                Sudah Bekerja
                            </option>

                            <option
                                value="memiliki_usaha"
                                {{ old('status') === 'memiliki_usaha' ? 'selected' : '' }}
                            >
                                Memiliki Usaha
                            </option>

                            <option
                                value="mencari_kerja"
                                {{ old('status') === 'mencari_kerja' ? 'selected' : '' }}
                            >
                                Mencari Kerja
                            </option>

                        </select>

                    </div>


                    <!-- KETERANGAN -->

                    <div class="col-12">

                        <label class="form-label">
                            Perusahaan / Usaha / Keterangan
                        </label>

                        <textarea
                            name="keterangan"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan perusahaan, usaha, atau keterangan"
                        >{{ old('keterangan') }}</textarea>

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

                    Simpan Alumni

                </button>

            </div>

        </form>

    </div>

</div>

</div>

<!-- ===================================================== -->

<!-- MODAL DETAIL, EDIT, DAN HAPUS -->

<!-- ===================================================== -->

@foreach($alumni as $item)

<!-- ================================================= -->
<!-- MODAL DETAIL -->
<!-- ================================================= -->

<div
    class="modal fade"
    id="modalDetailAlumni{{ $item->id_alumni }}"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">
                        Detail Alumni
                    </h5>

                    <small class="text-muted">
                        Informasi lengkap alumni.
                    </small>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <div class="d-flex align-items-center gap-3 mb-4">

                    <div
                        class="student-avatar primary"
                        style="
                            width: 58px;
                            height: 58px;
                            font-size: 20px;
                        "
                    >

                        {{ strtoupper(substr($item->siswa->nama_siswa, 0, 1)) }}

                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">

                            {{ $item->siswa->nama_siswa }}

                        </h5>

                        <span class="major-badge">

                            {{ $item->jurusan->nama_jurusan }}

                        </span>

                    </div>

                </div>


                <div class="row g-3">

                    <div class="col-md-6">

                        <small class="text-muted">
                            NISN
                        </small>

                        <div class="fw-semibold mt-1">

                            {{ $item->siswa->nisn ?? '-' }}

                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Kelas
                        </small>

                        <div class="fw-semibold mt-1">

                            {{ $item->siswa->kelas ?? '-' }}

                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Tahun Lulus
                        </small>

                        <div class="fw-semibold mt-1">

                            {{ $item->tahun_lulus ?? '-' }}

                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Status
                        </small>

                        <div class="mt-1">

                            @if($item->status === 'bekerja')

                                <span class="status-badge success">
                                    Sudah Bekerja
                                </span>

                            @elseif($item->status === 'memiliki_usaha')

                                <span class="status-badge info">
                                    Memiliki Usaha
                                </span>

                            @elseif($item->status === 'mencari_kerja')

                                <span class="status-badge warning">
                                    Mencari Kerja
                                </span>

                            @else

                                <span class="status-badge danger">
                                    {{ $item->status ?? '-' }}
                                </span>

                            @endif

                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            No. Telepon
                        </small>

                        <div class="fw-semibold mt-1">

                            {{ $item->no_telp ?? '-' }}

                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Email
                        </small>

                        <div class="fw-semibold mt-1">

                            {{ $item->email ?? '-' }}

                        </div>

                    </div>


                    <div class="col-12">

                        <small class="text-muted">
                            Perusahaan / Usaha / Keterangan
                        </small>

                        <div class="fw-semibold mt-1">

                            @if($item->keterangan)

                                {!! nl2br(e($item->keterangan)) !!}

                            @else

                                -

                            @endif

                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Status Mentor
                        </small>

                        <div class="mt-1">

                            @if($item->mentor == 1)

                                <span class="status-badge success">
                                    Sudah Memiliki Mentor
                                </span>

                            @else

                                <span class="status-badge warning">
                                    Belum Memiliki Mentor
                                </span>

                            @endif

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

            </div>

        </div>

    </div>

</div>


<!-- ================================================= -->
<!-- MODAL EDIT -->
<!-- ================================================= -->

<div
    class="modal fade"
    id="modalEditAlumni{{ $item->id_alumni }}"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <form
                action="{{ route('alumni-track.update', $item->id_alumni) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="modal-header">

                    <div>

                        <h5 class="modal-title fw-bold">
                            Edit Alumni
                        </h5>

                        <small class="text-muted">
                            Perbarui informasi alumni.
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


                        <!-- NAMA -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Alumni
                            </label>

                            <input
                                type="text"
                                name="nama_siswa"
                                class="form-control"
                                value="{{ $item->siswa->nama_siswa }}"
                                required
                            >

                        </div>


                        <!-- JURUSAN -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Jurusan
                            </label>

                            <select
                                name="id_jurusan"
                                class="form-select"
                                required
                            >

                                @foreach($jurusan as $j)

                                    <option
                                        value="{{ $j->id_jurusan }}"
                                        {{ $item->id_jurusan == $j->id_jurusan ? 'selected' : '' }}
                                    >

                                        {{ $j->nama_jurusan }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- TAHUN LULUS -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Tahun Lulus
                            </label>

                            <input
                                type="number"
                                name="tahun_lulus"
                                class="form-control"
                                value="{{ $item->tahun_lulus }}"
                                required
                            >

                        </div>


                        <!-- NO TELEPON -->

                        <div class="col-md-6">

                            <label class="form-label">
                                No. Telepon
                            </label>

                            <input
                                type="text"
                                name="no_telp"
                                class="form-control"
                                value="{{ $item->no_telp }}"
                            >

                        </div>


                        <!-- EMAIL -->

                        <div class="col-12">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ $item->email }}"
                            >

                        </div>


                        <!-- STATUS -->

                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="bekerja"
                                    {{ $item->status === 'bekerja' ? 'selected' : '' }}
                                >
                                    Sudah Bekerja
                                </option>

                                <option
                                    value="memiliki_usaha"
                                    {{ $item->status === 'memiliki_usaha' ? 'selected' : '' }}
                                >
                                    Memiliki Usaha
                                </option>

                                <option
                                    value="mencari_kerja"
                                    {{ $item->status === 'mencari_kerja' ? 'selected' : '' }}
                                >
                                    Mencari Kerja
                                </option>

                            </select>

                        </div>


                        <!-- KETERANGAN -->

                        <div class="col-12">

                            <label class="form-label">
                                Perusahaan / Usaha / Keterangan
                            </label>

                            <textarea
                                name="keterangan"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan perusahaan, usaha, atau keterangan"
                            >{{ $item->keterangan }}</textarea>

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


<!-- ================================================= -->
<!-- MODAL HAPUS -->
<!-- ================================================= -->

<div
    class="modal fade"
    id="modalHapusAlumni{{ $item->id_alumni }}"
    tabindex="-1"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <form
                action="{{ route('alumni-track.destroy', $item->id_alumni) }}"
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
                        Hapus Alumni?
                    </h5>


                    <p class="text-muted small mb-2">
                        Kamu akan menghapus data:
                    </p>


                    <p class="fw-semibold mb-4">

                        {{ $item->siswa->nama_siswa }}

                    </p>


                    <p class="text-muted small mb-4">

                        Data alumni ini akan dihapus dari daftar.
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

<!-- ===================================================== -->

<!-- JAVASCRIPT SEARCH -->

<!-- ===================================================== -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchAlumni');

    const filterStatus = document.getElementById('filterStatusAlumni');

    const rows = document.querySelectorAll('.alumni-row');

    const noSearchResult = document.getElementById('noSearchResult');

    const jumlahDitampilkan = document.getElementById('jumlahAlumniDitampilkan');

    const jumlahTotal = document.getElementById('jumlahAlumniTotal');


    function filterAlumni() {

        const keyword = searchInput.value
            .toLowerCase()
            .trim();

        const status = filterStatus.value;

        let jumlah = 0;


        rows.forEach(function (row) {

            const text = row.innerText
                .toLowerCase();

            const rowStatus = row.dataset.status;


            const cocokSearch =
                text.includes(keyword);


            const cocokStatus =
                status === '' ||
                rowStatus === status;


            if (cocokSearch && cocokStatus) {

                row.style.display = '';

                jumlah++;

            } else {

                row.style.display = 'none';

            }

        });


        jumlahDitampilkan.textContent = jumlah;


        if (jumlah === 0) {

            noSearchResult.style.display = '';

        } else {

            noSearchResult.style.display = 'none';

        }

    }


    searchInput.addEventListener(
        'input',
        filterAlumni
    );


    filterStatus.addEventListener(
        'change',
        filterAlumni
    );


    // Jalankan sekali saat halaman dibuka

    filterAlumni();

});

</script>

@endsection
