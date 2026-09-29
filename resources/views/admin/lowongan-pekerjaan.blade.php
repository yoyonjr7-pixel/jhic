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
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Data lowongan belum berhasil disimpan.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="dashboard-card mb-4">
    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Tambah Lowongan</h5>
            <p class="dashboard-card-subtitle">Lowongan yang berstatus dibuka akan tampil untuk jurusannya.</p>
        </div>
    </div>
    <form action="{{ route('lowongan.store') }}" method="POST" class="p-3">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="id_jurusan" class="form-label">Jurusan</label>
                <select id="id_jurusan" name="id_jurusan" class="form-select" required>
                    <option value="">Pilih jurusan</option>
                    @foreach ($jurusan as $item)
                        <option value="{{ $item->id_jurusan }}" @selected(old('id_jurusan') == $item->id_jurusan)>
                            {{ $item->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="nama_lowongan" class="form-label">Nama pekerjaan</label>
                <input id="nama_lowongan" name="nama_lowongan" class="form-control" maxlength="150" value="{{ old('nama_lowongan') }}" required>
            </div>
            <div class="col-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="2">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="col-md-3">
                <label for="gaji_min" class="form-label">Gaji minimum</label>
                <input id="gaji_min" name="gaji_min" type="number" min="0" class="form-control" value="{{ old('gaji_min') }}">
            </div>
            <div class="col-md-3">
                <label for="gaji_max" class="form-label">Gaji maksimum</label>
                <input id="gaji_max" name="gaji_max" type="number" min="0" class="form-control" value="{{ old('gaji_max') }}">
            </div>
            <div class="col-md-3">
                <label for="jumlah" class="form-label">Jumlah posisi</label>
                <input id="jumlah" name="jumlah" type="number" min="0" class="form-control" value="{{ old('jumlah', 0) }}" required>
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="dibuka" @selected(old('status', 'dibuka') === 'dibuka')>Dibuka</option>
                    <option value="ditutup" @selected(old('status') === 'ditutup')>Ditutup</option>
                </select>
            </div>
            <div class="col-12">
                <label for="skills" class="form-label">Skill yang dibutuhkan</label>
                <textarea id="skills" name="skills" class="form-control" rows="3" placeholder="Satu skill per baris">{{ old('skills') }}</textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Simpan Lowongan
                </button>
            </div>
        </div>
    </form>
</div>

<div class="dashboard-card">
    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Daftar Lowongan</h5>
            <p class="dashboard-card-subtitle">{{ $lowongan->count() }} lowongan tersimpan di database.</p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table dashboard-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Pekerjaan</th>
                    <th>Jurusan</th>
                    <th>Gaji</th>
                    <th>Status</th>
                    <th>Kelola</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lowongan as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->nama_lowongan }}</strong>
                            <small class="d-block text-muted">{{ $item->deskripsi }}</small>
                        </td>
                        <td>{{ $item->jurusan?->nama_jurusan ?? 'Jurusan tidak tersedia' }}</td>
                        <td>
                            @if ($item->gaji_min !== null || $item->gaji_max !== null)
                                Rp {{ $item->gaji_min !== null ? number_format((int) $item->gaji_min, 0, ',', '.') : '-' }} -
                                {{ $item->gaji_max !== null ? number_format((int) $item->gaji_max, 0, ',', '.') : '-' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <span class="status-badge {{ $item->status === 'dibuka' ? 'success' : 'secondary' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <details>
                                <summary class="btn btn-sm btn-outline-primary">Edit</summary>
                                <form action="{{ route('lowongan.update', $item->id_lowongan) }}" method="POST" class="border rounded p-3 mt-2" style="min-width: 280px;">
                                    @csrf
                                    @method('PUT')
                                    <label class="form-label">Jurusan</label>
                                    <select name="id_jurusan" class="form-select mb-2" required>
                                        @foreach ($jurusan as $major)
                                            <option value="{{ $major->id_jurusan }}" @selected($item->id_jurusan == $major->id_jurusan)>
                                                {{ $major->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="form-label">Nama pekerjaan</label>
                                    <input name="nama_lowongan" class="form-control mb-2" maxlength="150" value="{{ $item->nama_lowongan }}" required>
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control mb-2" rows="2">{{ $item->deskripsi }}</textarea>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">Gaji minimum</label>
                                            <input name="gaji_min" type="number" min="0" class="form-control" value="{{ $item->gaji_min }}">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Gaji maksimum</label>
                                            <input name="gaji_max" type="number" min="0" class="form-control" value="{{ $item->gaji_max }}">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Jumlah</label>
                                            <input name="jumlah" type="number" min="0" class="form-control" value="{{ $item->jumlah }}" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="dibuka" @selected($item->status === 'dibuka')>Dibuka</option>
                                                <option value="ditutup" @selected($item->status === 'ditutup')>Ditutup</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label class="form-label mt-2">Skill (satu per baris)</label>
                                    <textarea name="skills" class="form-control mb-2" rows="3">{{ implode("\n", (array) $item->skills) }}</textarea>
                                    <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                                </form>
                                <form action="{{ route('lowongan.destroy', $item->id_lowongan) }}" method="POST" class="mt-2" onsubmit="return confirm('Hapus lowongan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                </form>
                            </details>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada lowongan pekerjaan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
