@extends('layouts.admin')

@section('title', 'Mentoring')

@section('page-title', 'Mentoring')

@section('content')


<!-- ========================================= -->
<!-- HEADER -->
<!-- ========================================= -->

<div class="d-flex justify-content-between align-items-start mb-4">

    <div>

        <span class="welcome-label">
            KARIR
        </span>

        <h2 class="fw-bold mt-3 mb-1">
            Mentoring
        </h2>

        <p class="text-muted mb-0">
            Kelola proses mentoring antara siswa dan alumni.
        </p>

    </div>


    <!-- TAMBAH -->

    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambahMentoring"
    >

        <i class="bi bi-plus-lg me-1"></i>

        Tambah Mentoring

    </button>

</div>



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
                        Total Mentoring
                    </p>

                    <h2 class="stat-number">
                        24
                    </h2>

                    <span class="stat-status info">

                        <i class="bi bi-collection"></i>

                        Semua pengajuan

                    </span>

                </div>


                <div class="stat-icon primary">

                    <i class="bi bi-briefcase-fill"></i>

                </div>

            </div>

        </div>

    </div>



    <!-- MENUNGGU -->

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Menunggu
                    </p>

                    <h2 class="stat-number">
                        8
                    </h2>

                    <span class="stat-status warning">

                        <i class="bi bi-clock"></i>

                        Perlu diproses

                    </span>

                </div>


                <div class="stat-icon warning">

                    <i class="bi bi-hourglass-split"></i>

                </div>

            </div>

        </div>

    </div>



    <!-- PROSES -->

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Dalam Proses
                    </p>

                    <h2 class="stat-number">
                        10
                    </h2>

                    <span class="stat-status info">

                        <i class="bi bi-arrow-repeat"></i>

                        Sedang berjalan

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
                        6
                    </h2>

                    <span class="stat-status success">

                        <i class="bi bi-check-circle"></i>

                        Mentoring selesai

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
<!-- DATA MENTORING -->
<!-- ========================================= -->

