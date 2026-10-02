@extends('layouts.client')

@section('title', 'Alumni Track')

@section('content')

```
<!-- ============================== -->
<!-- HEADER -->
<!-- ============================== -->

<div class="mb-4">

    <h2 class="fw-bold mb-2">
        Alumni Track
    </h2>

    <p class="text-muted mb-0">
        Pantau dan perbarui informasi perjalanan setelah lulus dari sekolah.
    </p>

</div>



<!-- ============================== -->
<!-- STATUS PENDATAAN -->
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

                    <i class="bi bi-hourglass-split text-warning fs-3"></i>

                </div>

            </div>



            <!-- STATUS -->

            <div class="col">

                <small class="text-muted">
                    Status Pendataan
                </small>

                <h3 class="fw-bold mb-1">
                    Belum Diverifikasi
                </h3>

                <p class="text-muted mb-0">
                    Silakan pastikan informasi pekerjaan atau usaha kamu sudah sesuai.
                </p>

            </div>



            <!-- BADGE -->

            <div class="col-auto">

                <span class="badge bg-warning text-dark px-3 py-2">
                    Belum Diverifikasi
                </span>

            </div>

        </div>

    </div>

</div>



<!-- ============================== -->
<!-- DATA DIRI -->
<!-- ============================== -->

<div class="row g-4 mb-4">


    <!-- PROFIL -->

    <div class="col-lg-5">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    Data Alumni
                </h5>


                <!-- AVATAR -->

                <div class="text-center mb-4">

                    <div
                        class="rounded-circle bg-primary text-white
                               d-flex align-items-center justify-content-center
                               mx-auto mb-3"
                        style="width: 75px; height: 75px; font-size: 24px;"
                    >

                        AP

                    </div>


                    <h5 class="fw-bold mb-1">
                        Andi Pratama
                    </h5>

                    <p class="text-muted mb-0">
                        Alumni TJKT • Lulusan 2026
                    </p>

                </div>


                <div class="border-top pt-3">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Email
                        </small>

                        <strong>
                            andi@example.com
                        </strong>

                    </div>


                    <div>

                        <small class="text-muted d-block">
                            Nomor Telepon
                        </small>

                        <strong>
                            0812-3456-7890
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- STATUS PEKERJAAN -->

    <div class="col-lg-7">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h5 class="fw-bold mb-0">
                        Aktivitas Setelah Lulus
                    </h5>


                    <button class="btn btn-sm btn-outline-primary">

                        <i class="bi bi-pencil me-1"></i>

                        Perbarui Data

                    </button>

                </div>


                <!-- STATUS -->

                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Status Saat Ini
                    </small>

                    <h5 class="fw-bold">
                        Sudah Bekerja
                    </h5>

                </div>


                <!-- PERUSAHAAN -->

                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Perusahaan
                    </small>

                    <h5 class="fw-bold mb-1">
                        PT Teknologi Nusantara
                    </h5>

                    <small class="text-muted">
                        Perusahaan bidang teknologi informasi
                    </small>

                </div>


                <!-- POSISI -->

                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Posisi / Jabatan
                    </small>

                    <strong>
                        IT Support
                    </strong>

                </div>


                <!-- TAHUN -->

                <div>

                    <small class="text-muted d-block mb-1">
                        Tahun Mulai Bekerja
                    </small>

                    <strong>
                        2026
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- ============================== -->
<!-- PROSES VERIFIKASI -->
<!-- ============================== -->

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <h5 class="fw-bold mb-1">
            Proses Pendataan
        </h5>

        <p class="text-muted small mb-4">
            Tahapan proses pendataan alumni kamu.
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
                    Data Diisi
                </strong>

                <p class="text-muted small mb-0">
                    Data alumni telah diisi dan dikirim.
                </p>

            </div>

        </div>



        <!-- STEP 2 -->

        <div class="d-flex gap-3 mb-4">

            <div
                class="rounded-circle bg-warning text-dark
                       d-flex align-items-center justify-content-center"
                style="width: 38px; height: 38px;"
            >

                <i class="bi bi-hourglass-split"></i>

            </div>


            <div>

                <strong>
                    Menunggu Verifikasi
                </strong>

                <p class="text-muted small mb-0">
                    Data sedang menunggu pemeriksaan admin.
                </p>

            </div>

        </div>



        <!-- STEP 3 -->

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
                    Data Terverifikasi
                </strong>

                <p class="text-muted small mb-0">
                    Data akan berstatus terverifikasi setelah diperiksa admin.
                </p>

            </div>

        </div>

    </div>

</div>
```

@endsection
