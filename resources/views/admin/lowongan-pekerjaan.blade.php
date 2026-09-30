@extends('layouts.admin')

@section('title', 'Lowongan Pekerjaan')

@section('page-title', 'Lowongan Pekerjaan')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <span class="welcome-label">KARIR</span>
        <h2 class="fw-bold mt-3 mb-1">Lowongan Pekerjaan</h2>
        <p class="text-muted mb-0">Kelola lowongan yang ditampilkan pada halaman Jurusan &amp; Karir.</p>
    </div>

    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambahLowongan"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Tambah Lowongan
    </button>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data lowongan belum berhasil disimpan.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

<div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
    <div class="col">
        <div class="dashboard-stat-card">
            <div class="stat-content">
                <div>
                    <p class="stat-label">Total Lowongan</p>
                    <h2 class="stat-number">{{ $lowongan->count() }}</h2>
                    <span class="stat-status info">
                        <i class="bi bi-briefcase"></i>
                        Tersimpan di database
                    </span>
                </div>
                <div class="stat-icon primary">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="dashboard-stat-card">
            <div class="stat-content">
                <div>
                    <p class="stat-label">Lowongan Dibuka</p>
                    <h2 class="stat-number">{{ $lowongan->where('status', 'dibuka')->count() }}</h2>
                    <span class="stat-status success">
                        <i class="bi bi-check-circle"></i>
                        Sedang menerima lamaran
                    </span>
                </div>
                <div class="stat-icon success">
                    <i class="bi bi-unlock-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="dashboard-stat-card">
            <div class="stat-content">
                <div>
                    <p class="stat-label">Lowongan Ditutup</p>
                    <h2 class="stat-number">{{ $lowongan->where('status', 'ditutup')->count() }}</h2>
                    <span class="stat-status danger">
                        <i class="bi bi-lock"></i>
                        Tidak menerima lamaran
                    </span>
                </div>
                <div class="stat-icon danger">
                    <i class="bi bi-lock-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="dashboard-stat-card">
            <div class="stat-content">
                <div>
                    <p class="stat-label">Posisi Tersedia</p>
                    <h2 class="stat-number">{{ $lowongan->where('status', 'dibuka')->sum('jumlah') }}</h2>
                    <span class="stat-status info">
                        <i class="bi bi-people"></i>
                        Dari lowongan dibuka
                    </span>
                </div>
                <div class="stat-icon info">
                    <i class="bi bi-person-workspace"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-card">
    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Daftar Lowongan</h5>
            <p class="dashboard-card-subtitle">Kelola lowongan pekerjaan per jurusan.</p>
        </div>

        <div class="d-flex gap-2">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input
                    type="text"
                    id="searchLowongan"
                    class="form-control"
                    placeholder="Cari lowongan..."
                    aria-label="Cari lowongan"
                >
            </div>

            <select
                id="filterStatusLowongan"
                class="form-select form-select-sm"
                style="width: 150px;"
                aria-label="Filter status lowongan"
            >
                <option value="">Semua Status</option>
                <option value="dibuka">Dibuka</option>
                <option value="ditutup">Ditutup</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table dashboard-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Pekerjaan</th>
                    <th>Jurusan</th>
                    <th>Gaji</th>
                    <th>Posisi</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody id="lowonganTableBody">
                @forelse ($lowongan as $item)
                    <tr class="lowongan-row" data-status="{{ $item->status }}">
                        <td>
                            <div class="student-info">
                                <div class="student-avatar primary">
                                    <i class="bi bi-briefcase-fill"></i>
                                </div>
                                <div>
                                    <strong>{{ $item->nama_lowongan }}</strong>
                                    <small class="d-block text-muted">
                                        {{ \Illuminate\Support\Str::limit($item->deskripsi ?: 'Tidak ada deskripsi.', 90) }}
                                    </small>
                                    @if (count((array) $item->skills))
                                        <small class="d-block text-primary mt-1">
                                            <i class="bi bi-tools me-1"></i>
                                            {{ implode(', ', (array) $item->skills) }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="major-badge">
                                {{ $item->jurusan?->nama_jurusan ?? 'Jurusan tidak tersedia' }}
                            </span>
                        </td>
                        <td>
                            @if ($item->gaji_min !== null || $item->gaji_max !== null)
                                <span class="text-nowrap">
                                    Rp {{ $item->gaji_min !== null ? number_format((int) $item->gaji_min, 0, ',', '.') : '-' }}
                                    –
                                    {{ $item->gaji_max !== null ? number_format((int) $item->gaji_max, 0, ',', '.') : '-' }}
                                </span>
                            @else
                                <span class="text-muted">Tidak dicantumkan</span>
                            @endif
                        </td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            <span class="status-badge {{ $item->status === 'dibuka' ? 'success' : 'secondary' }}">
                                {{ $item->status === 'dibuka' ? 'Dibuka' : 'Ditutup' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-light"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditLowongan{{ $item->id_lowongan }}"
                                    aria-label="Edit {{ $item->nama_lowongan }}"
                                    title="Edit lowongan"
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form
                                    action="{{ route('lowongan.destroy', $item->id_lowongan) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus lowongan ini?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-light"
                                        aria-label="Hapus {{ $item->nama_lowongan }}"
                                        title="Hapus lowongan"
                                    >
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyLowonganRow">
                        <td colspan="6" class="text-center text-muted py-4">Belum ada lowongan pekerjaan.</td>
                    </tr>
                @endforelse
                <tr id="noLowonganResult" class="d-none">
                    <td colspan="6" class="text-center text-muted py-4">Tidak ada lowongan yang sesuai dengan pencarian.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="dashboard-card-footer">
        <span>
            Menampilkan
            <strong id="lowonganVisibleCount">{{ $lowongan->count() }}</strong>
            dari
            <strong>{{ $lowongan->count() }}</strong>
            lowongan
        </span>
    </div>
</div>

<div class="modal fade" id="modalTambahLowongan" tabindex="-1" aria-labelledby="modalTambahLowonganLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('lowongan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold" id="modalTambahLowonganLabel">Tambah Lowongan</h5>
                        <p class="text-muted small mb-0">Isi informasi pekerjaan yang akan ditampilkan.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="create_id_jurusan" class="form-label">Jurusan</label>
                            <select id="create_id_jurusan" name="id_jurusan" class="form-select" required>
                                <option value="">Pilih jurusan</option>
                                @foreach ($jurusan as $major)
                                    <option value="{{ $major->id_jurusan }}" @selected(old('id_jurusan') == $major->id_jurusan)>
                                        {{ $major->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="create_nama_lowongan" class="form-label">Nama pekerjaan</label>
                            <input id="create_nama_lowongan" name="nama_lowongan" class="form-control" maxlength="150" value="{{ old('nama_lowongan') }}" required>
                        </div>
                        <div class="col-12">
                            <label for="create_deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="create_deskripsi" name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="create_gaji_min" class="form-label">Gaji minimum</label>
                            <input id="create_gaji_min" name="gaji_min" type="number" min="0" class="form-control" value="{{ old('gaji_min') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="create_gaji_max" class="form-label">Gaji maksimum</label>
                            <input id="create_gaji_max" name="gaji_max" type="number" min="0" class="form-control" value="{{ old('gaji_max') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="create_jumlah" class="form-label">Jumlah posisi</label>
                            <input id="create_jumlah" name="jumlah" type="number" min="0" class="form-control" value="{{ old('jumlah', 0) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="create_status" class="form-label">Status</label>
                            <select id="create_status" name="status" class="form-select" required>
                                <option value="dibuka" @selected(old('status', 'dibuka') === 'dibuka')>Dibuka</option>
                                <option value="ditutup" @selected(old('status') === 'ditutup')>Ditutup</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="create_skills" class="form-label">Skill yang dibutuhkan</label>
                            <textarea id="create_skills" name="skills" class="form-control" rows="3" placeholder="Satu skill per baris">{{ old('skills') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i>
                        Simpan Lowongan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($lowongan as $item)
    <div class="modal fade" id="modalEditLowongan{{ $item->id_lowongan }}" tabindex="-1" aria-labelledby="modalEditLowonganLabel{{ $item->id_lowongan }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('lowongan.update', $item->id_lowongan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title fw-bold" id="modalEditLowonganLabel{{ $item->id_lowongan }}">Edit Lowongan</h5>
                            <p class="text-muted small mb-0">{{ $item->nama_lowongan }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit_id_jurusan{{ $item->id_lowongan }}" class="form-label">Jurusan</label>
                                <select id="edit_id_jurusan{{ $item->id_lowongan }}" name="id_jurusan" class="form-select" required>
                                    @foreach ($jurusan as $major)
                                        <option value="{{ $major->id_jurusan }}" @selected($item->id_jurusan == $major->id_jurusan)>
                                            {{ $major->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_nama_lowongan{{ $item->id_lowongan }}" class="form-label">Nama pekerjaan</label>
                                <input id="edit_nama_lowongan{{ $item->id_lowongan }}" name="nama_lowongan" class="form-control" maxlength="150" value="{{ $item->nama_lowongan }}" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_deskripsi{{ $item->id_lowongan }}" class="form-label">Deskripsi</label>
                                <textarea id="edit_deskripsi{{ $item->id_lowongan }}" name="deskripsi" class="form-control" rows="3">{{ $item->deskripsi }}</textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="edit_gaji_min{{ $item->id_lowongan }}" class="form-label">Gaji minimum</label>
                                <input id="edit_gaji_min{{ $item->id_lowongan }}" name="gaji_min" type="number" min="0" class="form-control" value="{{ $item->gaji_min }}">
                            </div>
                            <div class="col-md-3">
                                <label for="edit_gaji_max{{ $item->id_lowongan }}" class="form-label">Gaji maksimum</label>
                                <input id="edit_gaji_max{{ $item->id_lowongan }}" name="gaji_max" type="number" min="0" class="form-control" value="{{ $item->gaji_max }}">
                            </div>
                            <div class="col-md-3">
                                <label for="edit_jumlah{{ $item->id_lowongan }}" class="form-label">Jumlah posisi</label>
                                <input id="edit_jumlah{{ $item->id_lowongan }}" name="jumlah" type="number" min="0" class="form-control" value="{{ $item->jumlah }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="edit_status{{ $item->id_lowongan }}" class="form-label">Status</label>
                                <select id="edit_status{{ $item->id_lowongan }}" name="status" class="form-select" required>
                                    <option value="dibuka" @selected($item->status === 'dibuka')>Dibuka</option>
                                    <option value="ditutup" @selected($item->status === 'ditutup')>Ditutup</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="edit_skills{{ $item->id_lowongan }}" class="form-label">Skill yang dibutuhkan</label>
                                <textarea id="edit_skills{{ $item->id_lowongan }}" name="skills" class="form-control" rows="3" placeholder="Satu skill per baris">{{ implode("\n", (array) $item->skills) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchLowongan');
    const statusFilter = document.getElementById('filterStatusLowongan');
    const rows = document.querySelectorAll('.lowongan-row');
    const visibleCount = document.getElementById('lowonganVisibleCount');
    const noResults = document.getElementById('noLowonganResult');

    function filterLowongan() {
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
        noResults.classList.toggle('d-none', count !== 0 || rows.length === 0);
    }

    searchInput.addEventListener('input', filterLowongan);
    statusFilter.addEventListener('change', filterLowongan);
});
</script>

@endsection
