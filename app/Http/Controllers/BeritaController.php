<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BeritaController extends Controller
{
    /**
     * Kategori tetap yang dipakai filter di halaman utama & dashboard.
     */
    public const KATEGORI = [
        'kegiatan' => 'Kegiatan Sekolah',
        'prestasi' => 'Prestasi',
        'pengumuman' => 'Pengumuman',
        'karya' => 'Karya & Inovasi Siswa',
        'artikel' => 'Artikel',
    ];

    public function publicIndex(): View
    {
        $berita = Berita::query()
            ->orderByDesc('Tanggal')
            ->orderByDesc('id_berita')
            ->get();

        return view('berita.index', compact('berita'));
    }

    public function index(): View
    {
        $berita = Berita::orderByDesc('Tanggal')
            ->orderByDesc('id_berita')
            ->get();

        return view('admin.berita', [
            'berita' => $berita,
            'kategoriList' => self::KATEGORI,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate($this->rules(), $this->messages());

        if ($request->hasFile('foto')) {
            // Hapus hanya file hasil upload admin (di disk public), jangan sentuh folder lama.
            if ($berita->foto && ! str_starts_with($berita->foto, 'beritaimages/')) {
                Storage::disk('public')->delete($berita->foto);
            }

            $validated['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto && ! str_starts_with($berita->foto, 'beritaimages/')) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'judul_berita' => 'required|string|max:255',
            'kategori' => 'required|string|in:' . implode(',', array_keys(self::KATEGORI)),
            'Tanggal' => 'required|date',
            'jam' => 'nullable|date_format:H:i',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    private function messages(): array
    {
        return [
            'judul_berita.required' => 'Judul berita wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'Tanggal.required' => 'Tanggal wajib diisi.',
            'jam.date_format' => 'Format jam tidak valid.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}
