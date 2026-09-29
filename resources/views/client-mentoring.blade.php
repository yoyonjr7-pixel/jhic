@extends('layouts.client')

@section('title', 'Mentoring')

@section('content')

```
<!-- ============================== -->
<!-- HEADER -->
<!-- ============================== -->

<div class="mb-4">

    <h2 class="fw-bold mb-2">
        Mentoring
    </h2>

    <p class="text-muted mb-0">
        Pantau proses mentoring dan informasi mentor kamu.
    </p>

</div>



<!-- ============================== -->
<!-- STATUS UTAMA -->
<!-- ============================== -->

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4">

        <div class="row align-items-center">


            <!-- ICON -->

            <div class="col-auto">

                <div
                    class="rounded-circle bg-warning bg-opacity-10
                           d-flex align-items-center justify-content-center"
                    style="width: 65px; height: 65px;"
                >

                    <i class="bi bi-clock-history text-warning fs-3"></i>

                </div>

            </div>



            <!-- STATUS -->

            <div class="col">

                <small class="text-muted">
                    Status Mentoring
                </small>

                <h3 class="fw-bold mb-1">
                    Dalam Proses
                </h3>

                <p class="text-muted mb-0">
                    Mentoring kamu sedang berjalan bersama alumni mentor.
                </p>

            </div>



            <!-- BADGE -->

            <div class="col-auto">

                <span class="badge bg-warning text-dark px-3 py-2">
                    Dalam Proses
                </span>

            </div>

        </div>

    </div>

</div>



<!-- ============================== -->
<!-- INFORMASI MENTOR -->
<!-- ============================== -->

<div class="row g-4 mb-4">


    <!-- DATA MENTOR -->

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    Informasi Mentor
                </h5>


                <div class="d-flex align-items-center gap-3 mb-4">

                    <div
                        class="rounded-circle bg-primary text-white
                               d-flex align-items-center justify-content-center"
                        style="width: 55px; height: 55px;"
                    >

                        BS

                    </div>


                    <div>

                        <h5 class="fw-bold mb-1">
                            Budi Santoso
                        </h5>

                        <p class="text-muted mb-0">
                            Alumni TJKT
                        </p>

                    </div>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Perusahaan
                    </small>

                    <strong>
                        PT Teknologi Nusantara
                    </strong>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Posisi
                    </small>

                    <strong>
                        IT Support
                    </strong>

                </div>


                <div>

                    <small class="text-muted d-block">
                        Pengalaman
                    </small>

                    <strong>
                        3 Tahun
                    </strong>

                </div>

            </div>

        </div>

    </div>



    <!-- DETAIL MENTORING -->

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    Detail Mentoring
                </h5>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Nama Siswa
                    </small>

                    <strong>
                        Andi Pratama
                    </strong>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Jurusan
                    </small>

                    <strong>
                        TJKT
                    </strong>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Bidang Mentoring
                    </small>

                    <strong>
                        IT Support & Networking
                    </strong>

                </div>


                <div>

                    <small class="text-muted d-block">
                        Mulai Mentoring
                    </small>

                    <strong>
                        15 September 2026
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- ============================== -->
<!-- PROGRESS -->
<!-- ============================== -->

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <h5 class="fw-bold mb-1">
            Progress Mentoring
        </h5>

        <p class="text-muted small mb-4">
            Perkembangan proses mentoring kamu.
        </p>


        <!-- STEP 1 -->

        <div class="d-flex gap-3 mb-4">

            <div
                class="rounded-circle bg-success text-white
                       d-flex align-items-center justify-content-center"
                style="width: 38px; height: 38px;"
            >

                <i class="bi bi-check-lg"></i>

            </div>


            <div>

                <strong>
                    Pengajuan Mentoring
                </strong>

                <p class="text-muted small mb-0">
                    Pengajuan mentoring telah diterima.
                </p>

            </div>

        </div>



        <!-- STEP 2 -->

        <div class="d-flex gap-3 mb-4">

            <div
                class="rounded-circle bg-success text-white
                       d-flex align-items-center justify-content-center"
                style="width: 38px; height: 38px;"
            >

                <i class="bi bi-check-lg"></i>

            </div>


            <div>

                <strong>
                    Mentor Ditentukan
                </strong>

                <p class="text-muted small mb-0">
                    Kamu telah mendapatkan alumni mentor.
                </p>

            </div>

        </div>



        <!-- STEP 3 -->

        <div class="d-flex gap-3 mb-4">

            <div
                class="rounded-circle bg-warning text-dark
                       d-flex align-items-center justify-content-center"
                style="width: 38px; height: 38px;"
            >

                <i class="bi bi-arrow-repeat"></i>

            </div>


            <div>

                <strong>
                    Mentoring Berlangsung
                </strong>

                <p class="text-muted small mb-0">
                    Sesi mentoring sedang dalam proses.
                </p>

            </div>

        </div>



        <!-- STEP 4 -->

        <div class="d-flex gap-3">

            <div
                class="rounded-circle bg-light text-muted
                       d-flex align-items-center justify-content-center"
                style="width: 38px; height: 38px;"
            >

                <i class="bi bi-check-lg"></i>

            </div>


            <div>

                <strong class="text-muted">
                    Mentoring Selesai
                </strong>

                <p class="text-muted small mb-0">
                    Menunggu proses mentoring selesai.
                </p>

            </div>

        </div>

    </div>

</div>
```

@endsection
