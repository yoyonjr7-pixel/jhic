<?php

namespace App\Http\Controllers;

use App\Models\MentoringRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MentoringController extends Controller
{
    public function index(): View
    {
        $permintaan = MentoringRequest::with(['mentor.siswa', 'mentor.jurusan'])
            ->latest('id_mentoring')
            ->get();

        return view('admin.mentoring', [
            'permintaan' => $permintaan,
            'jumlahTotal' => $permintaan->count(),
            'jumlahMenunggu' => $permintaan->where('status_pengajuan', 'menunggu')->count(),
            'jumlahDiproses' => $permintaan->where('status_pengajuan', 'diproses')->count(),
            'jumlahSelesai' => $permintaan->where('status_pengajuan', 'selesai')->count(),
            'jumlahDitolak' => $permintaan->where('status_pengajuan', 'ditolak')->count(),
        ]);
    }

    public function show(int $id): View
    {
        $permintaan = MentoringRequest::with(['mentor.siswa', 'mentor.jurusan'])
            ->findOrFail($id);

        return view('admin.mentoring-detail', compact('permintaan'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'status_pengajuan' => ['required', 'in:selesai,ditolak'],
        ]);

        MentoringRequest::findOrFail($id)->update($data);

        return redirect()->route('mentoring.index')
            ->with('success', 'Status pengajuan mentoring berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        MentoringRequest::findOrFail($id)->delete();

        return redirect()->route('mentoring.index')
            ->with('success', 'Pengajuan mentoring berhasil dihapus.');
    }
}
