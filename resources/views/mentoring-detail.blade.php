@extends('layouts.admin')

@section('title', 'Detail Mentoring')

@section('page-title', 'Detail Mentoring')

@section('content')

<!-- HEADER -->

<div class="d-flex justify-content-between align-items-start mb-4">

    <div>

        <div class="welcome-label mb-2">
            KARIR
        </div>

        <h2 class="fw-bold mb-2">
            Detail Mentoring
        </h2>

        <p class="text-muted mb-0">
            Informasi lengkap pengajuan mentoring siswa.
        </p>

    </div>


    <a
        href="/mentoring"
        class="btn btn-light border"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>


<!-- STATUS -->

<div class="dashboard-card mb-4">

    <div class="p-4">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <small class="text-muted d-block mb-2">
                    STATUS MENTORING
                </small>

                <span class="status-badge warning">
                    Dalam Proses
                </span>

            </div>


            <div class="stat-icon primary">

                <i class="bi bi-briefcase-fill"></i>

            </div>

        </div>

    </div>

</div>


<!-- DATA SISWA & MENTOR -->

<div class="row g-4 mb-4">


    <!-- DATA SISWA -->

    <div class="col-lg-6">

        <div class="dashboard-card h-100">

            <div class="dashboard-card-header">

                <div>

                    <h5 class="dashboard-card-title">
                        Data Siswa
                    </h5>

                    <p class="dashboard-card-subtitle">
                        Informasi peserta mentoring.
                    </p>

                </div>

            </div>


            <div class="px-4 pb-4">


                <div class="d-flex align-items-center gap-3 mb-4">

                    <div class="student-avatar primary"
                         style="width: 50px; height: 50px; font-size: 16px;">

                        A

                    </div>


                    <div>

                        <strong class="d-block">
                            Andi Pratama
                        </strong>

                        <small class="text-muted">
                            Peserta Mentoring
                        </small>

                    </div>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block mb-1">
                        Jurusan
                    </small>

                    <span class="major-badge">
                        TJKT
                    </span>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block mb-1">
                        Fokus Mentoring
                    </small>

                    <strong>
                        IT Support & Networking
                    </strong>

                </div>


                <div>

                    <small class="text-muted d-block mb-1">
                        Tanggal Pengajuan
                    </small>

                    <strong>
                        15 September 2026
                    </strong>

                </div>


            </div>

        </div>

    </div>


    <!-- DATA MENTOR -->

    <div class="col-lg-6">

        <div class="dashboard-card h-100">

            <div class="dashboard-card-header">

                <div>

                    <h5 class="dashboard-card-title">
                        Data Mentor
                    </h5>

                    <p class="dashboard-card-subtitle">
                        Informasi alumni yang menjadi mentor.
                    </p>

                </div>

            </div>


            <div class="px-4 pb-4">


                <div class="d-flex align-items-center gap-3 mb-4">

                    <div class="student-avatar success"
                         style="width: 50px; height: 50px; font-size: 16px;">

                        B

                    </div>


                    <div>

                        <strong class="d-block">
                            Budi Santoso
                        </strong>

                        <small class="text-muted">
                            Mentor Alumni
                        </small>

                    </div>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block mb-1">
                        Bidang
                    </small>

                    <strong>
                        IT Support
                    </strong>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block mb-1">
                        Perusahaan
                    </small>

                    <strong>
                        PT Teknologi Nusantara
                    </strong>

                </div>


                <div>

                    <small class="text-muted d-block mb-1">
                        Pengalaman
                    </small>

                    <strong>
                        3 Tahun
                    </strong>

                </div>


            </div>

        </div>

    </div>

</div>


<!-- DETAIL MENTORING -->

<div class="dashboard-card mb-4">

    <div class="dashboard-card-header">

        <div>

            <h5 class="dashboard-card-title">
                Detail Mentoring
            </h5>

            <p class="dashboard-card-subtitle">
                Informasi kegiatan mentoring yang sedang berjalan.
            </p>

        </div>

    </div>


    <div class="px-4 pb-4">

        <div class="row g-4">


            <div class="col-md-4">

                <small class="text-muted d-block mb-1">
                    Perusahaan / Usaha
                </small>

                <strong>
                    PT Teknologi Nusantara
                </strong>

            </div>


            <div class="col-md-4">

                <small class="text-muted d-block mb-1">
                    Bidang Mentoring
                </small>

                <strong>
                    IT Support & Networking
                </strong>

            </div>


            <div class="col-md-4">

                <small class="text-muted d-block mb-1">
                    Mulai Mentoring
                </small>

                <strong>
                    15 September 2026
                </strong>

            </div>


            <div class="col-md-4">

                <small class="text-muted d-block mb-1">
                    Durasi
                </small>

                <strong>
                    3 Bulan
                </strong>

            </div>


            <div class="col-md-4">

                <small class="text-muted d-block mb-1">
                    Pertemuan
                </small>

                <strong>
                    2x setiap minggu
                </strong>

            </div>


            <div class="col-md-4">

                <small class="text-muted d-block mb-1">
                    Metode
                </small>

                <strong>
                    Online & Offline
                </strong>

            </div>


        </div>

    </div>

</div>


<!-- PROGRESS -->

<div class="dashboard-card">

    <div class="dashboard-card-header">

        <div>

            <h5 class="dashboard-card-title">
                Progress Mentoring
            </h5>

            <p class="dashboard-card-subtitle">
                Tahapan proses mentoring siswa.
            </p>

        </div>

    </div>


    <div class="px-4 pb-4">


        <!-- STEP 1 -->

        <div class="d-flex align-items-start gap-3 mb-4">

            <div class="student-avatar success">

                <i class="bi bi-check-lg"></i>

            </div>


            <div>

                <strong class="d-block mb-1">
                    Pengajuan Mentoring
                </strong>

                <small class="text-muted">
                    Pengajuan telah diterima oleh sistem.
                </small>

            </div>

        </div>


        <!-- STEP 2 -->

        <div class="d-flex align-items-start gap-3 mb-4">

            <div class="student-avatar success">

                <i class="bi bi-check-lg"></i>

            </div>


            <div>

                <strong class="d-block mb-1">
                    Mentor Ditentukan
                </strong>

                <small class="text-muted">
                    Mentor telah ditentukan untuk siswa.
                </small>

            </div>

        </div>


        <!-- STEP 3 -->

        <div class="d-flex align-items-start gap-3 mb-4">

            <div class="student-avatar primary">

                <i class="bi bi-arrow-repeat"></i>

            </div>


            <div>

                <strong class="d-block mb-1">
                    Mentoring Berlangsung
                </strong>

                <small class="text-muted">
                    Siswa sedang mengikuti proses mentoring.
                </small>

            </div>

        </div>


        <!-- STEP 4 -->

        <div class="d-flex align-items-start gap-3">

            <div class="student-avatar secondary">

                <i class="bi bi-check-circle"></i>

            </div>


            <div>

                <strong class="d-block mb-1 text-muted">
                    Mentoring Selesai
                </strong>

                <small class="text-muted">
                    Tahap akhir mentoring belum selesai.
                </small>

            </div>

        </div>


    </div>

</div>

@endsection