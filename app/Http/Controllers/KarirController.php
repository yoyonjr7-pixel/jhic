<?php

namespace App\Http\Controllers;

use App\Models\AlumniTrack;
use App\Models\Jurusan;
use App\Models\Lowongan;
use App\Models\Mentoring;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

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
    public function mentoringStore(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'mentor' => ['required', 'string', 'max:150'],
            'nama_kamu' => ['required', 'string', 'max:150'],
            'catatan' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'string', 'max:100'],
            'no_telp' => ['required', 'digits_between:10,15'],
            'topik' => ['required', 'string', 'max:1000'],
        ]);

        try {
            $mentoring = Mentoring::create([
                'nama_siswa' => $request->string('nama_kamu')->toString(),
                'no_telp' => $request->string('no_telp')->toString(),
                'nama_mentor' => $request->string('mentor')->toString(),
                'topik_mentoring' => $request->string('topik')->toString(),
                'catatan' => trim('Status peserta: '.$request->string('status')->toString().($request->filled('catatan') ? PHP_EOL.$request->string('catatan')->toString() : '')),
                'status' => 'pending',
                'tanggal' => now()->toDateString(),
            ]);
        } catch (Throwable $exception) {
            Log::error('Gagal menyimpan permintaan mentoring.', ['exception' => $exception]);
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Permintaan mentoring belum dapat disimpan. Silakan coba lagi.'], 500);
            }
            return back()->withInput()->with('error', 'Permintaan mentoring belum dapat disimpan. Silakan coba lagi.');
        }

        $requestCode = 'MTR-'.strtoupper(Str::padLeft((string) $mentoring->id, 6, '0'));

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Permintaan mentoring berhasil disimpan.', 'request_code' => $requestCode], 201);
        }

        return back()->with('request_code', $requestCode);
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
            ->where('mentor', true)
            ->where('id_jurusan', $idJurusan)
            ->whereNotNull('id_siswa')
            ->latest('id_alumni')
            ->get()
            ->filter(fn (AlumniTrack $alumni): bool => $alumni->siswa !== null)
            ->values();
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
