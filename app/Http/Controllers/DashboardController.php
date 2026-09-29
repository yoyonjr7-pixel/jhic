<?php

namespace App\Http\Controllers;

use App\Models\AlumniTrack;
use App\Models\BookingTefa;
use App\Models\Lowongan;
use App\Models\MentoringRequest;
use App\Models\SpmbPendaftar;
use App\Models\Siswa;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalMentoring' => MentoringRequest::count(),
            'menungguMentoring' => MentoringRequest::where('status_pengajuan', 'menunggu')->count(),
            'totalAlumni' => AlumniTrack::count(),
            'totalSiswa' => Siswa::count(),
            'totalBookingTefa' => BookingTefa::count(),
            'bookingTefaDiproses' => BookingTefa::where('status_book', 'diproses')->count(),
            'lowonganDibuka' => Lowongan::where('status', 'dibuka')->count(),
            'pendaftarBaru' => SpmbPendaftar::where('status', 'Baru')->count(),
            'permintaanTerbaru' => MentoringRequest::with(['mentor.siswa', 'mentor.jurusan'])
                ->latest('id_mentoring')
                ->limit(5)
                ->get(),
        ]);
    }
}
