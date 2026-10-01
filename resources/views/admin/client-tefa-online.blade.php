@extends('layouts.client')

@section('title', 'TEFA Online')

@section('content')

```
<!-- ============================== -->
<!-- HEADER -->
<!-- ============================== -->

<div class="mb-4">

    <h2 class="fw-bold mb-2">
        TEFA Online
    </h2>

    <p class="text-muted mb-0">
        Pantau pesanan dan aktivitas TEFA yang sedang kamu jalankan.
    </p>

</div>



<!-- ============================== -->
<!-- STATUS PESANAN -->
<!-- ============================== -->

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4">

        <div class="row align-items-center">


            <!-- ICON -->

            <div class="col-auto">

                <div
                    class="rounded-circle bg-info bg-opacity-10
                           d-flex align-items-center justify-content-center"
                    style="width: 65px; height: 65px;"
                >

                    <i class="bi bi-arrow-repeat text-info fs-3"></i>

                </div>

            </div>



            <!-- STATUS -->

            <div class="col">

                <small class="text-muted">
                    Status Pesanan
                </small>

                <h3 class="fw-bold mb-1">
                    Sedang Diproses
                </h3>

                <p class="text-muted mb-0">
                    Pesanan kamu sedang dikerjakan oleh tim TEFA.
                </p>

            </div>



            <!-- BADGE -->

            <div class="col-auto">

                <span class="badge bg-info text-dark px-3 py-2">
                    Sedang Diproses
                </span>

            </div>

        </div>

    </div>

</div>



<!-- ============================== -->
<!-- DETAIL PESANAN -->
<!-- ============================== -->

<div class="row g-4 mb-4">


    <!-- INFORMASI PESANAN -->

    <div class="col-lg-7">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Detail Pesanan
                        </h5>

                        <p class="text-muted small mb-0">
                            Informasi pesanan TEFA kamu.
                        </p>

                    </div>


                    <span class="badge bg-light text-dark">
                        #TEFA-0024
                    </span>

                </div>


                <!-- PRODUK -->

                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Produk / Layanan
                    </small>

                    <h5 class="fw-bold mb-1">
                        Pembuatan Website
                    </h5>

                    <small class="text-muted">
                        Jasa pengembangan website sekolah dan UMKM
                    </small>

                </div>


                <!-- JURUSAN -->

                <div class="mb-4">

                    <small class="text-muted d-block mb-1">
                        Jurusan / Tim
                    </small>

                    <strong>
                        TJKT
                    </strong>

                </div>


                <!-- TANGGAL -->

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <small class="text-muted d-block mb-1">
                            Tanggal Pesanan
                        </small>

                        <strong>
                            20 September 2026
                        </strong>

                    </div>


                    <div class="col-md-6 mb-3">

                        <small class="text-muted d-block mb-1">
                            Target Selesai
                        </small>

                        <strong>
                            30 September 2026
                        </strong>

                    </div>

                </div>


                <!-- PEMESAN -->

                <div>

                    <small class="text-muted d-block mb-1">
                        Pemesan
                    </small>

                    <strong>
                        CV Maju Jaya
                    </strong>

                </div>

            </div>

        </div>

    </div>



    <!-- TIM PENGERJA -->

    <div class="col-lg-5">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    Tim Pengerja
                </h5>


                <div class="d-flex align-items-center gap-3 mb-4">

                    <div
                        class="rounded-circle bg-primary text-white
                               d-flex align-items-center justify-content-center"
                        style="width: 55px; height: 55px;"
                    >

                        TJ

                    </div>


                    <div>

                        <h6 class="fw-bold mb-1">
                            Tim TJKT
                        </h6>

                        <p class="text-muted small mb-0">
                            Teaching Factory TJKT
                        </p>

                    </div>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Penanggung Jawab
                    </small>

                    <strong>
                        Andi Pratama
                    </strong>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Jenis Layanan
                    </small>

                    <strong>
                        Pengembangan Website
                    </strong>

                </div>


                <div>

                    <small class="text-muted d-block">
                        Status
                    </small>

                    <span class="badge bg-info text-dark mt-1">
                        Sedang Diproses
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- ============================== -->
<!-- PROGRESS PESANAN -->
<!-- ============================== -->

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <h5 class="fw-bold mb-1">
            Progress Pesanan
        </h5>

        <p class="text-muted small mb-4">
            Pantau tahapan pengerjaan pesanan kamu.
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
                    Pesanan Diterima
                </strong>

                <p class="text-muted small mb-0">
                    Pesanan telah diterima oleh tim TEFA.
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
                    Pesanan Dikonfirmasi
                </strong>

                <p class="text-muted small mb-0">
                    Detail pekerjaan telah dikonfirmasi.
                </p>

            </div>

        </div>



        <!-- STEP 3 -->

        <div class="d-flex gap-3 mb-4">

            <div
                class="rounded-circle bg-info text-dark
                       d-flex align-items-center justify-content-center"
                style="width: 38px; height: 38px;"
            >

                <i class="bi bi-arrow-repeat"></i>

            </div>


            <div>

                <strong>
                    Sedang Dikerjakan
                </strong>

                <p class="text-muted small mb-0">
                    Tim TEFA sedang mengerjakan pesanan kamu.
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
                    Pesanan Selesai
                </strong>

                <p class="text-muted small mb-0">
                    Pesanan akan ditandai selesai setelah pengerjaan selesai.
                </p>

            </div>

        </div>

    </div>

</div>
```

@endsection
