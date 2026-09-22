<?php

namespace App\Http\Controllers;

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
        return view('karir.karir', ['lowongan' => $this->lowongan()]);
    }

    /**
     * Menampilkan halaman jurusan TKR beserta info karirnya.
     */
    public function tkr(): View
    {
        return view('karir.tkr', ['lowongan' => $this->lowongan()]);
    }

    /**
     * Menampilkan halaman jurusan TBSM beserta info karirnya.
     */
    public function tbsm(): View
    {
        return view('karir.tbsm', ['lowongan' => $this->lowongan()]);
    }

    /**
     * Menampilkan halaman jurusan TP beserta info karirnya.
     */
    public function tp(): View
    {
        return view('karir.tp', ['lowongan' => $this->lowongan()]);
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
     * Mengambil daftar lowongan kerja yang sedang dibuka.
     */
    private function lowongan(): Collection
    {
        return Lowongan::where('status', 'dibuka')
            ->latest('id_lowongan')
            ->get();
    }
}
