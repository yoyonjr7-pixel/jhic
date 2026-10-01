@extends('layouts.admin')

@section('title', 'Pendaftar SPMB')

@section('page-title', 'Pendaftar SPMB')

@section('content')
<div class="mb-4">
    <span class="welcome-label">PENERIMAAN SISWA BARU</span>
    <h2 class="fw-bold mt-3 mb-1">Pendaftar SPMB</h2>
    <p class="text-muted mb-0">Data ini berasal dari formulir pendaftaran pada situs sekolah.</p>
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

<div class="dashboard-card">
    <div class="dashboard-card-header">
        <div>
            <h5 class="dashboard-card-title">Data Pendaftar</h5>
            <p class="dashboard-card-subtitle">{{ $pendaftar->count() }} data tersimpan.</p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table dashboard-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Asal Sekolah</th>
                    <th>Jurusan</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendaftar as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->nama }}</strong>
                            <small class="d-block text-muted">{{ $item->email }}</small>
                        </td>
                        <td>
                            Siswa: {{ $item->whatsapp_siswa ?: '-' }}<br>
                            Wali: {{ $item->whatsapp_orang_tua ?: '-' }}
                        </td>
                        <td>{{ $item->asal_sekolah ?: '-' }}</td>
                        <td>{{ $item->jurusan ?: '-' }}</td>
                        <td>{{ $item->created_at?->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('spmb-pendaftar.update-status', $item->id_spmb) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select form-select-sm" aria-label="Status pendaftar">
                                    @foreach (['Baru', 'Diproses', 'Diterima', 'Ditolak'] as $status)
                                        <option value="{{ $status }}" @selected($item->status === $status)>{{ $status }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                            </form>
                        </td>
                    </tr>
                    @if ($item->alamat)
                        <tr>
                            <td colspan="6"><small><strong>Alamat:</strong> {{ $item->alamat }}</small></td>
                        </tr>
                    @endif
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pendaftar SPMB.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
