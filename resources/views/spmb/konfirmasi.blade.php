<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Konfirmasi Pendaftaran SPMB</title>

    <link rel="stylesheet" href="/css/spmb.css">
</head>

<body>
    @php
        $ringkasan = [
            'Nama' => $registration['nama_lengkap'],
            'Email' => $registration['email'],
            'WhatsApp Siswa' => $registration['whatsapp_siswa'],
            'WhatsApp Orang Tua' => $registration['whatsapp_orang_tua'],
            'Alamat' => $registration['alamat'],
            'Asal Sekolah' => $registration['asal_sekolah'],
            'Agama' => $registration['agama'],
            'Jurusan' => $registration['jurusan'],
            'Sumber Informasi' => $registration['sumber_informasi'],
        ];
    @endphp

    <main class="spmb-enroll-page">
        <a href="{{ route('spmb') }}" class="spmb-enroll-back">← Kembali ke SPMB</a>

        <nav class="spmb-progress" aria-label="Tahap pendaftaran">
            <span class="spmb-progress__step spmb-progress__step--complete">
                <span>1</span> Data Pribadi
            </span>
            <span class="spmb-progress__line spmb-progress__line--complete" aria-hidden="true"></span>
            <span class="spmb-progress__step spmb-progress__step--active">
                <span>2</span> Konfirmasi
            </span>
        </nav>

        <section class="spmb-enroll-card">
            <header class="spmb-enroll-card__header">
                <h1>Konfirmasi Data</h1>
                <p>Periksa kembali data pendaftaran Anda sebelum dikirim.</p>
            </header>

            @if ($errors->any())
                <div class="spmb-alert spmb-alert--error" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <section class="spmb-summary">
                <h2>Ringkasan Pendaftaran</h2>
                <dl>
                    @foreach ($ringkasan as $label => $value)
                        <div class="spmb-summary__row">
                            <dt>{{ $label }}</dt>
                            <dd>{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </section>

            <form action="{{ route('spmb.store') }}" method="POST" class="spmb-confirm-form">
                @csrf
                <label class="spmb-confirm-check">
                    <input type="checkbox" name="pernyataan" value="1" required>
                    <span>Saya menyatakan bahwa data yang saya berikan adalah benar dan dapat dipertanggungjawabkan.</span>
                </label>
                @error('pernyataan') <small class="spmb-confirm-error">{{ $message }}</small> @enderror

                <div class="spmb-step-actions spmb-step-actions--between">
                    <a class="spmb-step-button spmb-step-button--secondary" href="{{ route('spmb.form') }}">← Kembali</a>
                    <button class="spmb-step-button spmb-step-button--primary" type="submit">Kirim Pendaftaran <span aria-hidden="true">✓</span></button>
                </div>
            </form>
        </section>
    </main>

</body>
</html>
