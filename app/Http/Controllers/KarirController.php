<?php

namespace App\Http\Controllers;

use App\Models\AlumniTrack;
use App\Models\Jurusan;
use App\Models\Lowongan;
use App\Models\MentoringRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class KarirController extends Controller
{
    /**
     * Menampilkan halaman jurusan TJKT beserta info karirnya.
     */
    public function tjkt(): View
    {
        return $this->halaman('karir.karir', 'tjkt');
    }

    /**
     * Menampilkan halaman jurusan TKR beserta info karirnya.
     */
    public function tkr(): View
    {
        return $this->halaman('karir.tkr', 'tkr');
    }

    /**
     * Menampilkan halaman jurusan TBSM beserta info karirnya.
     */
    public function tbsm(): View
    {
        return $this->halaman('karir.tbsm', 'tsm');
    }

    /**
     * Menampilkan halaman jurusan TP beserta info karirnya.
     */
    public function tp(): View
    {
        return $this->halaman('karir.tp', 'tp');
    }

    /**
     * Menerima permintaan mentoring alumni dari siswa atau alumni lain.
     */
    public function mentoringStore(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id_mentor' => [
                'required',
                'integer',
                'exists:alumni_track,id_alumni',
            ],
            'nama' => ['required', 'string', 'max:150'],
            'no_telp' => ['required', 'string', 'max:30'],
            'status' => ['required', 'string', 'max:100'],
            'topik' => ['required', 'string', 'max:1000'],
        ]);

        $mentor = AlumniTrack::with('siswa')->findOrFail($data['id_mentor']);
        if (! $mentor->siswa || ! $this->isMentor($mentor)) {
            throw ValidationException::withMessages([
                'id_mentor' => 'Alumni ini tidak tersedia sebagai mentor.',
            ]);
        }

        MentoringRequest::create([
            'id_mentor' => $mentor->id_alumni,
            'mentor_nama' => $mentor->siswa?->nama_siswa ?? 'Alumni',
            'nama_pemohon' => $data['nama'],
            'no_telp' => $data['no_telp'],
            'status_pemohon' => $data['status'],
            'topik' => $data['topik'],
        ]);

        return back()->with('mentoring_success', true);
    }

    /**
     * Menampilkan halaman karir satu jurusan beserta lowongannya.
     */
    private function halaman(string $view, string $kodeJurusan): View
    {
        return view($view, [
            'lowongan' => $this->lowongan($kodeJurusan),
            'mentors' => $this->mentors($kodeJurusan),
        ]);
    }

    /**
     * Mengambil daftar lowongan yang dibuka untuk jurusan tertentu,
     * dicocokkan lewat id_jurusan pada tabel lowongan_kerja.
     */
    private function mentors(string $kodeJurusan): Collection
    {
        $idJurusan = $this->idJurusan($kodeJurusan);

        if (! $idJurusan) {
            return new Collection();
        }

        return AlumniTrack::query()
            ->with('siswa')
            ->where(function (Builder $query) use ($idJurusan): void {
                $query->where('id_jurusan', $idJurusan)
                    ->orWhereHas('siswa', function (Builder $siswaQuery) use ($idJurusan): void {
                        $siswaQuery->where('id_jurusan', $idJurusan);
                    });
            })
            ->whereHas('siswa')
            ->latest('id_alumni')
            ->get()
            ->filter(fn (AlumniTrack $alumni): bool => $alumni->siswa !== null && $this->isMentor($alumni))
            ->values();
    }

    private function isMentor(AlumniTrack $alumni): bool
    {
        $value = strtolower(trim((string) $alumni->getRawOriginal('mentor')));

        return $value !== '' && ! in_array($value, ['0', 'false', 'no', 'off'], true);
    }

    private function lowongan(string $kodeJurusan): Collection
    {
        $idJurusan = $this->idJurusan($kodeJurusan);

        if (! $idJurusan) {
            return new Collection();
        }

        return Lowongan::where('status', 'dibuka')
            ->where('id_jurusan', $idJurusan)
            ->latest('id_lowongan')
            ->get();
    }

    /**
     * Mencari id jurusan berdasarkan kode pada config/tefa.php.
     */
    private function idJurusan(string $kodeJurusan): ?int
    {
        $namaJurusan = config("tefa.jurusan.{$kodeJurusan}.nama");

        if (! $namaJurusan) {
            return null;
        }

        $idJurusan = Jurusan::where('nama_jurusan', $namaJurusan)->value('id_jurusan');

        return $idJurusan !== null ? (int) $idJurusan : null;
    }
}
