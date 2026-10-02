<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(): View
    {
        $siswa = Siswa::with(['jurusan', 'alumniTrack'])
            ->orderBy('nama_siswa')
            ->get();

        $jurusan = Jurusan::orderBy('nama_jurusan')->get();

        return view('admin.siswa', compact('siswa', 'jurusan'));
    }

    public function store(Request $request): RedirectResponse
    {
        Siswa::create($this->validatedData($request));

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $siswa = Siswa::findOrFail($id);
        $validated = $this->validatedData($request, $siswa);

        DB::transaction(function () use ($siswa, $validated): void {
            if ($siswa->alumniTrack()->exists()) {
                $validated['status'] = 'lulus';
            }

            $siswa->update($validated);
            $siswa->alumniTrack()->update(['id_jurusan' => $siswa->id_jurusan]);
        });

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $siswa = Siswa::findOrFail($id);

        if ($siswa->alumniTrack()->exists()) {
            return redirect()->route('siswa.index')
                ->with('error', 'Data siswa tidak dapat dihapus karena sudah terhubung dengan Alumni Track.');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Siswa $siswa = null): array
    {
        return $request->validate([
            'nisn' => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'nisn')->ignore($siswa?->id_siswa, 'id_siswa'),
            ],
            'nama_siswa' => ['required', 'string', 'max:150'],
            'kelas' => ['required', 'string', 'max:20'],
            'id_jurusan' => ['required', 'integer', 'exists:jurusan,id_jurusan'],
            'status' => ['required', Rule::in(['aktif', 'lulus', 'keluar'])],
        ]);
    }
}
