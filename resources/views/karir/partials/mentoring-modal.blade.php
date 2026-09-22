{{-- MODAL AJUKAN MENTORING --}}
<div
    id="mentoringModal"
    class="modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="mentoringModalTitle"
>
    <div class="modal-content">

        <button
            type="button"
            class="modal-close"
            onclick="closeMentoringModal()"
            aria-label="Tutup"
        >
            &times;
        </button>

        <header class="modal-header">

            <span class="modal-badge" aria-hidden="true">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"/>
                    <path d="M9.2 9.3a2.8 2.8 0 0 1 5.4.9c0 1.9-2.6 2.3-2.6 4"/>
                    <path d="M12 17.3h.01"/>
                </svg>
            </span>

            <h2 id="mentoringModalTitle">Ajukan Mentoring</h2>

            <p>Isi data berikut, datamu akan diteruskan ke alumni terkait.</p>

        </header>

        <form class="mentoring-form" action="{{ route('mentoring.store') }}" method="POST">

            @csrf

            <input type="hidden" name="mentor" id="mentorInput">

            <div class="mentor-target">
                <span class="mentor-target-label">Mentor yang dituju</span>
                <strong class="mentor-target-name" id="mentorName">&ndash;</strong>
            </div>

            <div class="form-grid">

                <div class="form-field">
                    <label for="mentoringNama">Nama kamu</label>
                    <input
                        type="text"
                        id="mentoringNama"
                        name="nama"
                        placeholder="Contoh: Ridwan Ajis"
                        autocomplete="name"
                        required
                    >
                </div>

                <div class="form-field">
                    <label for="mentoringStatus">Status</label>
                    <input
                        type="text"
                        id="mentoringStatus"
                        name="status"
                        placeholder="Contoh: Mahasiswa"
                        required
                    >
                </div>

            </div>

            <div class="form-field">
                <label for="mentoringTopik">Topik yang ingin dibahas</label>
                <textarea
                    id="mentoringTopik"
                    name="topik"
                    placeholder="Contoh: Kak, saya ingin tanya bagaimana cara kakak untuk berani memulai dari umur belasan?"
                    required
                ></textarea>
            </div>

            <div class="modal-buttons">

                <button type="submit" class="btn-kirim">
                    KIRIM PERMINTAAN
                </button>

                <button
                    type="button"
                    class="btn-batal"
                    onclick="closeMentoringModal()"
                >
                    BATAL
                </button>

            </div>

        </form>

    </div>
</div>

{{-- MODAL BERHASIL --}}
@if (session('request_code'))

<div
    id="successModal"
    class="modal success-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="successModalTitle"
>
    <div class="success-content">

        <span class="success-check" aria-hidden="true">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.4"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M20 6 9 17l-5-5"/>
            </svg>
        </span>

        <h2 id="successModalTitle">Permintaan Terkirim</h2>

        <p class="success-sub">
            Simpan kode ini untuk menanyakan status
            permintaanmu ke TU sekolah.
        </p>

        <div class="request-code">{{ session('request_code') }}</div>

        <p class="success-note">Alumni Akan Di Hubungi Melalui TU Sekolah</p>

        <button
            type="button"
            class="btn-tutup"
            onclick="closeSuccessModal()"
        >
            TUTUP
        </button>

    </div>
</div>

@endif

<script>
    function openMentoringModal(mentor) {
        document.getElementById('mentorInput').value = mentor;

        const mentorName = document.getElementById('mentorName');
        if (mentorName) {
            mentorName.textContent = mentor;
        }

        document.getElementById('mentoringModal').classList.add('is-open');

        const firstField = document.getElementById('mentoringNama');
        if (firstField) {
            window.setTimeout(function () {
                firstField.focus();
            }, 90);
        }
    }

    function closeMentoringModal() {
        document.getElementById('mentoringModal').classList.remove('is-open');
    }

    function closeSuccessModal() {
        document.getElementById('successModal').style.display = 'none';
    }

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') {
            return;
        }

        closeMentoringModal();

        const successModal = document.getElementById('successModal');
        if (successModal) {
            successModal.style.display = 'none';
        }
    });

    document.addEventListener('click', function (event) {
        const mentoringModal = document.getElementById('mentoringModal');

        if (event.target === mentoringModal) {
            closeMentoringModal();
        }
    });
</script>
