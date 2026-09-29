<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Portal Siswa')
    </title>


    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- CSS Admin -->
    <link
        rel="stylesheet"
        href="{{ asset('css/admin.css') }}"
    >


    <style>

        body {
            background-color: #f5f6fa;
            font-family: Arial, sans-serif;
        }


        /* ============================= */
        /* TOP NAVBAR */
        /* ============================= */

        .client-navbar {
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
        }


        .client-brand {
            color: #1e293b;
            text-decoration: none;
            font-size: 20px;
            font-weight: 700;
        }


        .client-brand:hover {
            color: #2563eb;
        }


        .client-brand-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #eff6ff;
            color: #2563eb;
            border-radius: 10px;
        }


        /* ============================= */
        /* NOTIFICATION */
        /* ============================= */

        .notification-btn {
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 10px;
            background-color: #f8fafc;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }


        .notification-btn:hover {
            background-color: #eff6ff;
            color: #2563eb;
        }


        .notification-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
            top: 8px;
            right: 8px;
        }


        /* ============================= */
        /* PROFILE */
        /* ============================= */

        .client-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 12px;
            border-left: 1px solid #e5e7eb;
        }


        .client-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }


        .client-profile-name {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }


        .client-profile-role {
            font-size: 12px;
            color: #64748b;
        }


        /* ============================= */
        /* CLIENT MENU */
        /* ============================= */

        .client-menu-wrapper {
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
        }


        .client-menu {
            display: flex;
            gap: 8px;
            overflow-x: auto;
        }


        .client-menu::-webkit-scrollbar {
            height: 0;
        }


        .client-menu-item {
            display: flex;
            align-items: center;
            gap: 8px;

            padding: 14px 16px;

            color: #64748b;

            text-decoration: none;

            font-size: 14px;
            font-weight: 500;

            border-bottom: 3px solid transparent;

            white-space: nowrap;

            transition: 0.2s;
        }


        .client-menu-item:hover {
            color: #2563eb;
            background-color: #f8fafc;
        }


        .client-menu-item.active {
            color: #2563eb;
            border-bottom-color: #2563eb;
        }


        .client-menu-item i {
            font-size: 16px;
        }


        /* ============================= */
        /* MAIN CONTENT */
        /* ============================= */

        .client-content {
            min-height: calc(100vh - 125px);
            padding-top: 30px;
            padding-bottom: 40px;
        }


        /* ============================= */
        /* RESPONSIVE */
        /* ============================= */

        @media (max-width: 768px) {

            .client-navbar .container-fluid {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }


            .client-profile-info {
                display: none;
            }


            .client-profile {
                padding-left: 8px;
                border-left: none;
            }


            .client-brand-text {
                display: none;
            }


            .client-menu-wrapper .container-fluid {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }


            .client-menu-item {
                padding: 13px 12px;
            }


            .client-content {
                padding-top: 20px;
                padding-left: 15px;
                padding-right: 15px;
            }

        }

    </style>

</head>


<body>


<!-- ================================= -->
<!-- TOP NAVBAR -->
<!-- ================================= -->

<nav class="navbar client-navbar">

    <div class="container-fluid px-4 py-2">


        <!-- BRAND -->

        <a
            href="/client"
            class="client-brand d-flex align-items-center gap-2"
        >

            <span class="client-brand-icon">

                <i class="bi bi-mortarboard-fill"></i>

            </span>


            <span class="client-brand-text">
                Portal Siswa
            </span>

        </a>



        <!-- RIGHT SIDE -->

        <div class="d-flex align-items-center gap-3">


            <!-- NOTIFICATION -->

            <button
                class="notification-btn"
                type="button"
            >

                <i class="bi bi-bell"></i>

                <span class="notification-dot"></span>

            </button>



            <!-- PROFILE -->

            <div class="client-profile">


                <div class="client-avatar">
                    S
                </div>


                <div class="client-profile-info">

                    <div class="client-profile-name">
                        Siswa
                    </div>

                    <div class="client-profile-role">
                        Peserta Didik
                    </div>

                </div>

            </div>

        </div>

    </div>

</nav>



<!-- ================================= -->
<!-- NAVIGASI CLIENT -->
<!-- ================================= -->

<div class="client-menu-wrapper">

    <div class="container-fluid px-4">

        <div class="client-menu">


            <!-- BERANDA -->

            <a
                href="/client"
                class="client-menu-item
                {{ request()->is('client') ? 'active' : '' }}"
            >

                <i class="bi bi-house"></i>

                <span>
                    Beranda
                </span>

            </a>



            <!-- MENTORING -->

            <a
                href="/client/mentoring"
                class="client-menu-item
                {{ request()->is('client/mentoring') ? 'active' : '' }}"
            >

                <i class="bi bi-briefcase"></i>

                <span>
                    Mentoring
                </span>

            </a>



            <!-- ALUMNI TRACK -->

            <a
                href="/client/alumni-track"
                class="client-menu-item
                {{ request()->is('client/alumni-track') ? 'active' : '' }}"
            >

                <i class="bi bi-mortarboard"></i>

                <span>
                    Alumni Track
                </span>

            </a>



            <!-- TEFA ONLINE -->

            <a
                href="/client/tefa-online"
                class="client-menu-item
                {{ request()->is('client/tefa-online') ? 'active' : '' }}"
            >

                <i class="bi bi-shop"></i>

                <span>
                    TEFA Online
                </span>

            </a>


        </div>

    </div>

</div>



<!-- ================================= -->
<!-- CONTENT -->
<!-- ================================= -->

<main class="container-fluid px-4 client-content">

    @yield('content')

</main>



<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>