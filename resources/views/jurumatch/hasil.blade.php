<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JuruMatch - Hasil</title>
        <link rel="stylesheet" href="/css/JuruMatch/hasil.css">
        <link rel="stylesheet" href="/css/JuruMatch/motion.css">
    </head>
    <body class="result-page">
        <div class="result-shell">
            <header class="result-header">
                <div class="result-title">JuruMatch</div>
            </header>

            <main class="result-main">
                <section class="result-summary">
                    <p>HASIL ANALISIS MINAT</p>
                    <h1>{{ $kode }} - {{ $hasil[$kode]['nama'] }}</h1>
                    <small>
                        Berdasarkan jawabanmu, kecocokan tertinggi ada pada jurusan ini dengan
                        {{ min((int) (($points[$kode] ?? 0) / $maxPoints * 100), 100) }}%.
                    </small>
                </section>

                <section class="score-list" aria-label="Hasil kecocokan jurusan">
                    @foreach ($hasil as $itemKode => $item)
                        <div class="score-item">
                            <div class="score-label">
                                <span>{{ $itemKode }} - {{ $item['nama'] }}</span>
                                <strong>{{ min((int) (($points[$itemKode] ?? 0) / $maxPoints * 100), 100) }}%</strong>
                            </div>
                            <div class="score-bar {{ $itemKode === $kode ? 'is-active' : '' }}">
                                <span style="width: {{ min((int) (($points[$itemKode] ?? 0) / $maxPoints * 100), 100) }}%"></span>
                            </div>
                        </div>
                    @endforeach
                </section>

                <section class="major-info">
                    <h2>TENTANG JURUSAN INI</h2>
                    <p>{{ $hasil[$kode]['deskripsi'] }}</p>
                    <ul>
                        @foreach ($hasil[$kode]['poin'] as $poin)
                            <li>{{ $poin }}</li>
                        @endforeach
                    </ul>
                </section>

                <div class="result-actions">
                    <a class="retry-button" href="/jurumatch/quiz">ULANGI TES</a>
                    <a class="back-button" href="/jurumatch">KEMBALI</a>
                </div>
            </main>
        </div>

    </body>
</html>
