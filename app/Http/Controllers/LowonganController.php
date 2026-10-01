<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Lowongan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function index(): View
    {
        return view('admin.lowongan-pekerjaan', [
            'lowongan' => Lowongan::with('jurusan')->latest('id_lowongan')->get(),
            'jurusan' => Jurusan::orderBy('nama_jurusan')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        Lowongan::create($validated);

        return redirect()->route('lowongan.index')
            ->with('success', 'Lowongan pekerjaan berhasil ditambahkan.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $this->validatedData($request);

        Lowongan::findOrFail($id)->update($validated);

        return redirect()->route('lowongan.index')
            ->with('success', 'Lowongan pekerjaan berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Lowongan::findOrFail($id)->delete();

        return redirect()->route('lowongan.index')
            ->with('success', 'Lowongan pekerjaan berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'id_jurusan' => ['required', 'integer', 'exists:jurusan,id_jurusan'],
            'nama_lowongan' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string', 'max:5000'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:dibuka,ditutup'],
            'gaji_min' => ['nullable', 'integer', 'min:0', 'required_with:gaji_max'],
            'gaji_max' => ['nullable', 'integer', 'min:0', 'gte:gaji_min', 'required_with:gaji_min'],
            'skills' => ['nullable', 'string', 'max:3000'],
        ]);

        $validated['skills'] = collect(preg_split('/[\r\n,]+/', $validated['skills'] ?? ''))
            ->map(fn (string $skill): string => trim($skill))
            ->filter()
            ->values()
            ->all();

        return $validated;
    }
}
