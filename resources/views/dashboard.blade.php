@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')

@section('content')


<div class="dashboard-welcome mb-4">

    <div>

        <h2 class="mt-3 mb-2">
            Selamat Datang, Admin 
        </h2>


        <p class="text-muted mb-0">
            Pantau dan kelola seluruh aktivitas sistem sekolah melalui dashboard.
        </p>

    </div>

</div>

<div class="row g-3 mb-4">

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Pengajuan Mentoring
                    </p>


                    <h2 class="stat-number">
                        24
                    </h2>


                    <span class="stat-status warning">

                        <i class="bi bi-clock"></i>

                        8 menunggu

                    </span>

                </div>


                <div class="stat-icon primary">

                    <i class="bi bi-briefcase-fill"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Total Alumni
                    </p>


                    <h2 class="stat-number">
                        156
                    </h2>


                    <span class="stat-status success">

                        <i class="bi bi-check-circle-fill"></i>

                        130 terdata

                    </span>

                </div>


                <div class="stat-icon success">

                    <i class="bi bi-mortarboard-fill"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Aktivitas TEFA
                    </p>


                    <h2 class="stat-number">
                        42
                    </h2>


                    <span class="stat-status info">

                        <i class="bi bi-arrow-repeat"></i>

                        18 diproses

                    </span>

                </div>


                <div class="stat-icon info">

                    <i class="bi bi-shop"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-xl-3 col-md-6">

        <div class="dashboard-stat-card">

            <div class="stat-content">

                <div>

                    <p class="stat-label">
                        Perlu Verifikasi
                    </p>


                    <h2 class="stat-number">
                        26
                    </h2>


                    <span class="stat-status danger">

                        <i class="bi bi-exclamation-circle-fill"></i>

                        Perlu ditindaklanjuti

                    </span>

                </div>


                <div class="stat-icon danger">

                    <i class="bi bi-shield-exclamation"></i>

                </div>

            </div>

        </div>

    </div>


</div>


<div class="row g-3">


    <div class="col-xl-7">

        <div class="dashboard-card h-100">


            <div class="dashboard-card-header">

                <div>

                    <h5 class="dashboard-card-title">
                        Status Mentoring Terbaru
                    </h5>


                    <p class="dashboard-card-subtitle">
                        Perkembangan mentoring siswa terbaru.
                    </p>

                </div>


                <a
                    href="/mentoring"
                    class="btn btn-primary btn-sm"
                >

                    Lihat Semua

                    <i class="bi bi-arrow-right ms-1"></i>

                </a>

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


                                    <strong>
                                        Andi Pratama
                                    </strong>

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


                                    <strong>
                                        Rizky Ramadhan
                                    </strong>

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


                                    <strong>
                                        Dimas Saputra
                                    </strong>

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

                        </tr>


                    </tbody>


                </table>

            </div>


        </div>

    </div>

    <div class="col-xl-5">

        <div class="dashboard-card h-100">


            <!-- HEADER -->

            <div class="dashboard-card-header">

                <div>

                    <h5 class="dashboard-card-title">
                        Ringkasan Mentoring
                    </h5>


                    <p class="dashboard-card-subtitle">
                        Status seluruh pengajuan mentoring.
                    </p>

                </div>

            </div>



            <!-- ================================= -->
            <!-- MENUNGGU -->
            <!-- ================================= -->

            <div class="progress-item">

                <div class="progress-info">

                    <span>
                        Menunggu
                    </span>


                    <strong>
                        8
                    </strong>

                </div>


                <div class="progress dashboard-progress">

                    <div
                        class="progress-bar bg-secondary"
                        style="width: 33%;"
                    ></div>

                </div>

            </div>



            <!-- ================================= -->
            <!-- DALAM PROSES -->
            <!-- ================================= -->

            <div class="progress-item">

                <div class="progress-info">

                    <span>
                        Dalam Proses
                    </span>


                    <strong>
                        10
                    </strong>

                </div>


                <div class="progress dashboard-progress">

                    <div
                        class="progress-bar bg-warning"
                        style="width: 42%;"
                    ></div>

                </div>

            </div>



            <!-- ================================= -->
            <!-- SELESAI -->
            <!-- ================================= -->

            <div class="progress-item">

                <div class="progress-info">

                    <span>
                        Selesai
                    </span>


                    <strong>
                        6
                    </strong>

                </div>


                <div class="progress dashboard-progress">

                    <div
                        class="progress-bar bg-success"
                        style="width: 25%;"
                    ></div>

                </div>

            </div>



            <!-- ================================= -->
            <!-- TOTAL -->
            <!-- ================================= -->

            <div class="dashboard-total">

                <span>
                    Total Pengajuan
                </span>


                <strong>
                    24
                </strong>

            </div>


        </div>

    </div>


</div>



<!-- ========================================= -->
<!-- AKTIVITAS TERBARU -->
<!-- ========================================= -->

<div class="dashboard-card mt-3">


    <!-- HEADER -->

    <div class="dashboard-card-header">

        <div>

            <h5 class="dashboard-card-title">
                Aktivitas Terbaru
            </h5>


            <p class="dashboard-card-subtitle">
                Aktivitas terbaru dari seluruh fitur dashboard.
            </p>

        </div>


        <span class="text-muted small">
            Hari ini
        </span>

    </div>



    <!-- ================================= -->
    <!-- AKTIVITAS 1 -->
    <!-- ================================= -->

    <div class="activity-item">


        <div class="activity-icon primary">

            <i class="bi bi-briefcase-fill"></i>

        </div>


        <div class="activity-content">

            <strong>
                Pengajuan mentoring baru
            </strong>


            <p>
                Andi Pratama mengajukan mentoring kepada Budi Santoso.
            </p>

        </div>


        <span class="activity-time">
            10 menit lalu
        </span>


    </div>



    <!-- ================================= -->
    <!-- AKTIVITAS 2 -->
    <!-- ================================= -->

    <div class="activity-item">


        <div class="activity-icon success">

            <i class="bi bi-mortarboard-fill"></i>

        </div>


        <div class="activity-content">

            <strong>
                Data alumni diperbarui
            </strong>


            <p>
                Data alumni baru berhasil ditambahkan ke Alumni Track.
            </p>

        </div>


        <span class="activity-time">
            1 jam lalu
        </span>


    </div>



    <!-- ================================= -->
    <!-- AKTIVITAS 3 -->
    <!-- ================================= -->

    <div class="activity-item">


        <div class="activity-icon warning">

            <i class="bi bi-shop"></i>

        </div>


        <div class="activity-content">

            <strong>
                Pesanan TEFA baru
            </strong>


            <p>
                Pesanan pembuatan website masuk ke TEFA Online.
            </p>

        </div>


        <span class="activity-time">
            2 jam lalu
        </span>


    </div>


</div>


@endsection