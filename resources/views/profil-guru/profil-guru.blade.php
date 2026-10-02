@extends('layouts.app')

@section('title', 'Visi dan Misi')

@section('styles')
@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru - SMK Darma Siswa 1 Sidoarjo</title>
    <link rel="stylesheet" href="{{ asset('css/profil-guru.css') }}?v=2">
</head>
<body>
    <main class="teacher-page">
        <section class="teacher-intro" aria-labelledby="teacher-title">
            <h1 id="teacher-title">PROFIL GURU</h1>
            <p>
                Guru merupakan bagian penting dalam mendukung keberhasilan pendidikan di SMK Darma Siswa 1
                Sidoarjo. Dengan kompetensi, pengalaman, dan dedikasi yang dimiliki, para guru senantiasa
                membimbing siswa dalam mengembangkan potensi, karakter, dan keterampilan. Kenali lebih dekat
                profil guru yang berperan dalam menciptakan pembelajaran berkualitas, membentuk generasi yang
                berkarakter, kompeten, dan siap menghadapi tantangan masa depan. Setiap guru hadir sebagai
                pendidik, pembimbing, sekaligus inspirasi bagi siswa dalam meraih cita-cita dan mengembangkan
                kemampuan sesuai minat serta bakat yang dimiliki.
            </p>
        </section>

        <section class="teacher-list" aria-label="Daftar profil guru">
            <div class="teacher-grid">
                <img class="teacher-row-image" src="{{ asset('images/profil-guru/profil-guru.jpg') }}" alt="Profil guru baris pertama">
                <img class="teacher-row-image" src="{{ asset('images/profil-guru/profil-guru1.jpg') }}" alt="Profil guru baris kedua">
                <img class="teacher-row-image" src="{{ asset('images/profil-guru/profil-guru2.jpg') }}" alt="Profil guru baris ketiga">
            </div>
        </section>
    </main>
</body>
<script src="{{ asset('js/profil-guru.js') }}"></script>
</html>

@endsection
