
@extends('layouts.admin')

@section('title', 'Unduh Informasi')
@section('page-title', 'Unduh Informasi')

@section('content')

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <span class="welcome-label">DOKUMEN SEKOLAH</span>
        <h2 class="fw-bold mt-3 mb-1">Unduh Informasi</h2>
        <p class="text-muted mb-0">
            Kelola dokumen, formulir, pengumuman, dan informasi sekolah.
        </p>
    </div>

    <button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambahInformasi">
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Dokumen
    </button>
</div>

<!-- ALERT -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <strong>Dokumen belum berhasil diproses.</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- STATISTIK -->
<div class="row g-3 mb-4">

    <div class="col-xl-3 col-md-6">
        <div class="dashboard-stat-card">
            <div class="stat-content">
                <div>
                    <p class="stat-label">Total Dokumen</p>
                    <h2 class="stat-number">{{ $informasi->count() }}</h2>
                    <span class="stat-status info">
                        <i class="bi bi-files"></i> Semua dokumen
                    </span>
                </div>
                <div class="stat-icon primary">
                    <i class="bi bi-folder2-open"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="dashboard-stat-card">
            <div class="stat-content">
                <div>
                    <p class="stat-label">Dokumen Terbit</p>
                    <h2 class="stat-number">
                        {{ $informasi->where('status', 'Terbit')->count() }}
                    </h2>
                    <span class="stat-status success">
                        <i class="bi bi-check-circle"></i> Tersedia
                    </span>
                </div>
                <div class="stat-icon success">
                    <i class="bi bi-file-earmark-check"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="dashboard-stat-card">
            <div class="stat-content">
                <div>
                    <p class="stat-label">Draft</p>
                    <h2 class="stat-number">
                        {{ $informasi->where('status', 'Draft')->count() }}
                    </h2>
                    <span class="stat-status warning">
                        <i class="bi bi-pencil-square"></i> Belum diterbitkan
                    </span>
                </div>
                <div class="stat-icon warning">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="dashboard-stat-card">
            <div class="stat-content">
                <div>
                    <p class="stat-label">Kategori</p>
                    <h2 class="stat-number">
                        {{ $informasi->whereNotNull('kategori')->where('kategori', '!=', '')->unique('kategori')->count() }}
                    </h2>
                    <span class="stat-status info">
                        <i class="bi bi-tags"></i> Jenis dokumen
                    </span>
                </div>
                <div class="stat-icon info">
                    <i class="bi bi-tags-fill"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- TABEL DOKUMEN -->
