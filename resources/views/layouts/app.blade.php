<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<link rel="stylesheet"
href="{{ asset('css/bootstrap.min.css') }}">

<!-- Animasi global: konten muncul saat halaman dibuka & saat scroll -->
<link rel="stylesheet"
href="/css/animations.css?v=10">
<script src="/js/animations.js?v=10"></script>
</head>
<body>
@include('layouts.navbar')
@include('layouts.mainfitur')

@include('layouts.footer')


<script src="{{ asset('js/bootstrap.bundle.min.js')
}}"></script>
</body>
</html>
