<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pendaftaran SPMB</title>

    <link rel="stylesheet" href="/css/spmb.css">
</head>

<body>

<main class="spmb-enroll-page">

        <a href="{{ route('spmb') }}" class="spmb-enroll-back">← Kembali ke SPMB</a>

        <nav class="spmb-progress" aria-label="Tahap pendaftaran">
            <span class="spmb-progress__step spmb-progress__step--active">
                <span>1</span> Data Pribadi
            </span>
            <span class="spmb-progress__line" aria-hidden="true"></span>
            <span class="spmb-progress__step">
                <span>2</span> Konfirmasi
            </span>
        </nav>

        <section class="spmb-enroll-card">
            <header class="spmb-enroll-card__header">
                <h1>Data Pribadi</h1>
                <p>Lengkapi data calon siswa dengan benar.</p>
            </header>

            @if ($errors->any())
                <div class="spmb-alert spmb-alert--error" role="alert">
                    <p>Periksa kembali data yang Anda masukkan:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('spmb.confirm') }}" method="POST" class="spmb-enroll-form">
                @csrf
                <div class="spmb-step-fields">
                    <div class="spmb-field">
                        <label for="nama_lengkap">Nama Lengkap <span>*</span></label>
                        <input id="nama_lengkap" name="nama_lengkap" type="text" maxlength="150" value="{{ old('nama_lengkap', $registration['nama_lengkap'] ?? '') }}" required>
                        @error('nama_lengkap') <small>{{ $message }}</small> @enderror
                    </div>
                    <div class="spmb-field">
                        <label for="email">Email Siswa <span>*</span></label>
                        <input id="email" name="email" type="email" maxlength="150" value="{{ old('email', $registration['email'] ?? '') }}" required>
                        @error('email') <small>{{ $message }}</small> @enderror
                    </div>
                    <div class="spmb-field">
                        <label for="whatsapp_siswa">No WhatsApp Siswa <span>*</span></label>
                        <div class="spmb-phone-input"><span>+62</span><input id="whatsapp_siswa" name="whatsapp_siswa" type="tel" maxlength="30" value="{{ old('whatsapp_siswa', $registration['whatsapp_siswa'] ?? '') }}" required></div>
                        @error('whatsapp_siswa') <small>{{ $message }}</small> @enderror
                    </div>
                    <div class="spmb-field">
                        <label for="whatsapp_orang_tua">No WhatsApp Orang Tua <span>*</span></label>
                        <div class="spmb-phone-input"><span>+62</span><input id="whatsapp_orang_tua" name="whatsapp_orang_tua" type="tel" maxlength="30" value="{{ old('whatsapp_orang_tua', $registration['whatsapp_orang_tua'] ?? '') }}" required></div>
                        @error('whatsapp_orang_tua') <small>{{ $message }}</small> @enderror
                    </div>
                    <div class="spmb-field spmb-field--full">
                        <label for="alamat">Alamat Lengkap <span>*</span></label>
                        <textarea id="alamat" name="alamat" rows="3" required>{{ old('alamat', $registration['alamat'] ?? '') }}</textarea>
                        @error('alamat') <small>{{ $message }}</small> @enderror
                    </div>
                    <div class="spmb-field">
                        <label for="asal_sekolah">Asal Sekolah <span>*</span></label>
                        <input id="asal_sekolah" name="asal_sekolah" type="text" maxlength="150" value="{{ old('asal_sekolah', $registration['asal_sekolah'] ?? '') }}" required>
                        @error('asal_sekolah') <small>{{ $message }}</small> @enderror
                    </div>
                    <div class="spmb-field">
                        <label for="agama">Agama <span>*</span></label>
                        <select id="agama" name="agama" required>
                            <option value="">Pilih agama</option>
                            @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Kepercayaan Lainnya'] as $agama)
                                <option value="{{ $agama }}" @selected(old('agama', $registration['agama'] ?? '') === $agama)>{{ $agama }}</option>
                            @endforeach
                        </select>
                        @error('agama') <small>{{ $message }}</small> @enderror
                    </div>

                    <fieldset class="spmb-field spmb-field--full spmb-major-field">
                        <legend>Pilihan Jurusan <span>*</span></legend>
                        <div class="spmb-major-options">
                            @foreach ($jurusan as $namaJurusan)
                                <label class="spmb-major-option">
                                    <input type="radio" name="jurusan" value="{{ $namaJurusan }}" @checked(old('jurusan', $registration['jurusan'] ?? '') === $namaJurusan) required>
                                    <span class="spmb-major-option__mark" aria-hidden="true"></span>
                                    <span class="spmb-major-option__text">
                                        <strong>{{ collect(config('tefa.jurusan'))->firstWhere('nama', $namaJurusan)['label'] }}</strong>
                                        <small>{{ $namaJurusan }}</small>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('jurusan') <small>{{ $message }}</small> @enderror
                    </fieldset>

                    <div class="spmb-field spmb-field--full">
                        <label for="sumber_informasi">Mendapatkan Informasi SPMB Dari <span>*</span></label>
                        <select id="sumber_informasi" name="sumber_informasi" required>
                            <option value="">Pilih sumber informasi</option>
                            @foreach ($sumberInformasi as $sumber)
                                <option value="{{ $sumber }}" @selected(old('sumber_informasi', $registration['sumber_informasi'] ?? '') === $sumber)>{{ $sumber }}</option>
                            @endforeach
                        </select>
                        @error('sumber_informasi') <small>{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="spmb-step-actions spmb-step-actions--right">
                    <button class="spmb-step-button spmb-step-button--primary" type="submit">Selanjutnya <span aria-hidden="true">→</span></button>
                </div>
            </form>
        </section>
    </main>
<<<<<<< HEAD

</body>
</html>
=======
</main>

</body>
</html>
>>>>>>> 1846e14a0ff63e8b5f99665fd4dd8859ab34fb57
