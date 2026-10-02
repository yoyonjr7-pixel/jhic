@extends('layouts.client')

@section('title', 'Portal Siswa')

@section('content')

<!-- ============================== -->
<!-- WELCOME -->
<!-- ============================== -->

<div class="mb-4">

    <h2 class="fw-bold mb-2">
        Halo, Siswa 👋
    </h2>

    <p class="text-muted mb-0">
        Selamat datang di portal siswa. Pantau aktivitas dan status kamu di sini.
    </p>

</div>



<!-- ============================== -->
<!-- RINGKASAN STATUS -->
<!-- ============================== -->

<div class="row g-4 mb-4">


    <!-- MENTORING -->

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted mb-2">
                            Mentoring
                        </p>

                        <h4 class="fw-bold mb-2">
                            Dalam Proses
                        </h4>

                        <small class="text-warning">
                            <i class="bi bi-clock me-1"></i>
                            Sedang berjalan
                        </small>

                    </div>


                    <div class="rounded-3 bg-primary bg-opacity-10 p-3">

                        <i class="bi bi-briefcase-fill text-primary fs-4"></i>

                    </div>

                </div>


                <hr>


                <small class="text-muted">
                    Mentor: Budi Santoso
                </small>

            </div>

        </div>

    </div>



    <!-- ALUMNI TRACK -->

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted mb-2">
                            Alumni Track
                        </p>

                        <h4 class="fw-bold mb-2">
                            Belum Diverifikasi
                        </h4>

                        <small class="text-danger">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            Perlu diperbarui
                        </small>

                    </div>


                    <div class="rounded-3 bg-success bg-opacity-10 p-3">

                        <i class="bi bi-mortarboard-fill text-success fs-4"></i>

                    </div>

                </div>


                <hr>


                <small class="text-muted">
                    Status pendataan alumni
                </small>

            </div>

        </div>

    </div>



    <!-- TEFA -->

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted mb-2">
                            TEFA Online
                        </p>

                        <h4 class="fw-bold mb-2">
                            Sedang Diproses
                        </h4>

                        <small class="text-info">
                            <i class="bi bi-arrow-repeat me-1"></i>
                            Dalam pengerjaan
                        </small>

                    </div>


                    <div class="rounded-3 bg-warning bg-opacity-10 p-3">

                        <i class="bi bi-shop text-warning fs-4"></i>

                    </div>

                </div>


                <hr>


                <small class="text-muted">
                    Pesanan: Pembuatan Website
                </small>

            </div>

        </div>

    </div>

</div>



<!-- ============================== -->
<!-- INFORMASI -->
<!-- ============================== -->

<div class="row g-4">


    <!-- AKTIVITAS TERBARU -->

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold mb-1">
                    Aktivitas Terbaru
                </h5>

                <p class="text-muted small mb-4">
                    Informasi terbaru mengenai aktivitas kamu.
                </p>


                <!-- AKTIVITAS 1 -->

                <div class="d-flex align-items-center gap-3 mb-4">

                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary
                                d-flex align-items-center justify-content-center"
                         style="width: 42px; height: 42px;">

                        <i class="bi bi-briefcase-fill"></i>

                    </div>


                    <div class="flex-grow-1">

                        <strong>
                            Mentoring sedang diproses
                        </strong>

                        <p class="text-muted small mb-0">
                            Sesi mentoring bersama Budi Santoso sedang berjalan.
                        </p>

                    </div>


                    <small class="text-muted">
                        Hari ini
                    </small>

                </div>



                <!-- AKTIVITAS 2 -->

                <div class="d-flex align-items-center gap-3 mb-4">

                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning
                                d-flex align-items-center justify-content-center"
                         style="width: 42px; height: 42px;">

                        <i class="bi bi-shop"></i>

                    </div>


                    <div class="flex-grow-1">

                        <strong>
                            Pesanan TEFA diperbarui
                        </strong>

                        <p class="text-muted small mb-0">
                            Pesanan Pembuatan Website sedang dikerjakan.
                        </p>

                    </div>


                    <small class="text-muted">
                        Kemarin
                    </small>

                </div>



                <!-- AKTIVITAS 3 -->

                <div class="d-flex align-items-center gap-3">

                    <div class="rounded-circle bg-success bg-opacity-10 text-success
                                d-flex align-items-center justify-content-center"
                         style="width: 42px; height: 42px;">

                        <i class="bi bi-person-check-fill"></i>

                    </div>


                    <div class="flex-grow-1">

                        <strong>
                            Data profil diperbarui
                        </strong>

                        <p class="text-muted small mb-0">
                            Informasi profil siswa berhasil diperbarui.
                        </p>

                    </div>


                    <small class="text-muted">
                        2 hari lalu
                    </small>

                </div>

            </div>

        </div>

    </div>



    <!-- AKSES CEPAT -->

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold mb-1">
                    Akses Cepat
                </h5>

                <p class="text-muted small mb-4">
                    Akses fitur yang tersedia.
                </p>


                <a
                    href="/client/mentoring"
                    class="btn btn-outline-primary w-100 mb-3 text-start"
                >

                    <i class="bi bi-briefcase me-2"></i>

                    Lihat Mentoring

                    <i class="bi bi-arrow-right float-end"></i>

                </a>


                <a
                    href="/client/alumni-track"
                    class="btn btn-outline-success w-100 mb-3 text-start"
                >

                    <i class="bi bi-mortarboard me-2"></i>

                    Alumni Track

                    <i class="bi bi-arrow-right float-end"></i>

                </a>


                <a
                    href="/client/tefa-online"
                    class="btn btn-outline-warning w-100 text-start"
                >

                    <i class="bi bi-shop me-2"></i>

                    TEFA Online

                    <i class="bi bi-arrow-right float-end"></i>

                </a>

            </div>

        </div>

    </div>

</div>
```

@endsection
