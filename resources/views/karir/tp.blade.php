@extends('layouts.app')

@section('title', 'Karir TP')

@section('styles')
    <link rel="stylesheet" href="/css/karir.css">
@endsection

@section('content')
    <div class="page">

  <!-- HERO -->
  <section class="hero">
    <div class="hero-text">
      <div class="eyebrow">KARIR MASA DEPAN</div>
      <h1>PILIH JURUSAN,<br>RAIH <span class="accent">MASA DEPAN!</span></h1>
      <p>Temukan peluang karir terbaik sesuai dengan jurusan pilihanmu. Rencanakan masa depanmu mulai dari sekarang.</p>
    </div>
    <div class="hero-art">
      <svg width="300" height="200" xmlns="http://www.w3.org/2000/svg">
  <image href="images/tp.png" width="300" height="200" />
</svg>
    </div>
  </section>

  <!-- TABS -->
  <div class="tabs">
    <a href="karir">
    <button class="tab-btn" data-tab="TJKT">TJKT</button>
    </a>
    <a href="tkr">
    <button class="tab-btn" data-tab="TKR">TKR</button>
    </a>
    <a href="tbsm">
    <button class="tab-btn" data-tab="TSM">TBSM</button>
    </a>
    <a href="tp">
    <button class="tab-btn active" data-tab="TP">TP</button>
    </a>
  </div>

  <!-- CAREER CARDS -->
  <div class="cards" id="cardsWrap">
    @forelse ($lowongan as $loker)
    <div class="card">
      <h3>{{ $loker->nama_lowongan }}</h3>
      <p class="desc">{{ $loker->deskripsi }}</p>
      @if ($loker->gaji_min && $loker->gaji_max)
      <div class="salary-label">Estimasi Gaji</div>
      <div class="salary-box">Rp. {{ number_format($loker->gaji_min, 0, ',', '.') }} - {{ number_format($loker->gaji_max, 0, ',', '.') }}</div>
      @endif
      @if (!empty($loker->skills))
      <div class="skills">
        <div class="skills-label">Skill yang di butuhkan :</div>
        <ul>
          @foreach ((array) $loker->skills as $skill)
          <li>{{ $skill }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <button class='lowongan'>Lamar Sekarang</button>
    </div>
    @empty
    <div class="card">
      <h3>BELUM ADA LOWONGAN</h3>
      <p class="desc">Belum ada lowongan kerja yang dibuka untuk jurusan ini.</p>
    </div>
    @endforelse
  </div>

  <!-- MENTORING ALUMNI -->
  <section class="mentoring">
    <h2>MENTORING ALUMNI</h2>
    <p>Daftar mentor ini diambil otomatis dari alumni yang sudah mengisi data dan bersedia membimbing.</p>
    <div class="mentor-grid">
      <div class="mentor-card">
        <div class="avatar">YP</div>
        <h4>Yoga Pratama</h4>
        <hr class="divider">
        <div class="verified">✓ Data Terverifikasi TU</div>
        <p class="mentor-desc">Berpengalaman mengoperasikan mesin produksi dan membuat komponen sesuai gambar teknik.</p>
        <button
        type="button"
        class="mentor-btn"
        onclick="openMentoringModal('Yoga Pratama')">
        Ajukan Mentoring
      </button>
      </div>
      <div class="mentor-card">
        <div class="avatar">RK</div>
        <h4>Reza Kurniawan</h4>
        <hr class="divider">
        <div class="verified">✓ Data Terverifikasi TU</div>
        <p class="mentor-desc">Berpengalaman dalam proses produksi dan perawatan mesin industri.</p>
        <button
        type="button"
        class="mentor-btn"
        onclick="openMentoringModal('Reza Kurniawan')">
        Ajukan Mentoring
      </button>
      </div>
      <div class="mentor-card">
        <div class="avatar">IS</div>
        <h4>Ilham Setiawan</h4>
        <hr class="divider">
        <div class="verified">✓ Data Terverifikasi TU</div>
        <p class="mentor-desc">Mengembangkan keterampilan CNC sejak sekolah dan sekarang bekerja di bidang manufaktur.</p>
        <button
        type="button"
        class="mentor-btn"
        onclick="openMentoringModal('Ilham Setiawan')">
        Ajukan Mentoring
      </button>
      </div>
    </div>
  </section>

</div>

<script src="/js/karir.js" defer></script>

@include('karir.partials.mentoring-modal')
@endsection