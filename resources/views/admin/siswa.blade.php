@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('page-title', 'Data Siswa')

@section('content')
<div class="d-flex justify-content-between align-items-start gap-3 mb-4">
    <div>
        <span class="welcome-label">DATA SISWA</span>
        <h2 class="fw-bold mt-3 mb-1">Data Siswa</h2>
        <p class="text-muted mb-0">Kelola data siswa untuk Alumni Track dan layanan mentoring.</p>
    </div>
    <button type="button" class="btn btn-primary flex-shrink-0" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
        <i class="bi bi-plus-lg me-1"></i> Tambah Siswa
    </button>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data belum berhasil disimpan.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

<div class="row g-3 mb-4">
    @foreach ([
        ['Total Siswa', $siswa->count(), 'bi-people-fill', 'primary'],
        ['Siswa Aktif', $siswa->where('status', 'aktif')->count(), 'bi-person-check-fill', 'success'],
        ['Sudah Lulus', $siswa->where('status', 'lulus')->count(), 'bi-mortarboard-fill', 'info'],
    ] as [$label, $count, $icon, $color])
        <div class="col-md-4">
            <div class="dashboard-stat-card h-100">
                <div class="stat-content">
                    <div>
                        <p class="stat-label">{{ $label }}</p>
                        <h2 class="stat-number">{{ $count }}</h2>
                    </div>
                    <div class="stat-icon {{ $color }}"><i class="bi {{ $icon }}"></i></div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="dashboard-card">
    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Daftar Siswa</h5>
            <p class="dashboard-card-subtitle">Data dasar siswa yang digunakan bersama oleh Alumni Track dan mentoring.</p>
        </div>
        <div class="input-group input-group-sm" style="max-width: 280px;">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input id="searchSiswa" type="search" class="form-control" placeholder="Cari NISN atau nama siswa">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table dashboard-table align-middle mb-0">
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody id="siswaTableBody">
                @forelse ($siswa as $item)
                    <tr class="siswa-row">
                        <td>{{ $item->nisn }}</td>
                        <td class="fw-semibold">{{ $item->nama_siswa }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->jurusan?->nama_jurusan ?? '-' }}</td>
                        <td>
                            @php
                                $statusClass = ['aktif' => 'success', 'lulus' => 'primary', 'keluar' => 'secondary'][$item->status] ?? 'secondary';
                            @endphp
                            <span class="badge text-bg-{{ $statusClass }}">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <button type="button" class="btn btn-sm btn-light" title="Edit"
                                    data-bs-toggle="modal" data-bs-target="#modalEditSiswa{{ $item->id_siswa }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @if ($item->alumniTrack->isEmpty())
                                    <form action="{{ route('siswa.destroy', $item->id_siswa) }}" method="POST"
                                        onsubmit="return confirm('Hapus data siswa {{ $item->nama_siswa }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-light text-muted" title="Sudah terhubung dengan Alumni Track" disabled>
                                        <i class="bi bi-lock"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">Belum ada data siswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-top">
        <small class="text-muted">Jumlah siswa: {{ $siswa->count() }}</small>
    </div>
</div>

<div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold">Tambah Siswa</h5>
                        <small class="text-muted">Lengkapi data dasar siswa.</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nisnTambah" class="form-label">NISN</label>
                            <input id="nisnTambah" name="nisn" class="form-control" maxlength="20" value="{{ old('nisn') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="namaTambah" class="form-label">Nama Siswa</label>
                            <input id="namaTambah" name="nama_siswa" class="form-control" maxlength="150" value="{{ old('nama_siswa') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="kelasTambah" class="form-label">Kelas</label>
                            <input id="kelasTambah" name="kelas" class="form-control" maxlength="20" value="{{ old('kelas') }}" placeholder="Contoh: XII TJKT 1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jurusanTambah" class="form-label">Jurusan</label>
                            <select id="jurusanTambah" name="id_jurusan" class="form-select" required>
                                <option value="">Pilih jurusan</option>
                                @foreach ($jurusan as $itemJurusan)
                                    <option value="{{ $itemJurusan->id_jurusan }}" @selected(old('id_jurusan') == $itemJurusan->id_jurusan)>
                                        {{ $itemJurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="statusTambah" class="form-label">Status</label>
                            <select id="statusTambah" name="status" class="form-select" required>
                                @foreach (['aktif' => 'Aktif', 'lulus' => 'Lulus', 'keluar' => 'Keluar'] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status', 'aktif') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($siswa as $item)
    <div class="modal fade" id="modalEditSiswa{{ $item->id_siswa }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('siswa.update', $item->id_siswa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title fw-bold">Edit Data Siswa</h5>
                            <small class="text-muted">{{ $item->nama_siswa }}</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nisn{{ $item->id_siswa }}" class="form-label">NISN</label>
                                <input id="nisn{{ $item->id_siswa }}" name="nisn" class="form-control" maxlength="20" value="{{ $item->nisn }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nama{{ $item->id_siswa }}" class="form-label">Nama Siswa</label>
                                <input id="nama{{ $item->id_siswa }}" name="nama_siswa" class="form-control" maxlength="150" value="{{ $item->nama_siswa }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="kelas{{ $item->id_siswa }}" class="form-label">Kelas</label>
                                <input id="kelas{{ $item->id_siswa }}" name="kelas" class="form-control" maxlength="20" value="{{ $item->kelas }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jurusan{{ $item->id_siswa }}" class="form-label">Jurusan</label>
                                <select id="jurusan{{ $item->id_siswa }}" name="id_jurusan" class="form-select" required>
                                    @foreach ($jurusan as $itemJurusan)
                                        <option value="{{ $itemJurusan->id_jurusan }}" @selected($item->id_jurusan == $itemJurusan->id_jurusan)>
                                            {{ $itemJurusan->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status{{ $item->id_siswa }}" class="form-label">Status</label>
                                <select id="status{{ $item->id_siswa }}" name="status" class="form-select" required>
                                    @foreach (['aktif' => 'Aktif', 'lulus' => 'Lulus', 'keluar' => 'Keluar'] as $value => $label)
                                        <option value="{{ $value }}" @selected($item->status === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
    document.getElementById('searchSiswa')?.addEventListener('input', (event) => {
        const term = event.target.value.trim().toLocaleLowerCase();
        document.querySelectorAll('#siswaTableBody .siswa-row').forEach((row) => {
            row.hidden = !row.textContent.toLocaleLowerCase().includes(term);
        });
    });
</script>
@endsection
