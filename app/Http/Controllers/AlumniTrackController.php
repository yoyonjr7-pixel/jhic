<?php

namespace App\Http\Controllers;

use App\Models\AlumniTrack;
use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AlumniTrackController extends Controller
{
    public function index()
    {
        $alumni = AlumniTrack::with(['siswa', 'jurusan'])
            ->orderBy('id_alumni', 'desc')
            ->get();

        $jurusan = Jurusan::orderBy('nama_jurusan')->get();

        return view('alumni-track', compact('alumni', 'jurusan'));
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH ALUMNI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required|string|max:50',
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'id_jurusan' => 'required|integer',
            'tahun_lulus' => 'required|integer',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:bekerja,memiliki_usaha,mencari_kerja',
            'keterangan' => 'nullable|string',
        ]);

        // Buat data siswa terlebih dahulu
        $siswa = Siswa::create([
            'nisn' => $validated['nisn'],
            'nama_siswa' => $validated['nama_siswa'],
            'kelas' => $validated['kelas'],
            'id_jurusan' => $validated['id_jurusan'],
            'status' => 'aktif',
        ]);

        // Buat data alumni
        AlumniTrack::create([
            'id_siswa' => $siswa->id_siswa,
            'id_jurusan' => $validated['id_jurusan'],
            'tahun_lulus' => $validated['tahun_lulus'],
            'no_telp' => $validated['no_telp'],
            'email' => $validated['email'],
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'],
            'mentor' => 0,
        ]);

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
            'status' => 'required|in:bekerja,memiliki_usaha,mencari_kerja',
            'keterangan' => 'nullable|string',
        ]);

        // Update data siswa
        $alumni->siswa->update([
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

        // Simpan data siswa yang terkait
        $siswa = $alumni->siswa;

        // Hapus data alumni
        $alumni->delete();

        // Hapus data siswa yang terkait
        if ($siswa) {
            $siswa->delete();
        }

        return redirect('/alumni-track')
            ->with('success', 'Data alumni berhasil dihapus.');
    }
}
