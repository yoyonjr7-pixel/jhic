<?php

namespace App\Http\Controllers;

use App\Models\UnduhInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UnduhInformasiController extends Controller
{
    public function index()
    {
        $informasi = UnduhInformasi::orderBy(
            'id_informasi',
            'desc'
        )->get();

        return view('unduh-informasi', compact('informasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:Draft,Terbit',
        ]);

        $file = $request->file('file');

        $path = $file->store('unduh-informasi', 'public');

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['judul']
        );

        $validated['nama_file'] = $file->getClientOriginalName();

        $validated['file_path'] = $path;

        $validated['format_file'] = strtolower(
            $file->getClientOriginalExtension()
        );

        $validated['ukuran_file'] = $file->getSize();

        unset($validated['file']);

        UnduhInformasi::create($validated);

        return redirect()
            ->route('unduh-informasi.index')
            ->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $informasi = UnduhInformasi::findOrFail($id);

        return response()->json($informasi);
    }

    public function update(Request $request, $id)
    {
        $informasi = UnduhInformasi::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'tanggal_publish' => 'nullable|date',
            'status' => 'required|in:Draft,Terbit',
        ]);

        if ($informasi->judul !== $validated['judul']) {

            $validated['slug'] = $this->generateUniqueSlug(
                $validated['judul'],
                $informasi->id_informasi
            );
        }

        if ($request->hasFile('file')) {

            if ($informasi->file_path) {
                Storage::disk('public')->delete(
                    $informasi->file_path
                );
            }

            $file = $request->file('file');

            $validated['nama_file'] =
                $file->getClientOriginalName();

            $validated['file_path'] =
                $file->store(
                    'unduh-informasi',
                    'public'
                );

            $validated['format_file'] =
                strtolower(
                    $file->getClientOriginalExtension()
                );

            $validated['ukuran_file'] =
                $file->getSize();
        }

        unset($validated['file']);

        $informasi->update($validated);

        return redirect()
            ->route('unduh-informasi.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $informasi = UnduhInformasi::findOrFail($id);

        if ($informasi->file_path) {

            Storage::disk('public')->delete(
                $informasi->file_path
            );
        }

        $informasi->delete();

        return redirect()
            ->route('unduh-informasi.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }

    public function download($id)
    {
        $informasi = UnduhInformasi::findOrFail($id);

        if (!Storage::disk('public')->exists(
            $informasi->file_path
        )) {

            abort(
                404,
                'File dokumen tidak ditemukan.'
            );
        }

        return Storage::disk('public')->download(
            $informasi->file_path,
            $informasi->nama_file
        );
    }

    private function generateUniqueSlug(
        $judul,
        $ignoreId = null
    ) {
        $slug = Str::slug($judul);

        if ($slug === '') {
            $slug = 'informasi';
        }

        $originalSlug = $slug;

        $counter = 1;

        while (
            UnduhInformasi::where('slug', $slug)
                ->when(
                    $ignoreId,
                    function ($query) use ($ignoreId) {
                        $query->where(
                            'id_informasi',
                            '!=',
                            $ignoreId
                        );
                    }
                )
                ->exists()
        ) {

            $slug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }

        return $slug;
    }
}