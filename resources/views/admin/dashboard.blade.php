@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="dashboard-welcome mb-4">
    <h2 class="mt-3 mb-2">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}</h2>
    <p class="text-muted mb-0">Ringkasan aktivitas terbaru dari database sekolah.</p>
</div>

<div class="row g-3 mb-4">
    @foreach ([
        ['Pengajuan Mentoring', $totalMentoring, $menungguMentoring . ' menunggu', 'primary', 'bi-briefcase-fill', route('mentoring.index')],
        ['Total Alumni', $totalAlumni, 'data alumni tersimpan', 'success', 'bi-mortarboard-fill', url('/alumni-track')],
        ['Data Siswa', $totalSiswa, 'siswa terdaftar', 'info', 'bi-people-fill', route('siswa.index')],
        ['Aktivitas TEFA', $totalBookingTefa, $bookingTefaDiproses . ' diproses', 'info', 'bi-shop', route('tefa.index')],
        ['Lowongan Dibuka', $lowonganDibuka, $lowonganDibuka . ' Lowongan Di Buka', 'warning', 'bi-briefcase', route('lowongan.index')],
    ] as [$label, $jumlah, $catatan, $warna, $ikon, $tautan])
        <div class="col-xl-3 col-md-6">
            <a href="{{ $tautan }}" class="text-decoration-none">
                <div class="dashboard-stat-card h-100">
                    <div class="stat-content">
                        <div>
                            <p class="stat-label">{{ $label }}</p>
                            <h2 class="stat-number">{{ $jumlah }}</h2>
                            <span class="stat-status {{ $warna }}">{{ $catatan }}</span>
                        </div>
                        <div class="stat-icon {{ $warna }}"><i class="bi {{ $ikon }}"></i></div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="dashboard-card">
    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Pengajuan Mentoring Terbaru</h5>
            <p class="dashboard-card-subtitle">Permintaan yang dikirim melalui halaman Jurusan &amp; Karir.</p>
        </div>
        <a href="{{ route('mentoring.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table dashboard-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Pemohon</th>
                    <th>Nomor Telepon</th>
                    <th>Jurusan</th>
                    <th>Mentor</th>
                    <th>Topik</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permintaanTerbaru as $item)
                    <tr>
                        <td>{{ $item->nama_pemohon }}</td>
                        <td>{{ $item->no_telp ?: '-' }}</td>
                        <td>{{ $item->mentor?->jurusan?->nama_jurusan ?? '-' }}</td>
                        <td>{{ $item->mentor?->siswa?->nama_siswa ?? $item->mentor_nama }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->topik, 70) }}</td>
                        <td>{{ $item->status_pengajuan_label }}</td>
                        <td>{{ $item->created_at?->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada pengajuan mentoring.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
