<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - SMK Dashboard</title>


    <!-- ================================= -->
    <!-- BOOTSTRAP -->
    <!-- ================================= -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- ================================= -->
    <!-- BOOTSTRAP ICONS -->
    <!-- ================================= -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            min-height: 100vh;

            margin: 0;

            background: #f4f6f9;

            display: flex;

            align-items: center;

            justify-content: center;

            font-family:
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

        }


        .login-card {

            width: 100%;

            max-width: 420px;

            background: #ffffff;

            border-radius: 18px;

            padding: 38px;

            box-shadow:
                0 15px 45px rgba(0, 0, 0, 0.08);

        }


        .login-icon {

            width: 65px;

            height: 65px;

            margin: 0 auto 20px;

            border-radius: 16px;

            background: #212529;

            color: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;

        }


        .login-title {

            font-weight: 700;
            color: #212529;
            margin-bottom: 6px;
            font-size:22px

        }


        .login-subtitle {

            color: #6c757d;

            font-size: 14px;

            margin-bottom: 30px;

        }


        .form-label {

            font-weight: 600;

            font-size: 14px;

            color: #343a40;

        }


        .form-control {

            padding: 12px 14px;

            border-radius: 10px;

            border: 1px solid #dee2e6;

        }


        .form-control:focus {

            border-color: #212529;

            box-shadow:
                0 0 0 3px rgba(33, 37, 41, 0.08);

        }


        .btn-login {

            width: 100%;

            padding: 12px;

            border-radius: 10px;

            font-weight: 600;

        }


        .login-footer {

            margin-top: 25px;

            text-align: center;

            color: #98a2b3;

            font-size: 12px;

        }

    </style>

</head>


<body>


    <!-- ================================= -->
    <!-- LOGIN CARD -->
    <!-- ================================= -->

    <div class="login-card">


        <!-- TITLE -->

        <div class="text-center">

            <h2 class="login-title">

                SMK DARMA SISWA 1 SIDOARJO

            </h2>


            <p class="login-subtitle">

                Silakan login sebagai administrator

            </p>

        </div>


        <!-- ================================= -->
        <!-- ERROR -->
        <!-- ================================= -->

        @if ($errors->any())

            <div class="alert alert-danger">

                <i class="bi bi-exclamation-circle me-2"></i>

                {{ $errors->first() }}

            </div>

        @endif


        <!-- ================================= -->
        <!-- SUCCESS -->
        <!-- ================================= -->

        @if (session('success'))

            <div class="alert alert-success">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        <!-- ================================= -->
        <!-- LOGIN FORM -->
        <!-- ================================= -->

        <form
            action="{{ route('login.process') }}"
            method="POST"
        >

            @csrf


            <!-- USERNAME -->

            <div class="mb-3">

                <label
                    for="username"
                    class="form-label"
                >

                    Username

                </label>


                <input
                    type="text"
                    name="username"
                    id="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    value="{{ old('username') }}"
                    autocomplete="username"
                    required
                    autofocus
                >

            </div>


            <!-- PASSWORD -->

            <div class="mb-3">

                <label
                    for="password"
                    class="form-label"
                >

                    Password

                </label>


                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

            </div>



            <!-- BUTTON -->

            <button
                type="submit"
                class="btn btn-dark btn-login"
            >

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Login

            </button>

        </form>


        <!-- FOOTER -->

        <div class="login-footer">

            Sistem Manajemen Sekolah

        </div>


    </div>


</body>

</html>