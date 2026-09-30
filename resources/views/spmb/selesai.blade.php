<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pendaftaran Berhasil</title>

    <link rel="stylesheet" href="/css/spmb.css">
</head>

<body>

    <main class="spmb-enroll-page spmb-success-page">
        <section class="spmb-enroll-card spmb-success-card">
            <div class="spmb-success-icon" aria-hidden="true">✓</div>
            <p class="spmb-form-page__eyebrow">PENERIMAAN SISWA BARU</p>
            <h1>Pendaftaran Berhasil</h1>
            <p class="spmb-success-card__lead">Data pendaftaran Anda berhasil dikirim.</p>
            <p class="spmb-success-card__notice">Silahkan datang ke sekolah untuk proses verifikasi pendaftaran.</p>
            <section class="spmb-success-documents" aria-labelledby="spmb-success-documents-title">
                <h2 id="spmb-success-documents-title">Dokumen yang harus dibawa</h2>
                <ul>
                    <li>Fotokopi ijazah atau surat keterangan lulus</li>
                    <li>Fotokopi kartu keluarga (KK)</li>
                    <li>Fotokopi akta kelahiran</li>
                    <li>Pas foto terbaru</li>
                    <li>Dokumen pendukung lainnya sesuai ketentuan sekolah</li>
                </ul>
            </section>
            <a class="spmb-step-button spmb-step-button--primary" href="{{ route('spmb.form') }}">Kembali ke SPMB</a>
        </section>
    </main>
</body>
</html>