<div class="dashboard-card">

    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Data Dokumen</h5>
            <p class="dashboard-card-subtitle">
                Daftar dokumen yang dikelola oleh administrator.
            </p>
        </div>

        <div class="d-flex gap-2">
            <div class="input-group input-group-sm" style="max-width:260px">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text"
                    id="searchInformasi"
                    class="form-control"
                    placeholder="Cari dokumen...">
            </div>

            <select id="filterStatusInformasi"
                class="form-select form-select-sm"
                style="width:145px">
                <option value="">Semua Status</option>
                <option value="terbit">Terbit</option>
                <option value="draft">Draft</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table dashboard-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Dokumen</th>
                    <th>Kategori</th>
                    <th>Format</th>
                    <th>Ukuran</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>

            <tbody id="informasiTableBody">
                @forelse($informasi as $item)
                    <tr class="informasi-row"
                        data-search="{{ strtolower(($item->judul ?? '') . ' ' . ($item->kategori ?? '') . ' ' . ($item->nama_file ?? '') . ' ' . ($item->deskripsi ?? '')) }}"
                        data-status="{{ strtolower($item->status ?? '') }}">

                        <!-- NAMA DOKUMEN -->
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon primary flex-shrink-0"
                                    style="width:48px;height:48px">
                                    <i class="bi bi-file-earmark-{{ strtolower($item->format_file ?? '') === 'pdf' ? 'pdf' : 'text' }} fs-5"></i>
                                </div>

                                <div>
                                    <strong>{{ $item->judul }}</strong>
                                    <small class="d-block text-muted">
                                        {{ \Illuminate\Support\Str::limit($item->nama_file, 38) }}
                                    </small>
                                </div>
                            </div>
                        </td>

                        <!-- KATEGORI -->
                        <td>
                            @if($item->kategori)
                                <span class="major-badge">{{ $item->kategori }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <!-- FORMAT -->
                        <td>
                            <span class="badge bg-light text-primary border">
                                {{ strtoupper($item->format_file ?? '-') }}
                            </span>
                        </td>

                        <!-- UKURAN -->
                        <td>
                            @if($item->ukuran_file)
                                {{ number_format($item->ukuran_file / 1048576, 2) }} MB
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <!-- STATUS -->
                        <td>
                            @if($item->status === 'Terbit')
                                <span class="status-badge success">Terbit</span>
                            @else
                                <span class="status-badge warning">Draft</span>
                            @endif
                        </td>

                        <!-- TANGGAL -->
                        <td>
                            @if($item->tanggal_publish)
                                {{ $item->tanggal_publish->format('d M Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">

                                <button type="button"
                                    class="btn btn-sm btn-light"
                                    title="Detail"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDetailInformasi{{ $item->id_informasi }}">
                                    <i class="bi bi-eye"></i>
                                </button>

                                <a href="{{ route('unduh-informasi.download', $item->id_informasi) }}"
                                    class="btn btn-sm btn-light text-primary"
                                    title="Download">
                                    <i class="bi bi-download"></i>
                                </a>

                                <button type="button"
                                    class="btn btn-sm btn-light"
                                    title="Edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditInformasi{{ $item->id_informasi }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button type="button"
                                    class="btn btn-sm btn-light text-danger"
                                    title="Hapus"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapusInformasi{{ $item->id_informasi }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyInformasiRow">
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-folder2-open fs-1 d-block text-muted mb-2"></i>
                            <strong>Belum ada dokumen</strong>
                            <p class="text-muted mb-0">
                                Klik Tambah Dokumen untuk mulai menambahkan informasi.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3 border-top">
        <small class="text-muted">
            Menampilkan <span id="jumlahInformasi">{{ $informasi->count() }}</span> dokumen
        </small>
    </div>
</div>


<!-- ==================================================
     MODAL TAMBAH
================================================== -->

<div class="modal fade" id="modalTambahInformasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <form action="{{ route('unduh-informasi.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold">Tambah Dokumen</h5>
                        <small class="text-muted">Masukkan informasi dan file dokumen.</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-12">
                            <label class="form-label fw-semibold">Judul Dokumen</label>
                            <input type="text" name="judul" class="form-control"
                                placeholder="Contoh: Formulir Pendaftaran Siswa Baru"
                                value="{{ old('judul') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="">Pilih Kategori</option>
                                <option value="Pendaftaran">Pendaftaran</option>
                                <option value="Formulir">Formulir</option>
                                <option value="Pengumuman">Pengumuman</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Panduan">Panduan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Draft">Draft</option>
                                <option value="Terbit">Terbit</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Publikasi</label>
                            <input type="date" name="tanggal_publish" class="form-control"
                                value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">File Dokumen</label>
                            <input type="file" name="file" class="form-control"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                            <small class="text-muted">
                                Format PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 10 MB.
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"
                                placeholder="Keterangan mengenai dokumen...">{{ old('deskripsi') }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cloud-arrow-up me-1"></i>
                        Simpan Dokumen
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- ==================================================
     MODAL DETAIL, EDIT, HAPUS
================================================== -->

@foreach($informasi as $item)

    <!-- DETAIL -->
    <div class="modal fade"
        id="modalDetailInformasi{{ $item->id_informasi }}"
        tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold">Detail Dokumen</h5>
                        <small class="text-muted">Informasi lengkap dokumen.</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="text-center py-3">
                        <div class="stat-icon primary mx-auto mb-3"
                            style="width:75px;height:75px">
                            <i class="bi bi-file-earmark-text fs-2"></i>
                        </div>

                        <h4 class="fw-bold">{{ $item->judul }}</h4>
                        <p class="text-muted">{{ $item->nama_file }}</p>

                        @if($item->status === 'Terbit')
                            <span class="status-badge success">Terbit</span>
                        @else
                            <span class="status-badge warning">Draft</span>
                        @endif
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block">Kategori</small>
                                <strong>{{ $item->kategori ?? '-' }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block">Format File</small>
                                <strong>{{ strtoupper($item->format_file ?? '-') }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block">Ukuran File</small>
                                <strong>
                                    {{ $item->ukuran_file ? number_format($item->ukuran_file / 1048576, 2) . ' MB' : '-' }}
                                </strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="bg-light rounded-3 p-3 h-100">
                                <small class="text-muted d-block">Tanggal Publikasi</small>
                                <strong>
                                    {{ $item->tanggal_publish ? $item->tanggal_publish->format('d M Y') : '-' }}
                                </strong>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted d-block mb-1">Deskripsi</small>
                                <p class="mb-0" style="white-space:pre-line">{{ $item->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('unduh-informasi.download', $item->id_informasi) }}"
                        class="btn btn-primary">
                        <i class="bi bi-download me-1"></i> Download File
                    </a>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>


    <!-- EDIT -->
    <div class="modal fade"
        id="modalEditInformasi{{ $item->id_informasi }}"
        tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <form action="{{ route('unduh-informasi.update', $item->id_informasi) }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title fw-bold">Edit Dokumen</h5>
                            <small class="text-muted">Perbarui informasi dokumen.</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label fw-semibold">Judul Dokumen</label>
                                <input type="text" name="judul" class="form-control"
                                    value="{{ $item->judul }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Pendaftaran" {{ $item->kategori === 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                                    <option value="Formulir" {{ $item->kategori === 'Formulir' ? 'selected' : '' }}>Formulir</option>
                                    <option value="Pengumuman" {{ $item->kategori === 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                    <option value="Akademik" {{ $item->kategori === 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                    <option value="Panduan" {{ $item->kategori === 'Panduan' ? 'selected' : '' }}>Panduan</option>
                                    <option value="Lainnya" {{ $item->kategori === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Draft" {{ $item->status === 'Draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="Terbit" {{ $item->status === 'Terbit' ? 'selected' : '' }}>Terbit</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Publikasi</label>
                                <input type="date" name="tanggal_publish" class="form-control"
                                    value="{{ $item->tanggal_publish?->format('Y-m-d') }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Ganti File Dokumen</label>
                                <input type="file" name="file" class="form-control"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">

                                <small class="text-muted d-block mt-2">
                                    File saat ini: {{ $item->nama_file }}.
                                    Kosongkan jika tidak ingin mengganti file.
                                </small>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4">{{ $item->deskripsi }}</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- HAPUS -->
    <div class="modal fade"
        id="modalHapusInformasi{{ $item->id_informasi }}"
        tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Hapus Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center py-4">
                    <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:70px;height:70px">
                        <i class="bi bi-trash text-danger fs-3"></i>
                    </div>

                    <h5 class="fw-bold">Yakin ingin menghapus dokumen?</h5>
                    <p class="text-muted mb-0">
                        Dokumen <strong>{{ $item->judul }}</strong>
                        beserta file yang tersimpan akan dihapus permanen.
                    </p>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('unduh-informasi.destroy', $item->id_informasi) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Ya, Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endforeach


<!-- SEARCH DAN FILTER -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInformasi');
    const filterStatus = document.getElementById('filterStatusInformasi');
    const rows = document.querySelectorAll('.informasi-row');
    const jumlah = document.getElementById('jumlahInformasi');

    function filterInformasi() {
        const keyword = searchInput.value.toLowerCase().trim();
        const status = filterStatus.value.toLowerCase().trim();
        let visibleCount = 0;

        rows.forEach(function (row) {
            const searchData = row.dataset.search.toLowerCase();
            const rowStatus = row.dataset.status.toLowerCase();

            const cocokSearch = searchData.includes(keyword);
            const cocokStatus = !status || rowStatus === status;

            if (cocokSearch && cocokStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        jumlah.textContent = visibleCount;
    }

    searchInput.addEventListener('input', filterInformasi);
    filterStatus.addEventListener('change', filterInformasi);
});
</script>

@endsection