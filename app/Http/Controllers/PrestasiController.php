<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Jurusan;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /**
     * Menampilkan halaman Prestasi
     */
    public function index()
    {
        $prestasi = Prestasi::with('jurusan')
            ->orderBy('id_prestasi', 'desc')
            ->get();

        $jurusan = Jurusan::orderBy('nama_jurusan')
            ->get();

        return view('admin.prestasi', compact('prestasi', 'jurusan'));
    }

    public function publicIndex()
    {
        $daftarPrestasi = Prestasi::with('jurusan')
            ->latest('id_prestasi')
            ->get();

        $prestasi = $daftarPrestasi
            ->groupBy(fn (Prestasi $item): string => $item->tingkat ?: 'Lainnya')
            ->map(fn (Collection $items, string $tingkat): array => [
                'tingkat' => $tingkat,
                'jumlah' => $items->count(),
            ])
            ->values()
            ->all();

        // Pertahankan diagram bawaan saat tabel prestasi belum memiliki data.
        if ($prestasi === []) {
            $prestasi = [
                ['tingkat' => 'Kabupaten', 'jumlah' => 50],
                ['tingkat' => 'Provinsi', 'jumlah' => 60],
                ['tingkat' => 'Nasional', 'jumlah' => 120],
                ['tingkat' => 'Internasional', 'jumlah' => 0],
            ];
        }

        return view('prestasi.index', compact('prestasi', 'daftarPrestasi'));
    }

    /**
     * Menyimpan data Prestasi baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'nama_pemenang' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'id_jurusan' => 'nullable|exists:jurusan,id_jurusan',
            'tingkat' => 'nullable|string|max:100',
            'juara' => 'nullable|string|max:100',
            'tahun' => 'nullable|integer|min:2000|max:2100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('prestasi', 'public');
        }

        Prestasi::create($validated);

        return redirect()
            ->route('prestasi.index')
            ->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu Prestasi
     */
    public function show($id)
    {
        $prestasi = Prestasi::with('jurusan')
            ->findOrFail($id);

        return response()->json($prestasi);
    }

    /**
     * Mengubah data Prestasi
     */
    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $validated = $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'nama_pemenang' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'id_jurusan' => 'nullable|exists:jurusan,id_jurusan',
            'tingkat' => 'nullable|string|max:100',
            'juara' => 'nullable|string|max:100',
            'tahun' => 'nullable|integer|min:2000|max:2100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {

            if ($prestasi->foto) {
                Storage::disk('public')->delete($prestasi->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('prestasi', 'public');
        }

        $prestasi->update($validated);

        return redirect()
            ->route('prestasi.index')
            ->with('success', 'Data prestasi berhasil diperbarui.');
    }

    /**
     * Menghapus data Prestasi
     */
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($prestasi->foto) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()
            ->route('prestasi.index')
            ->with('success', 'Data prestasi berhasil dihapus.');
    }
}