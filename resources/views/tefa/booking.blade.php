@extends('layouts.app')

@section('title', 'TEFA Online - Booking Layanan')

@section('styles')
<link rel="stylesheet" href="/css/tefa.css">
@endsection

@section('content')

@php
    $layanan = config('tefa.layanan');

    $dipilih = request()->query('layanan');
    $terpilih = collect($layanan)->firstWhere('slug', $dipilih);

    if (! $terpilih) {
        $terpilih = $layanan[0];
    }

    $namaJurusan = config("tefa.jurusan.{$terpilih['kategori']}.label", strtoupper($terpilih['kategori']));

    $jamBuka = config('tefa.jam.buka', '07:00');
    $jamTutup = config('tefa.jam.tutup', '13:15');
@endphp

<section class="booking-section">

    <div class="booking-inner">

        {{-- =========================================================
             JUDUL
        ========================================================= --}}
        <header class="booking-header">
            <div class="booking-header-line">
                <span class="booking-line"></span>
                <span class="booking-dot"></span>
                <h1 class="booking-title">Buat Booking</h1>
                <span class="booking-dot"></span>
                <span class="booking-line"></span>
            </div>

            <p class="booking-subtitle">Lengkapi Data Berikut Untuk Booking Jasa</p>
        </header>

        @php $booking = session('booking'); @endphp

        <div class="booking-modal" id="bookingModal" role="dialog" aria-modal="true"
            aria-labelledby="bookingModalTitle" aria-hidden="true"
            data-auto-open="{{ $booking ? '1' : '0' }}">
            <div class="booking-modal-backdrop"></div>

            <div class="booking-modal-dialog">
                <button type="button" class="booking-modal-close" data-close-modal aria-label="Tutup">
                    &times;
                </button>

                <div class="booking-modal-scroll">
                    <div class="booking-modal-grid">

                        <div class="booking-modal-card booking-modal-card--info">
                            <h2 class="booking-modal-title" id="bookingModalTitle">BOOKING DITERIMA</h2>

                            <dl class="booking-modal-detail">
                                <div class="booking-modal-detail-row">
                                    <dt>Order ID</dt>
                                    <dd class="booking-modal-code" data-field="kode">{{ $booking ? strtoupper($booking['kode']) : '' }}</dd>
                                </div>

                                <div class="booking-modal-detail-row">
                                    <dt>Layanan</dt>
                                    <dd data-field="kategori">{{ $booking['kategori'] ?? '' }}</dd>
                                </div>

                                <div class="booking-modal-detail-row">
                                    <dt>Jurusan</dt>
                                    <dd data-field="jurusan">{{ $booking['jurusan'] ?? '' }}</dd>
                                </div>

                                <div class="booking-modal-detail-row">
                                    <dt>Tujuan</dt>
                                    <dd data-field="tugas">{{ $booking['tugas'] ?? '' }}</dd>
                                </div>

                                <div class="booking-modal-detail-row">
                                    <dt>Status</dt>
                                    <dd>
                                        <span class="booking-modal-badge" data-field="status">{{ $booking['status'] ?? '' }}</span>
                                    </dd>
                                </div>

                                <div class="booking-modal-detail-row">
                                    <dt>Jadwal</dt>
                                    <dd data-field="jadwal">{{ $booking['jadwal'] ?? '' }}</dd>
                                </div>

                                <div class="booking-modal-detail-row">
                                    <dt>Biaya</dt>
                                    <dd data-field="harga">{{ $booking['harga'] ?? '' }}</dd>
                                </div>
                            </dl>

                            <p class="booking-modal-note">Simpan kode ini untuk administrasi.</p>

                            <div class="booking-modal-actions">
                                <button type="button" class="booking-download" id="bookingDownload">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12 3a1 1 0 0 1 1 1v8.59l2.29-2.3a1 1 0 1 1 1.42 1.42l-4 4a1 1 0 0 1-1.42 0l-4-4a1 1 0 1 1 1.42-1.42L11 12.59V4a1 1 0 0 1 1-1Z"/>
                                        <path d="M5 17a1 1 0 0 1 1 1v1h12v-1a1 1 0 1 1 2 0v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 19.5V18a1 1 0 0 1 1-1Z"/>
                                    </svg>
                                    Download
                                </button>

                                <button type="button" class="booking-modal-action-close" data-close-modal>
                                    Close
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="booking-alert booking-alert--error" id="bookingAlert" role="alert" @unless ($errors->any()) style="display: none;" @endunless>
            <ul id="bookingAlertList">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <div class="booking-layout">

            {{-- =====================================================
                 KIRI : LAYANAN YANG DIPILIH
            ===================================================== --}}
            <div class="booking-side">

                <aside class="booking-aside">

                    <div class="booking-aside-head">
                        <div class="booking-aside-icon">
                            @include('tefa.partials.icon', ['type' => $terpilih['ikon']])
                        </div>

                        <div class="booking-aside-titles">
                            <span class="booking-aside-label">Layanan di pilih :</span>
                            <span class="booking-aside-jurusan">{{ $namaJurusan }}</span>
                        </div>
                    </div>

                    <p class="booking-aside-kategori">
                        Kategori : <span>{{ $terpilih['nama'] }}</span>
                    </p>

                    <p class="booking-aside-desc">{{ $terpilih['deskripsi'] }}</p>

                    <div class="booking-aside-price">{{ $terpilih['harga'] }}</div>

                </aside>

                <a
                    href="{{ route('tefa.katalog', ['jurusan' => $terpilih['kategori']]) }}"
                    class="booking-back"
                >
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Kembali ke TEFA {{ $namaJurusan }}
                </a>

            </div>

            {{-- =====================================================
                 KANAN : FORM BOOKING
            ===================================================== --}}
            <form class="booking-form" method="POST" action="{{ route('tefa.booking.store') }}">

                @csrf

                <input type="hidden" id="layanan" name="layanan" value="{{ old('layanan', $terpilih['slug']) }}">

                <div class="booking-fields">

                    <div class="booking-field">
                        <label for="nama">ATAS NAMA:</label>
                        <input type="text" id="nama" name="nama" autocomplete="name"
                            minlength="3" maxlength="50"
                            pattern="(?=.*[A-Za-z])[A-Za-z ]+"
                            title="Nama hanya boleh berisi huruf dan spasi, minimal 3 karakter"
                            value="{{ old('nama') }}" required>
                        @error('nama')
                            <span class="booking-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="booking-field">
                        <label for="whatsapp">No. Whatsapp :</label>
                        <input type="tel" id="whatsapp" name="whatsapp" placeholder="08xxxxxxxxxx"
                            inputmode="numeric" pattern="[0-9]+" maxlength="20"
                            value="{{ old('whatsapp') }}" required>
                        @error('whatsapp')
                            <span class="booking-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="booking-field">
                        <label for="tanggal">Tanggal :</label>
                        <input type="date" id="tanggal" name="tanggal"
                            min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                            value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <span class="booking-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="booking-field">
                        <label for="jam">Jam ({{ $jamBuka }} - {{ $jamTutup }}) :</label>
                        <input type="text" id="jam" name="jam" placeholder="HH:MM"
                            inputmode="numeric" maxlength="5"
                            data-jam-min="{{ $jamBuka }}" data-jam-max="{{ $jamTutup }}"
                            pattern="([01][0-9]|2[0-3]):[0-5][0-9]"
                            title="Pilih jam antara {{ $jamBuka }} sampai {{ $jamTutup }}, contoh 08:30"
                            value="{{ old('jam') }}" required>
                        
                        @error('jam')
                            <span class="booking-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="booking-field booking-field--full">
                    <label for="catatan">Catatan Keluhan / Kebutuhan :</label>
                    <textarea id="catatan" name="catatan" rows="5" required>{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <span class="booking-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="booking-actions">
                    <button type="submit" class="booking-submit">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M3.4 20.4l17.45-7.48a1 1 0 0 0 0-1.84L3.4 3.6a1 1 0 0 0-1.39 1.1l1.9 6.11a1 1 0 0 0 .78.68L15 12l-10.31.51a1 1 0 0 0-.78.68l-1.9 6.11a1 1 0 0 0 1.39 1.1z"/>
                        </svg>
                        Kirim Booking
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

<script>
(function () {
    var nama = document.getElementById('nama');

    if (nama) {
        nama.addEventListener('input', function () {
            var letters = this.value.replace(/[^A-Za-z ]/g, '');

            if (this.value !== letters) {
                this.value = letters;
            }
        });
    }

    var whatsapp = document.getElementById('whatsapp');

    if (whatsapp) {
        whatsapp.addEventListener('input', function () {
            var digits = this.value.replace(/\D/g, '').slice(0, 20);

            if (this.value !== digits) {
                this.value = digits;
            }
        });
    }

    var tanggal = document.getElementById('tanggal');

    if (tanggal) {
        var cekMinggu = function (report) {
            var value = tanggal.value;

            if (!value) {
                tanggal.setCustomValidity('');

                return;
            }

            var hari = new Date(value + 'T00:00:00').getDay();
            var minggu = hari === 0;

            tanggal.setCustomValidity(minggu ? 'Tanggal tidak boleh hari Minggu.' : '');

            if (minggu && report) {
                tanggal.reportValidity();
            }
        };

        tanggal.addEventListener('input', function () {
            cekMinggu(false);
        });

        tanggal.addEventListener('change', function () {
            cekMinggu(true);
        });
    }

    var jam = document.getElementById('jam');

    if (jam) {
        var batas = function (nama) {
            var bagian = (jam.getAttribute(nama) || '00:00').split(':');

            return parseInt(bagian[0], 10) * 60 + parseInt(bagian[1], 10);
        };

        var menitDari = function (value) {
            var match = /^(\d{1,2}):(\d{2})$/.exec(value.trim());

            if (!match) {
                return null;
            }

            return parseInt(match[1], 10) * 60 + parseInt(match[2], 10);
        };

        var cekJam = function (report) {
            var menit = menitDari(jam.value);

            if (menit === null) {
                jam.setCustomValidity('');

                return true;
            }

            var valid = menit >= batas('data-jam-min') && menit <= batas('data-jam-max');

            jam.setCustomValidity(valid
                ? ''
                : 'Jam harus di antara ' + jam.getAttribute('data-jam-min') + ' - ' + jam.getAttribute('data-jam-max') + '.');

            if (!valid && report) {
                jam.reportValidity();
            }

            return valid;
        };

        jam.addEventListener('input', function () {
            var digits = this.value.replace(/\D/g, '').slice(0, 4);

            this.value = digits.length > 2
                ? digits.slice(0, 2) + ':' + digits.slice(2)
                : digits;

            cekJam(false);
        });

        jam.addEventListener('blur', function () {
            var match = /^(\d{1,2}):?(\d{2})$/.exec(this.value.trim());

            if (!match) {
                return;
            }

            var hours = parseInt(match[1], 10);
            var minutes = parseInt(match[2], 10);

            this.value = String(hours).padStart(2, '0') + ':' + String(minutes).padStart(2, '0');

            cekJam(true);
        });

        jam.addEventListener('change', function () {
            cekJam(true);
        });
    }
})();

(function () {
    var modal = document.getElementById('bookingModal');

    if (!modal) {
        return;
    }

    var dialog = modal.querySelector('.booking-modal-dialog');
    var form = document.querySelector('.booking-form');
    var alertBox = document.getElementById('bookingAlert');
    var alertList = document.getElementById('bookingAlertList');

    function setField(name, value) {
        modal.querySelectorAll('[data-field="' + name + '"]').forEach(function (el) {
            el.textContent = value === null || value === undefined ? '' : value;
        });
    }

    function openModal() {
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('booking-modal-open');

        if (dialog) {
            dialog.style.animation = 'none';
            void dialog.offsetWidth;
            dialog.style.animation = '';
        }
    }

    function closeModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('booking-modal-open');
    }

    function showErrors(errors) {
        if (!alertList) {
            return;
        }

        var keys = errors ? Object.keys(errors) : [];

        alertList.innerHTML = '';

        keys.forEach(function (key) {
            var message = errors[key];
            var li = document.createElement('li');
            li.textContent = Array.isArray(message) ? message.join(' ') : message;
            alertList.appendChild(li);
        });

        if (alertBox) {
            alertBox.style.display = keys.length ? 'block' : 'none';
        }
    }

    modal.querySelectorAll('[data-close-modal]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            closeModal();
        });
    });

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var submitBtn = form.querySelector('.booking-submit');

            if (submitBtn) {
                submitBtn.disabled = true;
            }

            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: new FormData(form),
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(function (res) {
                    return res.json().then(function (body) {
                        return { ok: res.ok, body: body };
                    });
                })
                .then(function (result) {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                    }

                    if (!result.ok) {
                        showErrors(result.body && result.body.errors);
                        return;
                    }

                    showErrors({});

                    var data = result.body && result.body.booking ? result.body.booking : {};

                    setField('jurusan', data.jurusan);
                    setField('kategori', data.kategori);
                    setField('harga', data.harga);
                    setField('kode', data.kode ? String(data.kode).toUpperCase() : '');
                    setField('tugas', data.tugas);
                    setField('status', data.status);
                    setField('jadwal', data.jadwal);

                    form.reset();
                    openModal();
                })
                .catch(function () {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                    }

                    showErrors({ form: 'Terjadi kesalahan. Silakan coba lagi.' });
                });
        });
    }

    /* =====================================================
       DOWNLOAD BUKTI BOOKING
       Data yang sedang tampil pada popup digambar ulang ke
       <canvas> lalu diunduh sebagai berkas gambar.
    ===================================================== */
    var downloadBtn = document.getElementById('bookingDownload');
    var receiptLogo = new Image();
    receiptLogo.src = '/images/tefalogo.png';

    var RECEIPT_FONT = '"Plus Jakarta Sans", "Segoe UI", Arial, sans-serif';

    function fieldText(name) {
        var el = modal.querySelector('[data-field="' + name + '"]');

        return el ? el.textContent.trim() : '';
    }

    function receiptRows() {
        return [
            ['Order ID', fieldText('kode')],
            ['Layanan', fieldText('kategori')],
            ['Jurusan', fieldText('jurusan')],
            ['Tujuan', fieldText('tugas')],
            ['Status', fieldText('status')],
            ['Jadwal', fieldText('jadwal')],
            ['Biaya', fieldText('harga')]
        ].filter(function (row) {
            return row[1] !== '';
        });
    }

    function wrapText(ctx, text, maxWidth) {
        var words = String(text).split(/\s+/).filter(Boolean);
        var lines = [];
        var current = '';

        words.forEach(function (word) {
            while (ctx.measureText(word).width > maxWidth && word.length > 1) {
                if (current) {
                    lines.push(current);
                    current = '';
                }

                var cut = word.length;

                while (cut > 1 && ctx.measureText(word.slice(0, cut)).width > maxWidth) {
                    cut--;
                }

                lines.push(word.slice(0, cut));
                word = word.slice(cut);
            }

            var candidate = current ? current + ' ' + word : word;

            if (current && ctx.measureText(candidate).width > maxWidth) {
                lines.push(current);
                current = word;
            } else {
                current = candidate;
            }
        });

        if (current) {
            lines.push(current);
        }

        return lines.length ? lines : [''];
    }

    function buildReceiptCanvas() {
        var rows = receiptRows();
        var width = 720;
        var pad = 44;
        var headerHeight = 116;
        var labelWidth = 148;
        var valueWidth = width - pad * 2 - labelWidth;
        var valueLineHeight = 29;
        var dpr = window.devicePixelRatio || 1;

        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');

        var titleFont = '800 26px ' + RECEIPT_FONT;
        var subtitleFont = '600 15px ' + RECEIPT_FONT;
        var labelFont = '700 17px ' + RECEIPT_FONT;
        var valueFont = '600 19px ' + RECEIPT_FONT;
        var smallFont = '500 15px ' + RECEIPT_FONT;

        // Ukur tinggi tiap baris setelah nilainya dibungkus.
        var prepared = rows.map(function (row) {
            ctx.font = valueFont;

            var lines = wrapText(ctx, row[1], valueWidth);

            return { label: row[0], lines: lines, height: lines.length * valueLineHeight };
        });

        var bodyHeight = prepared.reduce(function (total, row) {
            return total + row.height + 16;
        }, 0);

        var footerHeight = 96;
        var height = headerHeight + pad + bodyHeight + footerHeight;

        canvas.width = width * dpr;
        canvas.height = height * dpr;
        ctx.scale(dpr, dpr);

        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, width, height);

        // Header bergaya sama dengan warna situs.
        var headerGradient = ctx.createLinearGradient(0, 0, width, headerHeight);
        headerGradient.addColorStop(0, '#1b3a5b');
        headerGradient.addColorStop(1, '#2f6ba3');
        ctx.fillStyle = headerGradient;
        ctx.fillRect(0, 0, width, headerHeight);

        var textX = pad;

        if (receiptLogo.complete && receiptLogo.naturalWidth) {
            ctx.drawImage(receiptLogo, pad, (headerHeight - 56) / 2, 56, 56);
            textX = pad + 72;
        }

        ctx.textBaseline = 'alphabetic';
        ctx.fillStyle = '#ffffff';
        ctx.font = titleFont;
        ctx.fillText('TEFA ORDER', textX, 58);

        ctx.font = subtitleFont;
        ctx.fillStyle = 'rgba(255, 255, 255, 0.85)';
        ctx.fillText('SMK Darma Siswa Sidoarjo', textX, 84);

        var y = headerHeight + pad;

        prepared.forEach(function (row) {
            ctx.font = labelFont;
            ctx.fillStyle = '#6b7280';
            ctx.fillText(row.label, pad, y + 19);

            ctx.font = valueFont;
            ctx.fillStyle = '#111827';

            row.lines.forEach(function (line, index) {
                ctx.fillText(line, pad + labelWidth, y + 19 + index * valueLineHeight);
            });

            y += row.height + 16;
        });

        y += 6;

        ctx.strokeStyle = 'rgba(15, 23, 42, 0.18)';
        ctx.lineWidth = 1;
        ctx.setLineDash([6, 6]);
        ctx.beginPath();
        ctx.moveTo(pad, y);
        ctx.lineTo(width - pad, y);
        ctx.stroke();
        ctx.setLineDash([]);

        ctx.font = smallFont;
        ctx.fillStyle = '#6b7280';
        ctx.fillText('Simpan dokumen ini sebagai bukti booking TEFA.', pad, y + 32);
        ctx.fillText('Diunduh ' + new Date().toLocaleString('id-ID'), pad, y + 56);

        return canvas;
    }

    function receiptFilename() {
        var kode = fieldText('kode') || 'TEFA';

        return 'TEFA-Order-' + kode.replace(/[^A-Za-z0-9-]+/g, '-') + '.png';
    }

    function saveCanvas(canvas, filename) {
        var anchor = document.createElement('a');

        // Peramban tanpa atribut download (mis. iOS lama): buka gambar di tab
        // baru supaya pengguna masih bisa menyimpannya secara manual.
        if (typeof anchor.download === 'undefined') {
            window.open(canvas.toDataURL('image/png'), '_blank');

            return;
        }

        function trigger(url, revoke) {
            anchor.href = url;
            anchor.download = filename;
            anchor.rel = 'noopener';
            document.body.appendChild(anchor);
            anchor.click();
            anchor.remove();

            if (revoke) {
                window.setTimeout(function () {
                    URL.revokeObjectURL(url);
                }, 4000);
            }
        }

        if (canvas.toBlob && window.URL && URL.createObjectURL) {
            canvas.toBlob(function (blob) {
                if (blob) {
                    trigger(URL.createObjectURL(blob), true);
                } else {
                    trigger(canvas.toDataURL('image/png'), false);
                }
            }, 'image/png');

            return;
        }

        trigger(canvas.toDataURL('image/png'), false);
    }

    if (downloadBtn) {
        downloadBtn.addEventListener('click', function () {
            saveCanvas(buildReceiptCanvas(), receiptFilename());
        });
    }

    if (modal.getAttribute('data-auto-open') === '1') {
        openModal();
    }
})();
</script>

@endsection

