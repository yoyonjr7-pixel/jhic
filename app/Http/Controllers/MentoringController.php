<?php

namespace App\Http\Controllers;

use App\Models\AlumniTrack;
use App\Models\MentoringRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MentoringController extends Controller
{
    public function index(): View
    {
        $permintaan = MentoringRequest::with(['mentor.siswa', 'mentor.jurusan'])
            ->latest('id_mentoring')
            ->get();
        $mentors = AlumniTrack::with(['siswa', 'jurusan'])
            ->whereHas('siswa')
            ->get()
            ->filter(fn (AlumniTrack $alumni): bool => $this->isAvailableMentor($alumni))
            ->values();

        return view('admin.mentoring', [
            'permintaan' => $permintaan,
            'mentors' => $mentors,
            'jumlahTotal' => $permintaan->count(),
            'jumlahMenunggu' => $permintaan->where('status_pengajuan', 'menunggu')->count(),
            'jumlahDiproses' => $permintaan->where('status_pengajuan', 'diproses')->count(),
            'jumlahSelesai' => $permintaan->where('status_pengajuan', 'selesai')->count(),
        ]);
    }

    public function show(int $id): View
    {
        $permintaan = MentoringRequest::with(['mentor.siswa', 'mentor.jurusan'])
            ->findOrFail($id);

        return view('admin.mentoring-detail', compact('permintaan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id_mentor' => ['required', 'integer', 'exists:alumni_track,id_alumni'],
            'nama_pemohon' => ['required', 'string', 'max:150'],
            'no_telp' => ['nullable', 'string', 'max:30'],
            'status_pemohon' => ['required', 'string', 'max:100'],
            'topik' => ['required', 'string', 'max:1000'],
        ]);

        $mentor = AlumniTrack::with('siswa')->findOrFail($data['id_mentor']);
        if (! $mentor->siswa || ! $this->isAvailableMentor($mentor)) {
            throw ValidationException::withMessages([
                'id_mentor' => 'Pilih alumni yang bersedia menjadi mentor.',
            ]);
        }

        MentoringRequest::create([
            'id_mentor' => $mentor->id_alumni,
            'mentor_nama' => $mentor->siswa->nama_siswa,
            'nama_pemohon' => $data['nama_pemohon'],
            'no_telp' => $data['no_telp'] ?? null,
            'status_pemohon' => $data['status_pemohon'],
            'topik' => $data['topik'],
        ]);

        return redirect()->route('mentoring.index')
            ->with('success', 'Pengajuan mentoring berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'status_pengajuan' => ['required', 'in:menunggu,diproses,selesai,ditolak'],
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

    private function isAvailableMentor(AlumniTrack $alumni): bool
    {
        $value = strtolower(trim((string) $alumni->getRawOriginal('mentor')));

        return $value !== '' && ! in_array($value, ['0', 'false', 'no', 'off'], true);
    }
}
