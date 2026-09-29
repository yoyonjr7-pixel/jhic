<?php

namespace App\Http\Controllers;

use App\Models\AlumniTrack;
use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlumniTrackController extends Controller
{
    public function index()
    {
        $alumni = AlumniTrack::with(['siswa', 'jurusan'])
            ->orderBy('id_alumni', 'desc')
            ->get();

        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        $siswaTersedia = Siswa::with('jurusan')
            ->whereDoesntHave('alumniTrack')
            ->orderBy('nama_siswa')
            ->get();

        return view('admin.alumni-track', compact('alumni', 'jurusan', 'siswaTersedia'));
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH ALUMNI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_siswa' => [
                'required',
                'integer',
                'exists:siswa,id_siswa',
                Rule::unique('alumni_track', 'id_siswa'),
            ],
            'tahun_lulus' => 'required|integer',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:bekerja,kuliah,wirausaha,mencari_kerja',
            'keterangan' => 'nullable|string',
            'mentor' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($validated): void {
            $siswa = Siswa::findOrFail($validated['id_siswa']);
            $siswa->update(['status' => 'lulus']);

            AlumniTrack::create([
                'id_siswa' => $siswa->id_siswa,
                'id_jurusan' => $siswa->id_jurusan,
                'tahun_lulus' => $validated['tahun_lulus'],
                'no_telp' => $validated['no_telp'] ?? null,
                'email' => $validated['email'] ?? null,
                'status' => $validated['status'],
                'keterangan' => $validated['keterangan'] ?? null,
                'mentor' => $validated['mentor'] ?? false,
            ]);
        });

        return redirect('/alumni-track')
            ->with('success', 'Data alumni berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT ALUMNI
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $alumni = AlumniTrack::with('siswa')->findOrFail($id);

        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'id_jurusan' => 'required|integer',
            'tahun_lulus' => 'required|integer',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:bekerja,kuliah,wirausaha,mencari_kerja',
            'keterangan' => 'nullable|string',
            'mentor' => 'nullable|boolean',
        ]);

        // Update data siswa
        $alumni->siswa?->update([
            'nama_siswa' => $validated['nama_siswa'],
            'id_jurusan' => $validated['id_jurusan'],
        ]);

        // Update data alumni
        $alumni->update([
            'id_jurusan' => $validated['id_jurusan'],
            'tahun_lulus' => $validated['tahun_lulus'],
            'no_telp' => $validated['no_telp'],
            'email' => $validated['email'],
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'],
            'mentor' => $validated['mentor'] ?? false,
        ]);

        return redirect('/alumni-track')
            ->with('success', 'Data alumni berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS ALUMNI
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $alumni = AlumniTrack::with('siswa')->findOrFail($id);

        $alumni->delete();

        return redirect('/alumni-track')
            ->with('success', 'Data alumni berhasil dihapus.');
    }
}