<div class="dashboard-card">


    <!-- HEADER -->

    <div class="dashboard-card-header">

        <div>

            <h5 class="dashboard-card-title">
                Data Mentoring
            </h5>

            <p class="dashboard-card-subtitle">
                Daftar pengajuan mentoring siswa dan alumni.
            </p>

        </div>


        <!-- FILTER -->

        <div class="d-flex gap-2">

            <div class="input-group input-group-sm">

                <span class="input-group-text bg-white">

                    <i class="bi bi-search"></i>

                </span>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari siswa..."
                >

            </div>


            <select
                class="form-select form-select-sm"
                style="width: 150px;"
            >

                <option selected>
                    Semua Status
                </option>

                <option>
                    Menunggu
                </option>

                <option>
                    Dalam Proses
                </option>

                <option>
                    Selesai
                </option>

            </select>

        </div>

    </div>



    <!-- TABLE -->

    <div class="table-responsive">

        <table class="table dashboard-table align-middle mb-0">


            <thead>

                <tr>

                    <th>
                        Siswa
                    </th>

                    <th>
                        Jurusan
                    </th>

                    <th>
                        Mentor
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



            <tbody>


                <!-- ================================= -->
                <!-- DATA 1 -->
                <!-- ================================= -->

                <tr>

                    <td>

                        <div class="student-info">

                            <div class="student-avatar primary">
                                A
                            </div>

                            <div>

                                <strong>
                                    Andi Pratama
                                </strong>

                                <small class="d-block text-muted">
                                    XII TJKT 1
                                </small>

                            </div>

                        </div>

                    </td>


                    <td>

                        <span class="major-badge">
                            TJKT
                        </span>

                    </td>


                    <td>
                        Budi Santoso
                    </td>


                    <td>

                        <span class="status-badge warning">
                            Dalam Proses
                        </span>

                    </td>


                    <td>
                        21 Sep 2026
                    </td>


                    <td class="text-end">

                        <div class="d-inline-flex gap-1">

                            <button
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDetailMentoring"
                                title="Detail"
                            >

                                <i class="bi bi-eye"></i>

                            </button>


                            <button
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditMentoring"
                                title="Edit"
                            >

                                <i class="bi bi-pencil"></i>

                            </button>


                            <button
                                class="btn btn-sm btn-light text-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalHapusMentoring"
                                title="Hapus"
                            >

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>



                <!-- ================================= -->
                <!-- DATA 2 -->
                <!-- ================================= -->

                <tr>

                    <td>

                        <div class="student-info">

                            <div class="student-avatar success">
                                R
                            </div>

                            <div>

                                <strong>
                                    Rizky Ramadhan
                                </strong>

                                <small class="d-block text-muted">
                                    XII TKR 2
                                </small>

                            </div>

                        </div>

                    </td>


                    <td>

                        <span class="major-badge">
                            TKR
                        </span>

                    </td>


                    <td>
                        Fajar Ramadhan
                    </td>


                    <td>

                        <span class="status-badge success">
                            Selesai
                        </span>

                    </td>


                    <td>
                        20 Sep 2026
                    </td>


                    <td class="text-end">

                        <div class="d-inline-flex gap-1">

                            <button
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDetailMentoring"
                            >

                                <i class="bi bi-eye"></i>

                            </button>


                            <button
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditMentoring"
                            >

                                <i class="bi bi-pencil"></i>

                            </button>


                            <button
                                class="btn btn-sm btn-light text-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalHapusMentoring"
                            >

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>



                <!-- ================================= -->
                <!-- DATA 3 -->
                <!-- ================================= -->

                <tr>

                    <td>

                        <div class="student-info">

                            <div class="student-avatar secondary">
                                D
                            </div>

                            <div>

                                <strong>
                                    Dimas Saputra
                                </strong>

                                <small class="d-block text-muted">
                                    XII TP 1
                                </small>

                            </div>

                        </div>

                    </td>


                    <td>

                        <span class="major-badge">
                            TP
                        </span>

                    </td>


                    <td>
                        Agus Setiawan
                    </td>


                    <td>

                        <span class="status-badge secondary">
                            Menunggu
                        </span>

                    </td>


                    <td>
                        19 Sep 2026
                    </td>


                    <td class="text-end">

                        <div class="d-inline-flex gap-1">

                            <button
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDetailMentoring"
                            >

                                <i class="bi bi-eye"></i>

                            </button>


                            <button
                                class="btn btn-sm btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditMentoring"
                            >

                                <i class="bi bi-pencil"></i>

                            </button>


                            <button
                                class="btn btn-sm btn-light text-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalHapusMentoring"
                            >

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>



            </tbody>

        </table>

    </div>


</div>



<!-- ========================================= -->
<!-- MODAL TAMBAH MENTORING -->
<!-- ========================================= -->

<div
    class="modal fade"
    id="modalTambahMentoring"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">


            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">
                        Tambah Mentoring
                    </h5>

                    <small class="text-muted">
                        Tambahkan pengajuan mentoring baru.
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


                    <div class="col-md-6">

                        <label class="form-label">
                            Nama Siswa
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Masukkan nama siswa"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Jurusan
                        </label>

                        <select class="form-select">

                            <option selected>
                                Pilih jurusan
                            </option>

                            <option>
                                TJKT
                            </option>

                            <option>
                                TKR
                            </option>

                            <option>
                                TP
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Kelas
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Contoh: XII TJKT 1"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Mentor
                        </label>

                        <select class="form-select">

                            <option selected>
                                Pilih mentor
                            </option>

                            <option>
                                Budi Santoso
                            </option>

                            <option>
                                Fajar Ramadhan
                            </option>

                            <option>
                                Agus Setiawan
                            </option>

                        </select>

                    </div>


                    <div class="col-12">

                        <label class="form-label">
                            Topik Mentoring
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Contoh: Persiapan masuk dunia kerja"
                        >

                    </div>


                    <div class="col-12">

                        <label class="form-label">
                            Catatan
                        </label>

                        <textarea
                            class="form-control"
                            rows="3"
                            placeholder="Tambahkan catatan..."
                        ></textarea>

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
                    type="button"
                    class="btn btn-primary"
                >

                    <i class="bi bi-check-lg me-1"></i>

                    Simpan Mentoring

                </button>

            </div>


        </div>

    </div>

