<?php

namespace App\Http\Controllers;

use App\Models\AlumniTrack;
use App\Models\Jurusan;
use App\Models\Lowongan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $request->validate([
            'mentor' => ['required', 'string', 'max:150'],
            'nama' => ['required', 'string', 'max:150'],
            'status' => ['required', 'string', 'max:100'],
            'topik' => ['required', 'string', 'max:1000'],
        ]);

        return back()->with('request_code', 'MTR-'.strtoupper(Str::random(6)));
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
