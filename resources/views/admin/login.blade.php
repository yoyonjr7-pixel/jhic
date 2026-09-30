<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - SMK Darma Siswa 1 Sidoarjo</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <main class="login-card">
        <header class="login-header">
            <div class="login-icon" aria-hidden="true">&#128274;</div>
            <h1 class="login-title">SMK DARMA SISWA 1 SIDOARJO</h1>
            <p class="login-subtitle">Silakan login sebagai administrator</p>
        </header>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif
        <form method="post" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" value="{{ old('username') }}" placeholder="Masukkan username" autocomplete="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Kata sandi</label>
                <input id="password" name="password" type="password" placeholder="Masukkan kata sandi" autocomplete="current-password" required>
            </div>
            <button type="submit" class="btn-login">Masuk</button>
        </form>
        <footer class="login-footer">Sistem Manajemen Sekolah</footer>
    </main>
</body>
</html>
