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

<div class="dashboard-card mb-4">
    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Tambah Pengajuan</h5>
            <p class="dashboard-card-subtitle">Admin dapat mencatat pengajuan yang diterima secara langsung.</p>
        </div>
    </div>
    <form action="{{ route('mentoring.store-admin') }}" method="POST" class="p-3">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label for="id_mentor" class="form-label">Mentor</label>
                <select id="id_mentor" name="id_mentor" class="form-select" required>
                    <option value="">Pilih mentor</option>
                    @foreach ($mentors as $mentor)
                        <option value="{{ $mentor->id_alumni }}" @selected(old('id_mentor') == $mentor->id_alumni)>
                            {{ $mentor->siswa->nama_siswa }} — {{ $mentor->jurusan?->nama_jurusan ?? 'Jurusan tidak tersedia' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="nama_pemohon" class="form-label">Nama pemohon</label>
                <input id="nama_pemohon" name="nama_pemohon" class="form-control" value="{{ old('nama_pemohon') }}" required>
            </div>
            <div class="col-md-4">
                <label for="status_pemohon" class="form-label">Status pemohon</label>
                <input id="status_pemohon" name="status_pemohon" class="form-control" placeholder="Contoh: Siswa kelas XII" value="{{ old('status_pemohon') }}" required>
            </div>
            <div class="col-md-4">
                <label for="no_telp" class="form-label">Nomor telepon</label>
                <input id="no_telp" name="no_telp" type="tel" class="form-control" value="{{ old('no_telp') }}" maxlength="30">
            </div>
            <div class="col-12">
                <label for="topik" class="form-label">Topik mentoring</label>
                <textarea id="topik" name="topik" class="form-control" rows="2" required>{{ old('topik') }}</textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" @disabled($mentors->isEmpty())>
                    <i class="bi bi-plus-lg me-1"></i> Simpan Pengajuan
                </button>
                @if ($mentors->isEmpty())
                    <span class="text-muted ms-2">Belum ada data alumni yang bersedia menjadi mentor.</span>
                @endif
            </div>
        </div>
    </form>
</div>

<div class="row g-3 mb-4">
    @foreach ([
        ['Total Pengajuan', $jumlahTotal, 'primary', 'bi-briefcase-fill'],
        ['Menunggu', $jumlahMenunggu, 'warning', 'bi-hourglass-split'],
        ['Dalam Proses', $jumlahDiproses, 'info', 'bi-arrow-repeat'],
        ['Selesai', $jumlahSelesai, 'success', 'bi-check-circle-fill'],
    ] as [$label, $jumlah, $warna, $ikon])
        <div class="col-xl-3 col-md-6">
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
            <p class="dashboard-card-subtitle">Data ini berasal dari formulir Ajukan Mentoring pada halaman karir.</p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table dashboard-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Pemohon</th>
                    <th>Nomor Telepon</th>
                    <th>Status Pemohon</th>
                    <th>Jurusan Mentor</th>
                    <th>Mentor</th>
                    <th>Topik</th>
                    <th>Tanggal</th>
                    <th>Status Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permintaan as $item)
                    <tr>
                        <td>{{ $item->nama_pemohon }}</td>
                        <td>{{ $item->no_telp ?: '-' }}</td>
                        <td>{{ $item->status_pemohon }}</td>
                        <td>{{ $item->mentor?->jurusan?->nama_jurusan ?? 'Jurusan tidak tersedia' }}</td>
                        <td>{{ $item->mentor?->siswa?->nama_siswa ?? $item->mentor_nama }}</td>
                        <td>{{ $item->topik }}</td>
                        <td>{{ $item->created_at?->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('mentoring.update-status', $item->id_mentoring) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status_pengajuan" class="form-select form-select-sm" aria-label="Status pengajuan">
                                    <option value="menunggu" @selected($item->status_pengajuan === 'menunggu')>Menunggu</option>
                                    <option value="diproses" @selected($item->status_pengajuan === 'diproses')>Dalam Proses</option>
                                    <option value="selesai" @selected($item->status_pengajuan === 'selesai')>Selesai</option>
                                    <option value="ditolak" @selected($item->status_pengajuan === 'ditolak')>Ditolak</option>
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
            </tbody>
        </table>
    </div>
</div>
@endsection
