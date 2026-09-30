@extends('layouts.admin')

@section('title', 'Mentoring')

@section('page-title', 'Mentoring')

@section('content')
<div class="mb-4">
    <span class="welcome-label">KARIR</span>
    <h2 class="fw-bold mt-3 mb-1">Mentoring</h2>
    <p class="text-muted mb-0">Kelola pengajuan mentoring yang dikirim dari halaman Jurusan &amp; Karir.</p>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-3 mb-4">
    @foreach ([
        ['Total Pengajuan', $jumlahTotal, 'primary', 'bi-briefcase-fill'],
        ['Selesai', $jumlahSelesai, 'success', 'bi-check-circle-fill'],
        ['Ditolak', $jumlahDitolak, 'danger', 'bi-x-circle-fill'],
    ] as [$label, $jumlah, $warna, $ikon])
        <div class="col">
            <div class="dashboard-stat-card">
                <div class="stat-content">
                    <div>
                        <p class="stat-label">{{ $label }}</p>
                        <h2 class="stat-number">{{ $jumlah }}</h2>
                    </div>
                    <div class="stat-icon {{ $warna }}"><i class="bi {{ $ikon }}"></i></div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="dashboard-card">
    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Data Pengajuan Mentoring</h5>
            <p class="dashboard-card-subtitle">Data dari halaman karir. Geser tabel ke kanan untuk melihat semua kolom.</p>
        </div>
        <div class="d-flex gap-2">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input
                    type="search"
                    id="searchMentoring"
                    class="form-control"
                    placeholder="Cari pengajuan..."
                    aria-label="Cari pengajuan mentoring"
                >
            </div>
            <select
                id="filterStatusMentoring"
                class="form-select form-select-sm"
                style="width: 160px;"
                aria-label="Filter status pengajuan mentoring"
            >
                <option value="">Semua Status</option>
                <option value="menunggu">Menunggu</option>
                <option value="diproses">Dalam Proses</option>
                <option value="ditolak">Ditolak</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
    </div>
    <div class="table-responsive mentoring-table-scroll" tabindex="0" role="region" aria-label="Tabel pengajuan mentoring, geser horizontal untuk melihat kolom lainnya">
        <table class="table dashboard-table align-middle mb-0" style="min-width: 1500px;">
            <thead>
                <tr>
                    <th>Pemohon</th>
                    <th>Nomor Telepon</th>
                    <th>Status Pemohon</th>
                    <th>Jurusan Mentor</th>
                    <th>Mentor</th>
                    <th>Topik</th>
                    <th>Tanggal</th>
                    <th style="width: 300px;">Status Pengajuan</th>
                    <th style="width: 190px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permintaan as $item)
                    <tr class="mentoring-row" data-status="{{ $item->status_pengajuan }}">
                        <td>{{ $item->nama_pemohon }}</td>
                        <td>
                            @php
                                $applicantPhone = preg_replace('/\D+/', '', (string) $item->no_telp);
                                if (str_starts_with($applicantPhone, '0')) {
                                    $applicantPhone = '62' . substr($applicantPhone, 1);
                                } elseif (str_starts_with($applicantPhone, '8')) {
                                    $applicantPhone = '62' . $applicantPhone;
                                }
                            @endphp
                            @if ($applicantPhone !== '')
                                <div>{{ $item->no_telp }}</div>
                                <a
                                    href="https://wa.me/{{ $applicantPhone }}?text={{ rawurlencode('Halo ' . $item->nama_pemohon . ', saya admin sekolah menghubungi Anda terkait pengajuan mentoring. Topik: ' . $item->topik . '.') }}"
                                    class="btn btn-sm btn-success mt-2 text-nowrap"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Kirim WhatsApp ke pemohon untuk pengajuan {{ $item->id_mentoring }}"
                                >
                                    <i class="bi bi-whatsapp me-1"></i>
                                    WhatsApp Pemohon
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->status_pemohon }}</td>
                        <td>{{ $item->mentor?->jurusan?->nama_jurusan ?? 'Jurusan tidak tersedia' }}</td>
                        <td>
                            <div class="fw-semibold">{{ $item->mentor?->siswa?->nama_siswa ?? $item->mentor_nama }}</div>
                            @php
                                $mentorPhone = preg_replace('/\D+/', '', (string) ($item->mentor?->no_telp ?? ''));
                                if (str_starts_with($mentorPhone, '0')) {
                                    $mentorPhone = '62' . substr($mentorPhone, 1);
                                } elseif (str_starts_with($mentorPhone, '8')) {
                                    $mentorPhone = '62' . $mentorPhone;
                                }
                            @endphp
                            @if ($mentorPhone !== '')
                                <small class="d-block text-muted mt-1">+{{ $mentorPhone }}</small>
                                <a
                                    href="https://wa.me/{{ $mentorPhone }}?text={{ rawurlencode('Halo ' . ($item->mentor?->siswa?->nama_siswa ?? $item->mentor_nama) . ', saya menghubungi Anda mengenai pengajuan mentoring dari ' . $item->nama_pemohon . '.') }}"
                                    class="btn btn-sm btn-success mt-2 text-nowrap"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Kirim WhatsApp ke mentor untuk pengajuan {{ $item->id_mentoring }}"
                                >
                                    <i class="bi bi-whatsapp me-1"></i>
                                    WhatsApp Mentor
                                </a>
                            @else
                                <small class="d-block text-muted mt-1">Nomor mentor belum tersedia</small>
                            @endif
                        </td>
                        <td>{{ $item->topik }}</td>
                        <td>{{ $item->created_at?->format('d M Y') }}</td>
                        <td style="min-width: 300px;">
                            <form action="{{ route('mentoring.update-status', $item->id_mentoring) }}" method="POST" class="d-flex gap-2 mentoring-status-form">
                                @csrf
                                @method('PUT')
                                <select name="status_pengajuan" class="form-select form-select-sm" style="width: 180px; min-width: 180px;" aria-label="Ubah status pengajuan" required>
                                    <option value="" disabled @selected(! in_array($item->status_pengajuan, ['ditolak', 'selesai'], true))>Pilih status</option>
                                    <option value="ditolak" @selected($item->status_pengajuan === 'ditolak')>Ditolak</option>
                                    <option value="selesai" @selected($item->status_pengajuan === 'selesai')>Selesai</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('mentoring.show', $item->id_mentoring) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                <form action="{{ route('mentoring.destroy', $item->id_mentoring) }}" method="POST" onsubmit="return confirm('Hapus pengajuan mentoring ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Belum ada pengajuan mentoring. Data mentor dan pengajuan akan muncul setelah alumni bersedia menjadi mentor dan siswa mengirim formulir.
                        </td>
                    </tr>
                @endforelse
                @if ($permintaan->isNotEmpty())
                    <tr id="noMentoringResult" class="d-none">
                        <td colspan="9" class="text-center text-muted py-4">
                            Tidak ada pengajuan yang sesuai dengan pencarian atau status.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="dashboard-card-footer">
        <span>
            Menampilkan
            <strong id="mentoringVisibleCount">{{ $permintaan->count() }}</strong>
            dari
            <strong>{{ $permintaan->count() }}</strong>
            pengajuan
        </span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchMentoring');
    const statusFilter = document.getElementById('filterStatusMentoring');
    const rows = document.querySelectorAll('.mentoring-row');
    const visibleCount = document.getElementById('mentoringVisibleCount');
    const noResults = document.getElementById('noMentoringResult');

    function filterMentoring() {
        const keyword = searchInput.value.toLowerCase().trim();
        const status = statusFilter.value;
        let count = 0;

        rows.forEach(function (row) {
            const matchesText = row.innerText.toLowerCase().includes(keyword);
            const matchesStatus = status === '' || row.dataset.status === status;
            const isVisible = matchesText && matchesStatus;

            row.style.display = isVisible ? '' : 'none';
            count += isVisible ? 1 : 0;
        });

        visibleCount.textContent = count;
        if (noResults) {
            noResults.classList.toggle('d-none', count !== 0);
        }
    }

    searchInput.addEventListener('input', filterMentoring);
    statusFilter.addEventListener('change', filterMentoring);
});
</script>
@endsection
