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
                <form id="alumniForm" action="#" method="POST">
                    @csrf

                    <!-- Row 1: Nama Lengkap & NISN -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Contoh : Dion maulidin pratama" required>
                        </div>
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" id="nisn" name="nisn" placeholder="98765421652376" required>
                        </div>
                    </div>

                    <!-- Row 2: Jurusan & Tahun Lulus -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" placeholder="Teknik Jaringan Komputer" required>
                        </div>
                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <input type="text" id="tahun_lulus" name="tahun_lulus" placeholder="2020" required>
                        </div>
                    </div>

                    <!-- Row 3: No. WhatsApp & Email -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="no_whatsapp">No. WhatsApp</label>
                            <input type="text" id="no_whatsapp" name="no_whatsapp" placeholder="092731767" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="dyyasamlambung@gmail.com" required>
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
                            <p>Pastikan data yang anda masukkan benar, kode verifikasi akan di kirim ke nomer WatsApp & email yang anda daftarkan</p>
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

                    <div id="detail-fields">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nama_perusahaan">NAMA PERUSAHAAN</label>
                                <input type="text" id="nama_perusahaan" name="nama_perusahaan" placeholder="Contoh : PT Bambang Jaya">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">JABATAN</label>
                                <input type="text" id="jabatan" name="jabatan" placeholder="Contoh : IT SUPPORT">
                            </div>
                        </div>
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
                <p class="step-subtitle">Opsional - Bantu adik adik kelas degan memberikan pesan pegalamanmu di bawah ini.</p>

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
                    <input type="text" id="cerita_pengalaman" name="cerita_pengalaman" placeholder="Contoh : mulai dari magang, sekarang jadi teknisi senior">
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
                        </tbody>
                    </table>
                </div>

                <div class="btn-container-dual">
                    <button type="button" class="btn-orange" onclick="goToStep(3)">KEMBALI</button>
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
                    <h2 class="result-code" id="result-code">DTA - 76523</h2>
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
                    <p class="result-code-bottom" id="result-code-bottom">DTA - 76523</p>

                    <!-- Yellow info box -->
                    <div class="result-info-box">
                        <p>Tunjukkan kode ini ke petugas tata usaha saat pengambilan ijazah untuk verifikasi di panek TU</p>
                    </div>
                </div>

                <!-- SELESAI button -->
                <div class="btn-container-left" style="margin-top: 24px;">
                    <button type="button" class="btn-orange" onclick="resetForm()">SELESAI</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        let currentStep = 1;
        let selectedStatus = '';

        // ====== STEP 1 FORM SUBMIT ======
        document.getElementById('alumniForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const fields = ['nama_lengkap', 'nisn', 'jurusan', 'tahun_lulus', 'no_whatsapp', 'email'];
            for (const f of fields) {
                if (!document.getElementById(f).value.trim()) {
                    alert('Mohon lengkapi semua data yang diperlukan.');
                    document.getElementById(f).focus();
                    return;
                }
            }
            goToStep(2);
        });

        // ====== NAVIGATE STEPS ======
        function goToStep(step) {
            // Validate before forward
            if (step > currentStep) {
                if (currentStep === 2 && !selectedStatus) {
                    alert('Mohon pilih status saat ini.');
                    return;
                }
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

            // Show/hide extra fields
            const fields = document.getElementById('detail-fields');
            if (status === 'Bekerja' || status === 'Wirausaha') {
                fields.style.display = 'block';
            } else {
                fields.style.display = 'none';
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

        // ====== STEP 4: POPULATE SUMMARY ======
        function populateSummary() {
            document.getElementById('sum-nama').textContent = document.getElementById('nama_lengkap').value;
            document.getElementById('sum-nisn').textContent = document.getElementById('nisn').value;
            document.getElementById('sum-jurusan').textContent = document.getElementById('jurusan').value;
            document.getElementById('sum-tahun').textContent = document.getElementById('tahun_lulus').value;
            document.getElementById('sum-status').textContent = selectedStatus;
        }

        // ====== SUBMIT ======
        function submitForm() {
            // Generate DTA code
            const code = 'DTA - ' + (Math.floor(10000 + Math.random() * 90000));

            // Set code text
            document.getElementById('result-code').textContent = code;
            document.getElementById('result-code-bottom').textContent = code;

            // Populate result summary
            document.getElementById('res-nama').textContent = document.getElementById('nama_lengkap').value;
            document.getElementById('res-jurusan').textContent = document.getElementById('jurusan').value;
            document.getElementById('res-status').textContent = selectedStatus;
            document.getElementById('res-tahun').textContent = document.getElementById('tahun_lulus').value;

            // Hide step 4, show result
            document.getElementById('panel-4').style.display = 'none';
            document.getElementById('panel-result').style.display = 'block';

            // Scroll to top
            document.querySelector('.main-content').scrollIntoView({ behavior: 'smooth', block: 'start' });

            console.log('Data alumni submitted with code:', code);
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
