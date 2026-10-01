<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function publicIndex(): View
    {
        $berita = Berita::query()
            ->where('status', 'Terbit')
            ->where(function ($query): void {
                $query->whereNull('tanggal_publish')
                    ->orWhereDate('tanggal_publish', '<=', now()->toDateString());
            })
            ->latest('tanggal_publish')
            ->latest('id_berita')
            ->get();

        return view('berita.index', compact('berita'));
    }

    public function index()
    {
        $berita = Berita::orderBy('id_berita', 'desc')->get();

        return view('admin.berita', compact('berita'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'penulis' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:Draft,Terbit',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['judul']);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);

        return response()->json($berita);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'penulis' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:Draft,Terbit',
        ]);

        if ($berita->judul !== $validated['judul']) {
            $validated['slug'] = $this->generateUniqueSlug(
                $validated['judul'],
                $berita->id_berita
            );
        }

        if ($request->hasFile('foto')) {

            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('berita', 'public');
        }

        $berita->update($validated);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    private function generateUniqueSlug($judul, $ignoreId = null)
    {
        $slug = Str::slug($judul);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Berita::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id_berita', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
