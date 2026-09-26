@extends('layouts.app')

@section('title', 'Alumni Track - Pendataan Alumni')

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/alumnitrack.css">
@endsection

@section('content')

    <!-- ============ HERO SECTION ============ -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <p class="hero-subtitle">Karir Masa Depan</p>
                <h1 class="hero-title">
                    Telusuri Data Alumni <span class="highlight">Secara Mudah Dan Terstruktur</span>
                </h1>
                <p class="hero-description">
                    Lengkapi data diri anda dengan benar untuk mendapatkan ode verifikasi. Kode tersebut wajib ditunjukkan saat pengambilan ijazah di sekolah.
                </p>
            </div>

            <!-- Illustration SVG -->
            <div class="hero-illustration">
                <svg width="300" height="200" xmlns="http://www.w3.org/2000/svg">
  <image href="images/bursakerja.png" width="300" height="200" />
                </svg>
            </div>
        </div>
    </section>

    <!-- ============ MAIN CONTENT ============ -->
    <div class="main-content">
        <!-- Title -->
        <h2 class="section-title">Pendataan Alumni – Syarat Ambil Ijazah</h2>
        <p class="section-description">
            Lengkapi data berikut untuk mendapatkan kode verifikasi yang wajib ditunjukkan ke petugas TU saat pengambilan ijazah.
        </p>

        <!-- Stepper -->
        <div class="stepper">
            <div class="step-circle active" id="step-1">1</div>
            <div class="step-line" id="line-1"></div>
            <div class="step-circle inactive" id="step-2">2</div>
            <div class="step-line" id="line-2"></div>
            <div class="step-circle inactive" id="step-3">3</div>
            <div class="step-line" id="line-3"></div>
            <div class="step-circle inactive" id="step-4">4</div>
        </div>

        <!-- ============ STEP 1: DATA DIRI ============ -->
        <div class="form-card step-panel" id="panel-1">
            <!-- Card Header -->
            <div class="form-card-header">
                <div class="form-card-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <div class="form-card-header-text">
                    <h3>Data Diri</h3>
                    <p>Pastikan data sesuai dengan data kelulusan di sekolah.</p>
                </div>
            </div>

            <!-- Card Body / Form -->
            <div class="form-card-body">
                <form id="alumniForm" action="#" method="POST" novalidate>
                    @csrf

                    <!-- Row 1: Nama Lengkap & NISN -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Contoh : Dion maulidin pratama" required>
                            <span id="nama_lengkap-error" class="field-error booking-error" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" id="nisn" name="nisn" placeholder="98765421652376" required>
                            <span id="nisn-status" class="nisn-status" role="status" aria-live="polite"></span>
                        </div>
                    </div>

                    <!-- Row 2: Jurusan & Tahun Lulus -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="id_jurusan">Jurusan</label>
                            <select id="id_jurusan" name="id_jurusan" required>
                                <option value="" selected disabled>Pilih jurusan</option>
                                @foreach ($jurusan as $item)
                                    <option value="{{ $item->id_jurusan }}">{{ $item->nama_jurusan }}</option>
                                @endforeach
                            </select>
                            <span id="id_jurusan-error" class="field-error booking-error" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <input type="text" id="tahun_lulus" name="tahun_lulus" placeholder="2020" inputmode="numeric" maxlength="4" required>
                            <span id="tahun_lulus-error" class="field-error booking-error" role="alert"></span>
                        </div>
                    </div>

                    <!-- Row 3: No. WhatsApp & Email -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="no_whatsapp">No. WhatsApp</label>
                            <input type="tel" id="no_whatsapp" name="no_whatsapp" placeholder="08*******" inputmode="numeric" maxlength="15" required>
                            <span id="no_whatsapp-error" class="field-error booking-error" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="dyygantenksekali@gmail.com" required>
                            <span id="email-error" class="field-error booking-error" role="alert"></span>
                        </div>
                    </div>

                    <!-- Warning Box -->
                    <div class="warning-box">
                        <div class="warning-icon">
                            <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="22" fill="#F44336"/>
                                <path d="M24 9 L36 33 L12 33 Z" fill="#FFEB3B" stroke="#F9A825" stroke-width="1"/>
                                <text x="24" y="28" text-anchor="middle" font-size="16" font-weight="bold" fill="#E65100">!</text>
                            </svg>
                        </div>
                        <div class="warning-text">
                            <h4>Perhatian</h4>
                            <p>Pastikan data yang anda masukkan sudah benar dan simpan kode pengambilan di akhir sesi.</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="btn-container">
                        <button type="submit" class="btn-next">LANJUT</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ============ STEP 2: STATUS SAAT INI ============ -->
        <div class="form-card step-panel" id="panel-2" style="display:none;">
            <div class="form-card-body">
                <h3 class="step-title-italic">STATUS SAAT INI</h3>
                <p class="step-subtitle">Pilih status yang paling sesuai dengan kondisimu sekarang.</p>

                <!-- Options View -->
                <div id="status-options-view">
                    <div class="status-grid">
                        <div class="status-card" onclick="selectStatus('Bekerja', this)">
                            <span class="blue-dot"></span>
                            <span class="status-text">BEKERJA</span>
                        </div>
                        <div class="status-card" onclick="selectStatus('Wirausaha', this)">
                            <span class="blue-dot"></span>
                            <span class="status-text">WIRAUSAHA</span>
                        </div>
                        <div class="status-card" onclick="selectStatus('Melanjutkan Kuliah', this)">
                            <span class="blue-dot"></span>
                            <span class="status-text">MELANJUTKAN KULIAH</span>
                        </div>
                        <div class="status-card" onclick="selectStatus('Masih Mencari Kerja', this)">
                            <span class="blue-dot"></span>
                            <span class="status-text">MASIH MENCARI KERJA</span>
                        </div>
                    </div>
                    <span id="status-error" class="field-error booking-error" role="alert"></span>
                    <div class="btn-container-left">
                        <button type="button" class="btn-orange" onclick="goToStep(1)">KEMBALI</button>
                    </div>
                </div>

                <!-- Detail View (after selecting) -->
                <div id="status-detail-view" style="display:none;">
                    <div class="selected-status-card" onclick="backToStatusOptions()">
                        <span class="blue-dot-gradient"></span>
                        <span class="status-text" id="selected-status-text">BEKERJA</span>
                    </div>

                    <div id="detail-fields" style="display:none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_perusahaan">NAMA PERUSAHAAN</label>
                                <input type="text" id="nama_perusahaan" name="nama_perusahaan" placeholder="Contoh : PT Bambang Jaya"><span id="nama_perusahaan-error" class="field-error booking-error" role="alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">JABATAN</label>
                                <input type="text" id="jabatan" name="jabatan" placeholder="Contoh : IT SUPPORT"><span id="jabatan-error" class="field-error booking-error" role="alert"></span>
                            </div>
                        </div>
                    </div>

                    <div id="kuliah-fields" class="form-row" style="display:none;">

                        <div class="form-group"><label for="nama_kampus">NAMA KAMPUS</label><input type="text" id="nama_kampus" name="nama_kampus" placeholder="Contoh : Universitas Indonesia"><span id="nama_kampus-error" class="field-error booking-error" role="alert"></span></div>

                        <div class="form-group"><label for="jurusan_kuliah">JURUSAN KULIAH</label><input type="text" id="jurusan_kuliah" name="jurusan_kuliah" placeholder="Contoh : Teknik Informatika"><span id="jurusan_kuliah-error" class="field-error booking-error" role="alert"></span></div>

                    </div>



                    <div class="btn-container-dual">
                        <button type="button" class="btn-orange" onclick="goToStep(1)">KEMBALI</button>
                        <button type="button" class="btn-orange" onclick="goToStep(3)">LANJUT</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============ STEP 3: KETERSEDIAAN PESAN DAN KESAN ============ -->
        <div class="form-card step-panel" id="panel-3" style="display:none;">
            <div class="form-card-body">
                <h3 class="step-title-bold">KETERSEDIAAN MEMBERIKAN PESAN DAN KESAN</h3>
                <p class="step-subtitle">Ceritakan pengalamanmu untuk membantu adik-adik kelas.</p>

                <div class="mentor-box">
                    <label class="mentor-label">
                        <input type="checkbox" id="bersedia_mentor" name="bersedia_mentor" checked>
                        <span class="custom-check">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </span>
                        <span class="mentor-text">Saya bersedia menjadi mentor bagi siswa/alumni lain yang ingin bertanya seputar dunia kerja sesuai bidang saya.</span>
                    </label>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label for="cerita_pengalaman" style="text-transform:none; font-size:13px; font-weight:500; color:#1a1a1a; font-style:italic;">Cerita singkat tentang pengalamanmu</label>
                    <input type="text" id="cerita_pengalaman" name="cerita_pengalaman" placeholder="Contoh : mulai dari magang, sekarang jadi teknisi senior"><span id="cerita_pengalaman-error" class="field-error booking-error" role="alert"></span>
                </div>

                <div class="btn-container-dual">
                    <button type="button" class="btn-orange" onclick="goToStep(2)">KEMBALI</button>
                    <button type="button" class="btn-orange" onclick="goToStep(4)">LANJUT</button>
                </div>
            </div>
        </div>

        <!-- ============ STEP 4: RINGKASAN & KIRIM ============ -->
        <div class="form-card step-panel" id="panel-4" style="display:none;">
            <div class="form-card-body">
                <h3 class="step-title-bold">RINGKASAN & KIRIM</h3>
                <p class="step-subtitle">Periksa kembali data sebelum di kirimkan.</p>

                <div class="summary-table-box">
                    <table class="summary-table">
                        <tbody>
                            <tr><td class="td-label">Nama</td><td class="td-value" id="sum-nama"></td></tr>
                            <tr><td class="td-label">NISN</td><td class="td-value" id="sum-nisn"></td></tr>
                            <tr><td class="td-label">Jurusan</td><td class="td-value" id="sum-jurusan"></td></tr>
                            <tr><td class="td-label">Tahun lulus</td><td class="td-value" id="sum-tahun"></td></tr>
                            <tr><td class="td-label">Status</td><td class="td-value" id="sum-status"></td></tr>
                            <tr id="sum-kuliah-row" style="display:none;"><td class="td-label">Kampus</td><td class="td-value" id="sum-kampus"></td></tr>
                            <tr id="sum-jurusan-kuliah-row" style="display:none;"><td class="td-label">Jurusan Kuliah</td><td class="td-value" id="sum-jurusan-kuliah"></td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="btn-container-dual">
                    <button type="button" class="btn-orange" onclick="goToStep(selectedStatus === 'Masih Mencari Kerja' ? 2 : 3)">KEMBALI</button>
                    <button type="button" class="btn-orange btn-wide" onclick="submitForm()">KIRIM & TERBITKAN KODE VERIFIKASI</button>
                </div>
            </div>
        </div>

        <!-- ============ RESULT: KODE VERIFIKASI ============ -->
        <div class="form-card step-panel" id="panel-result" style="display:none;">
            <div class="form-card-body">
                <div class="result-card">
                    <!-- Header: success icon + text -->
                    <div class="result-header">
                        <span class="result-check-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </span>
                        <span class="result-header-text">Data berhasil di simpan</span>
                    </div>

                    <!-- Code -->
                    <h2 class="result-code" id="result-code"></h2>
                    <p class="result-code-subtitle">Kartu bukti pengisian data alumni</p>

                    <!-- Summary Table -->
                    <table class="result-table">
                        <tbody>
                            <tr><td class="rt-label">Nama</td><td class="rt-value" id="res-nama"></td></tr>
                            <tr><td class="rt-label">Jurusan</td><td class="rt-value" id="res-jurusan"></td></tr>
                            <tr><td class="rt-label">Status</td><td class="rt-value" id="res-status"></td></tr>
                            <tr><td class="rt-label">Tahun lulus</td><td class="rt-value" id="res-tahun"></td></tr>
                        </tbody>
                    </table>

                    <!-- Code repeated -->
                    <p class="result-code-bottom" id="result-code-bottom"></p>

                    <!-- Yellow info box -->
                    <div class="result-info-box">
                        <p>Tunjukkan kode ini ke petugas tata usaha saat pengambilan ijazah untuk verifikasi di panek TU</p>
                    </div>
                </div>

                <div class="result-actions">
                    <button type="button" class="btn-download" onclick="downloadVerificationCard()">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 3a1 1 0 0 1 1 1v8.59l2.29-2.3a1 1 0 1 1 1.42 1.42l-4 4a1 1 0 0 1-1.42 0l-4-4a1 1 0 1 1 1.42-1.42L11 12.59V4a1 1 0 0 1 1-1Z"/>
                            <path d="M5 17a1 1 0 0 1 1 1v1h12v-1a1 1 0 1 1 2 0v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 19.5V18a1 1 0 0 1 1-1Z"/>
                        </svg>
                        UNDUH GAMBAR
                    </button>
                    <button type="button" class="btn-result-close" onclick="resetForm()">SELESAI</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        let currentStep = 1;
        let selectedStatus = '';
        const nisnInput = document.getElementById('nisn');
        const nisnStatus = document.getElementById('nisn-status');
        const stepOneSubmit = document.querySelector('#alumniForm button[type="submit"]');
        let nisnCheckPending = false;

        function setNisnStatus(state, message) {
            nisnStatus.className = 'nisn-status ' + state;
            nisnStatus.textContent = message;
        }

        function setFieldError(field, message) {
            const input = document.getElementById(field);
            const error = document.getElementById(field + '-error');
            if (!input || !error) return;
            input.classList.toggle('input-error', Boolean(message));
            error.textContent = message || '';
        }

        const fieldRules = {
            nama_lengkap: (value) => value === ''
                ? 'Nama lengkap wajib diisi.'
                : (/^[\p{L} ]+$/u.test(value) ? '' : 'Nama lengkap hanya boleh berisi huruf dan spasi.'),
            id_jurusan: (value) => value === '' ? 'Jurusan wajib dipilih.' : '',
            tahun_lulus: (value) => {
                if (!/^[0-9]{4}$/.test(value)) return 'Tahun lulus harus terdiri dari tepat 4 digit angka.';
                const year = Number(value);
                return year >= 1900 && year <= new Date().getFullYear() + 1
                    ? '' : 'Tahun lulus harus berada pada rentang tahun yang valid.';
            },
            no_whatsapp: (value) => /^[0-9]{8,15}$/.test(value)
                ? '' : 'Nomor WhatsApp harus berupa 8 sampai 15 digit angka.',
            email: (value) => /^[^\s@]+@gmail\.com$/i.test(value)
                ? '' : 'Email harus menggunakan alamat Gmail yang berakhiran @gmail.com.',
        };
        const touchedFields = new Set();

        function validateField(field, showEmpty = false) {
            const input = document.getElementById(field);
            if (!input || !fieldRules[field]) return true;
            const value = input.value.trim();
            const message = value === '' && !showEmpty ? '' : fieldRules[field](value);
            setFieldError(field, message);
            return !message;
        }

        function validateStepOneFields() {
            const fields = Object.keys(fieldRules);
            let firstInvalid = null;
            fields.forEach((field) => {
                touchedFields.add(field);
                if (!validateField(field, true) && !firstInvalid) {
                    firstInvalid = document.getElementById(field);
                }
            });
            if (firstInvalid) {
                firstInvalid.focus();
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return !firstInvalid;
        }

        Object.keys(fieldRules).forEach((field) => {
            const input = document.getElementById(field);
            if (!input) return;
            input.addEventListener('input', function () {
                validateField(field);
            });
            input.addEventListener('change', function () {
                touchedFields.add(field);
                validateField(field);
            });
            input.addEventListener('blur', function () {
                touchedFields.add(field);
                validateField(field);
            });
        });
        nisnInput.addEventListener('input', function() {
            setNisnStatus('', '');
        });

        async function checkNisn() {
            const value = nisnInput.value.trim();
            if (!value) {
                setNisnStatus('error', 'NISN wajib diisi.');
                return false;
            }
            if (value.length < 10) {
                setNisnStatus('error', 'NISN minimal 10 digit.');
                return false;
            }
            setNisnStatus('checking', 'Memeriksa NISN...');
            try {
                const response = await fetch('{{ route('alumni.check-nisn') }}?nisn=' + encodeURIComponent(value), { headers: { 'Accept': 'application/json' } });
                const result = await response.json();
                setNisnStatus(result.valid ? 'success' : 'error', result.message || 'NISN tidak dapat digunakan.');
                return result.valid === true;
            } catch (error) {
                setNisnStatus('error', 'NISN belum dapat diperiksa. Coba lagi.');
                return false;
            }
        }

        // ====== STEP 1 FORM SUBMIT ======
        document.getElementById('alumniForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            if (nisnCheckPending) return;

            const fields = ['nama_lengkap', 'nisn', 'id_jurusan', 'tahun_lulus', 'no_whatsapp', 'email'];
            for (const f of fields) {
                if (!document.getElementById(f).value.trim()) {
                    if (f === 'nisn') {
                        setNisnStatus('error', 'NISN wajib diisi.');
                    } else {
                        touchedFields.add(f);
                        validateField(f, true);
                    }
                    document.getElementById(f).focus();
                    return;
                }
            }

            if (!validateStepOneFields()) return;

            nisnCheckPending = true;
            stepOneSubmit.disabled = true;
            try {
                if (await checkNisn()) goToStep(2);
                else nisnInput.focus();
            } finally {
                nisnCheckPending = false;
                stepOneSubmit.disabled = false;
            }
        });
        // ====== NAVIGATE STEPS ======
        function goToStep(step) {
            // Validate before forward
            if (step > currentStep) {
                if (currentStep === 2 && !selectedStatus) {
                    document.getElementById('status-error').textContent = 'Status saat ini wajib dipilih.';
                    return;
                }
                if (currentStep === 2 && !validateStatusDetails()) return;
                if (currentStep === 3 && !validateExperience()) return;
            }

            // Hide all panels
            for (let i = 1; i <= 4; i++) {
                document.getElementById('panel-' + i).style.display = 'none';
            }
            // Show target
            document.getElementById('panel-' + step).style.display = 'block';

            // Update stepper
            updateStepper(step);

            // Populate summary on step 4
            if (step === 4) populateSummary();

            // When going back to step 2 and status already selected, show detail view
            if (step === 2 && selectedStatus) {
                document.getElementById('status-options-view').style.display = 'none';
                document.getElementById('status-detail-view').style.display = 'block';
            }

            currentStep = step;
            document.querySelector('.main-content').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function updateStepper(activeStep) {
            for (let i = 1; i <= 4; i++) {
                const c = document.getElementById('step-' + i);
                c.classList.remove('active', 'inactive', 'completed');
                if (i < activeStep) {
                    c.classList.add('completed');
                    c.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
                } else if (i === activeStep) {
                    c.classList.add('active');
                    c.textContent = i;
                } else {
                    c.classList.add('inactive');
                    c.textContent = i;
                }
                if (i < 4) {
                    const line = document.getElementById('line-' + i);
                    line.classList.toggle('active', i < activeStep);
                }
            }
        }

        // ====== STEP 2: STATUS SELECTION ======
        function selectStatus(status, el) {
            selectedStatus = status;
            document.getElementById('selected-status-text').textContent = status.toUpperCase();

            const mentorCheckbox = document.getElementById('bersedia_mentor');
            if (status === 'Masih Mencari Kerja') {
                mentorCheckbox.checked = false;
                goToStep(4);
                return;
            }

            // Show/hide extra fields
            const fields = document.getElementById('detail-fields');
            const kuliahFields = document.getElementById('kuliah-fields');
            if (status === 'Bekerja' || status === 'Wirausaha') {
                fields.style.display = 'block';
                kuliahFields.style.display = 'none';
                clearKuliahFields();
                setStatusFieldState(true);
            } else if (status === 'Melanjutkan Kuliah') {
                fields.style.display = 'none';
                kuliahFields.style.display = 'grid';
                clearCompanyFields();
                setStatusFieldState(false);
            } else {
                fields.style.display = 'none';
                kuliahFields.style.display = 'none';
                clearStatusFields();
            }

            // Switch to detail view
            document.getElementById('status-options-view').style.display = 'none';
            document.getElementById('status-detail-view').style.display = 'block';
        }

        function backToStatusOptions() {
            selectedStatus = '';
            document.getElementById('status-options-view').style.display = 'block';
            document.getElementById('status-detail-view').style.display = 'none';
        }

        function clearKuliahFields() {
            document.getElementById('nama_kampus').value = ''; document.getElementById('jurusan_kuliah').value = '';
            setFieldError('nama_kampus', ''); setFieldError('jurusan_kuliah', '');
        }

        function clearCompanyFields() {
            document.getElementById('nama_perusahaan').value = '';
            document.getElementById('jabatan').value = '';
        }

        function clearStatusFields() {
            clearCompanyFields();
            clearKuliahFields();
            setStatusFieldState(false);
        }

        function setStatusFieldState(companyFieldsEnabled) {
            document.getElementById('nama_perusahaan').disabled = !companyFieldsEnabled;
            document.getElementById('jabatan').disabled = !companyFieldsEnabled;
            document.getElementById('nama_kampus').disabled = companyFieldsEnabled;
            document.getElementById('jurusan_kuliah').disabled = companyFieldsEnabled;
        }

        function validateStatusDetails() {
            if (!['Bekerja', 'Wirausaha', 'Melanjutkan Kuliah'].includes(selectedStatus)) return true;
            let firstInvalid = null;
            const fields = selectedStatus === 'Melanjutkan Kuliah'
                ? ['nama_kampus', 'jurusan_kuliah']
                : ['nama_perusahaan', 'jabatan'];
            fields.forEach((field) => {
                const input = document.getElementById(field); const message = input.value.trim() === '' ? 'Field ini wajib diisi.' : '';
                setFieldError(field, message); if (message && !firstInvalid) firstInvalid = input;
            });
            if (firstInvalid) { firstInvalid.focus(); return false; }
            return true;
        }

        function validateExperience() {
            if (selectedStatus === 'Masih Mencari Kerja') return true;
            const input = document.getElementById('cerita_pengalaman');
            const message = input.value.trim() === '' ? 'Field ini wajib diisi.' : '';
            setFieldError('cerita_pengalaman', message);
            if (message) { input.focus(); return false; }
            return true;
        }

        // ====== STEP 4: POPULATE SUMMARY ======
        function populateSummary() {
            document.getElementById('sum-nama').textContent = document.getElementById('nama_lengkap').value;
            document.getElementById('sum-nisn').textContent = document.getElementById('nisn').value;
            const jurusan = document.getElementById('id_jurusan');
            document.getElementById('sum-jurusan').textContent = jurusan.options[jurusan.selectedIndex].text;
            document.getElementById('sum-tahun').textContent = document.getElementById('tahun_lulus').value;
            document.getElementById('sum-status').textContent = selectedStatus;
            const isKuliah = selectedStatus === 'Melanjutkan Kuliah';
            document.getElementById('sum-kuliah-row').style.display = isKuliah ? '' : 'none'; document.getElementById('sum-jurusan-kuliah-row').style.display = isKuliah ? '' : 'none';
            document.getElementById('sum-kampus').textContent = document.getElementById('nama_kampus').value; document.getElementById('sum-jurusan-kuliah').textContent = document.getElementById('jurusan_kuliah').value;
        }

        // ====== SUBMIT ======
        async function submitForm() {
            const button = document.querySelector('#panel-4 .btn-wide');
            const buttonText = button.textContent;
            button.disabled = true;
            button.textContent = 'MENYIMPAN...';

            try {
                const response = await fetch('{{ route('alumni.store') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('#alumniForm input[name="_token"]').value,
                    },
                    body: JSON.stringify({
                        nama_lengkap: document.getElementById('nama_lengkap').value.trim(),
                        nisn: document.getElementById('nisn').value.trim(),
                        id_jurusan: Number(document.getElementById('id_jurusan').value),
                        tahun_lulus: document.getElementById('tahun_lulus').value.trim(),
                        no_whatsapp: document.getElementById('no_whatsapp').value.trim(),
                        email: document.getElementById('email').value.trim(),
                        status: selectedStatus,
                        ...(selectedStatus === 'Bekerja' || selectedStatus === 'Wirausaha' ? {
                            nama_perusahaan: document.getElementById('nama_perusahaan').value.trim(),
                            jabatan: document.getElementById('jabatan').value.trim(),
                        } : {}),
                        ...(selectedStatus === 'Melanjutkan Kuliah' ? {
                            nama_kampus: document.getElementById('nama_kampus').value.trim(),
                            jurusan_kuliah: document.getElementById('jurusan_kuliah').value.trim(),
                        } : {}),
                        cerita_pengalaman: document.getElementById('cerita_pengalaman').value.trim(),
                        bersedia_mentor: document.getElementById('bersedia_mentor').checked,
                    }),
                });
                const result = await response.json();

                if (!response.ok) {
                    if (response.status === 422 && result.errors) {
                        const errors = Object.values(result.errors).flat().join('\n');
                        throw new Error(errors || result.message);
                    }

                    throw new Error(result.message || 'Data alumni belum dapat disimpan.');
                }

                document.getElementById('result-code').textContent = result.verification_code;
                document.getElementById('result-code-bottom').textContent = result.verification_code;
                document.getElementById('res-nama').textContent = result.summary.nama_lengkap;
                document.getElementById('res-jurusan').textContent = result.summary.jurusan;
                document.getElementById('res-status').textContent = result.summary.status;
                document.getElementById('res-tahun').textContent = result.summary.tahun_lulus;
                document.getElementById('panel-4').style.display = 'none';

                document.getElementById('panel-result').style.display = 'block';
                document.querySelector('.main-content').scrollIntoView({ behavior: 'smooth', block: 'start' });
            } catch (error) {
                alert(error.message || 'Data alumni belum dapat disimpan. Silakan coba kembali.');
            } finally {
                button.disabled = false;
                button.textContent = buttonText;
            }
        }

        // Membuat kartu bukti dalam format PNG tanpa bergantung pada library eksternal.
        function downloadVerificationCard() {
            const code = document.getElementById('result-code').textContent.trim();
            const rows = [
                ['Nama', document.getElementById('res-nama').textContent.trim()],
                ['Jurusan', document.getElementById('res-jurusan').textContent.trim()],
                ['Status', document.getElementById('res-status').textContent.trim()],
                ['Tahun lulus', document.getElementById('res-tahun').textContent.trim()],
            ];
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const width = 1400;
            const height = 1050;

            canvas.width = width;
            canvas.height = height;
            context.fillStyle = '#fff8f6';
            context.fillRect(0, 0, width, height);

            context.fillStyle = '#ffffff';
            context.strokeStyle = '#333333';
            context.lineWidth = 2;
            context.beginPath();
            context.roundRect(55, 55, width - 110, height - 110, 12);
            context.fill();
            context.stroke();

            context.fillStyle = '#2196f3';
            context.beginPath();
            context.arc(105, 110, 25, 0, Math.PI * 2);
            context.fill();
            context.strokeStyle = '#ffffff';
            context.lineWidth = 4;
            context.beginPath();
            context.moveTo(92, 110);
            context.lineTo(101, 119);
            context.lineTo(119, 99);
            context.stroke();

            context.fillStyle = '#555555';
            context.font = '28px Arial';
            context.fillText('Data berhasil disimpan', 150, 120);
            context.fillStyle = '#1a1a1a';
            context.font = 'bold 48px Arial';
            context.fillText(code, 100, 200);
            context.fillStyle = '#666666';
            context.font = '24px Arial';
            context.fillText('Kartu bukti pengisian data alumni', 100, 240);

            let y = 330;
            rows.forEach(([label, value]) => {
                context.fillStyle = '#1a1a1a';
                context.font = '26px Arial';
                context.fillText(label, 100, y);
                context.textAlign = 'right';
                context.fillText(value, width - 100, y);
                context.textAlign = 'left';
                context.strokeStyle = '#cccccc';
                context.lineWidth = 1;
                context.beginPath();
                context.moveTo(100, y + 38);
                context.lineTo(width - 100, y + 38);
                context.stroke();
                y += 88;
            });

            context.textAlign = 'center';
            context.fillStyle = '#1a1a1a';
            context.font = 'bold 36px Arial';
            context.fillText(code, width / 2, 720);
            context.textAlign = 'left';
            context.fillStyle = '#fff8e1';
            context.beginPath();
            context.roundRect(100, 775, width - 200, 125, 14);
            context.fill();
            context.fillStyle = '#555555';
            context.font = '23px Arial';
            context.fillText('Tunjukkan kode ini ke petugas tata usaha saat pengambilan ijazah', 130, 830);
            context.fillText('untuk verifikasi di panek TU.', 130, 865);

            const link = document.createElement('a');
            link.download = `kartu-pengambilan-ijazah-${code}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
        }

        // ====== RESET / SELESAI ======
        function resetForm() {
            // Hide result panel
            document.getElementById('panel-result').style.display = 'none';

            // Reset form
            document.getElementById('alumniForm').reset();
            selectedStatus = '';
            document.getElementById('nama_perusahaan').value = '';
            document.getElementById('jabatan').value = '';
            document.getElementById('cerita_pengalaman').value = '';

            // Reset step 2 views
            document.getElementById('status-options-view').style.display = 'block';
            document.getElementById('status-detail-view').style.display = 'none';

            // Go back to step 1
            currentStep = 1;
            goToStep(1);
        }
    </script>
@endsection
