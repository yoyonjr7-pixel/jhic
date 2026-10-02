@extends('layouts.admin')

@section('title', 'Detail Mentoring')

@section('page-title', 'Detail Mentoring')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <span class="welcome-label">KARIR</span>
        <h2 class="fw-bold mt-3 mb-1">Detail Pengajuan Mentoring</h2>
        <p class="text-muted mb-0">Informasi pengajuan dari database mentoring.</p>
    </div>
    <a href="{{ route('mentoring.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="dashboard-card p-4">
    <dl class="row mb-0">
        <dt class="col-sm-3">Pemohon</dt>
        <dd class="col-sm-9">{{ $permintaan->nama_pemohon }}</dd>

        <dt class="col-sm-3">Nomor telepon</dt>
        <dd class="col-sm-9">{{ $permintaan->no_telp ?: '-' }}</dd>

        <dt class="col-sm-3">Status pemohon</dt>
        <dd class="col-sm-9">{{ $permintaan->status_pemohon }}</dd>

        <dt class="col-sm-3">Mentor</dt>
        <dd class="col-sm-9">{{ $permintaan->mentor?->siswa?->nama_siswa ?? $permintaan->mentor_nama }}</dd>

        <dt class="col-sm-3">Jurusan mentor</dt>
        <dd class="col-sm-9">{{ $permintaan->mentor?->jurusan?->nama_jurusan ?? 'Jurusan tidak tersedia' }}</dd>

        <dt class="col-sm-3">Topik</dt>
        <dd class="col-sm-9">{{ $permintaan->topik }}</dd>

        <dt class="col-sm-3">Status pengajuan</dt>
        <dd class="col-sm-9">{{ $permintaan->status_pengajuan_label }}</dd>

        <dt class="col-sm-3">Tanggal pengajuan</dt>
        <dd class="col-sm-9">{{ $permintaan->created_at?->format('d M Y H:i') }}</dd>
    </dl>
</div>
@endsection