</div>



<!-- ========================================= -->
<!-- MODAL DETAIL -->
<!-- ========================================= -->

<div
    class="modal fade"
    id="modalDetailMentoring"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">


            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">
                        Detail Mentoring
                    </h5>

                    <small class="text-muted">
                        Informasi lengkap pengajuan mentoring.
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


                    <div class="col-md-6">

                        <small class="text-muted">
                            Nama Siswa
                        </small>

                        <div class="fw-semibold mt-1">
                            Andi Pratama
                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Kelas
                        </small>

                        <div class="fw-semibold mt-1">
                            XII TJKT 1
                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Jurusan
                        </small>

                        <div class="mt-1">

                            <span class="major-badge">
                                TJKT
                            </span>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Mentor
                        </small>

                        <div class="fw-semibold mt-1">
                            Budi Santoso
                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Status
                        </small>

                        <div class="mt-1">

                            <span class="status-badge warning">
                                Dalam Proses
                            </span>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Tanggal Pengajuan
                        </small>

                        <div class="fw-semibold mt-1">
                            21 September 2026
                        </div>

                    </div>


                    <div class="col-12">

                        <small class="text-muted">
                            Topik Mentoring
                        </small>

                        <div class="fw-semibold mt-1">
                            Persiapan masuk dunia kerja
                        </div>

                    </div>


                    <div class="col-12">

                        <small class="text-muted">
                            Catatan
                        </small>

                        <div class="mt-1 text-muted">

                            Siswa ingin mendapatkan arahan mengenai
                            persiapan kerja setelah lulus.

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



<!-- ========================================= -->
<!-- MODAL EDIT -->
<!-- ========================================= -->

<div
    class="modal fade"
    id="modalEditMentoring"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">


            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold">
                        Edit Mentoring
                    </h5>

                    <small class="text-muted">
                        Perbarui informasi mentoring.
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


                    <div class="col-md-6">

                        <label class="form-label">
                            Nama Siswa
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="Andi Pratama"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Jurusan
                        </label>

                        <select class="form-select">

                            <option selected>
                                TJKT
                            </option>

                            <option>
                                TKR
                            </option>

                            <option>
                                TP
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Mentor
                        </label>

                        <select class="form-select">

                            <option selected>
                                Budi Santoso
                            </option>

                            <option>
                                Fajar Ramadhan
                            </option>

                            <option>
                                Agus Setiawan
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Status
                        </label>

                        <select class="form-select">

                            <option>
                                Menunggu
                            </option>

                            <option selected>
                                Dalam Proses
                            </option>

                            <option>
                                Selesai
                            </option>

                        </select>

                    </div>


                    <div class="col-12">

                        <label class="form-label">
                            Topik Mentoring
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="Persiapan masuk dunia kerja"
                        >

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
                    type="button"
                    class="btn btn-primary"
                >

                    <i class="bi bi-check-lg me-1"></i>

                    Simpan Perubahan

                </button>

            </div>


        </div>

    </div>

</div>



<!-- ========================================= -->
<!-- MODAL HAPUS -->
<!-- ========================================= -->

<div
    class="modal fade"
    id="modalHapusMentoring"
    tabindex="-1"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">


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
                    Hapus Mentoring?
                </h5>


                <p class="text-muted small mb-4">

                    Data mentoring ini akan dihapus dari daftar.
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
                        type="button"
                        class="btn btn-danger"
                    >

                        <i class="bi bi-trash me-1"></i>

                        Hapus

                    </button>

                </div>


            </div>


        </div>

    </div>

</div>


@endsection