@extends('layouts.admin')

@section('title', 'Mentoring | Admin')
@section('page-title', 'Mentoring')

@section('content')
    <div class="admin-mentoring-page">
        <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
            <div>
                <div class="text-uppercase small fw-bold text-primary mb-2">KARIR</div>
                <h1 class="h3 mb-1">Mentoring</h1>
                <p class="text-muted mb-0">Kelola pengajuan mentoring siswa dan mentor alumni.</p>
            </div>
            <a href="{{ route('admin.mentoring.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Mentoring</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-3 mb-4">
            @foreach ([['Total Mentoring', 'total', 'bi-people-fill', 'primary'], ['Menunggu', 'menunggu', 'bi-hourglass-split', 'warning'], ['Dalam Proses', 'proses', 'bi-arrow-repeat', 'info'], ['Selesai', 'selesai', 'bi-check-circle-fill', 'success']] as [$label, $key, $icon, $color])
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="dashboard-stat-card mentoring-stat-card">
                        <div><p class="stat-label">{{ $label }}</p><h3 class="stat-value">{{ $stats[$key] }}</h3></div>
                        <span class="mentoring-stat-icon text-{{ $color }}"><i class="bi {{ $icon }}"></i></span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <div><h2 class="dashboard-card-title">Data Mentoring</h2><p class="dashboard-card-subtitle">Data tersimpan pada tabel mentoring.</p></div>
                <form class="d-flex gap-2 flex-wrap" method="get">
                    <div class="input-group" style="max-width: 270px"><span class="input-group-text"><i class="bi bi-search"></i></span><input class="form-control" name="search" value="{{ $search }}" placeholder="Cari siswa, mentor, topik..."></div>
                    <select class="form-select" name="status" style="max-width: 170px">
                        <option value="">Semua status</option>
                        <option value="pending" @selected($status === 'pending')>Pending</option>
                        <option value="diproses" @selected($status === 'diproses')>Diproses</option>
                        <option value="selesai" @selected($status === 'selesai')>Selesai</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead><tr><th>Peserta</th><th>Mentor</th><th>Topik</th><th>Status</th><th>Tanggal</th><th class="text-end">Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td><strong>{{ $item->nama_siswa }}</strong><div class="text-muted small">{{ $item->jurusan?->nama_jurusan ?? 'Jurusan belum diisi' }}{{ $item->kelas ? ' · '.$item->kelas : '' }}</div></td>
                                <td>{{ $item->nama_mentor ?: ($item->alumni?->siswa?->nama_siswa ?? '-') }}</td>
                                <td>{{ $item->topik_mentoring }}@if ($item->catatan)<div class="text-muted small">{{ \Illuminate\Support\Str::limit($item->catatan, 60) }}</div>@endif</td>
                                <td><span class="badge rounded-pill status-{{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
                                <td>{{ $item->tanggal?->format('d/m/Y') ?? '-' }}</td>
                                <td class="text-end"><div class="d-inline-flex gap-1"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.mentoring.edit', $item->id) }}" title="Edit"><i class="bi bi-pencil"></i></a><form method="post" action="{{ route('admin.mentoring.destroy', $item->id) }}" onsubmit="return confirm('Hapus data mentoring ini?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></button></form></div></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-5">Belum ada data mentoring.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">{{ $items->links() }}</div>
        </div>
    </div>
@endsection
