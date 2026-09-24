<?php

namespace App\Http\Controllers;

use App\Models\AlumniTrack;
use App\Models\BookJasah;
use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class AlumniController extends Controller
{
    /**
     * Memeriksa kelayakan NISN tanpa mengembalikan data pribadi siswa.
     */
    public function checkNisn(Request $request): JsonResponse
    {
        $nisn = trim((string) $request->query('nisn', ''));
        if ($nisn === '' || strlen($nisn) < 10 || strlen($nisn) > 20) {
            return response()->json(['valid' => false, 'message' => 'Masukkan NISN yang valid.']);
        }
        $siswa = Siswa::where('nisn', $nisn)->first(['id_siswa']);
        if (! $siswa) {
            return response()->json(['valid' => false, 'message' => 'NISN tidak ditemukan dalam data siswa.']);
        }
        if (AlumniTrack::where('id_siswa', $siswa->id_siswa)->exists()) {
            return response()->json(['valid' => false, 'message' => 'NISN ini sudah terdaftar sebagai alumni.']);
        }
        return response()->json(['valid' => true, 'message' => 'NISN tersedia dan dapat digunakan.']);
    }

    /**
     * Menyimpan pendataan alumni dan membuat bukti pengambilan ijazah.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'nisn' => [
                'required',
                'string',
                'max:20',
                'exists:siswa,nisn',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $siswa = Siswa::where('nisn', $value)->first();

                    if ($siswa && AlumniTrack::where('id_siswa', $siswa->id_siswa)->exists()) {
                        $fail('NISN ini sudah terdaftar sebagai alumni.');
                    }
                },
            ],
            'id_jurusan' => ['required', 'integer', 'exists:jurusan,id_jurusan'],
            'tahun_lulus' => ['required', 'integer', 'digits:4', 'between:1900,' . (now()->year + 1)],
            'no_whatsapp' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:150'],
            'status' => ['required', 'string', 'in:Bekerja,Wirausaha,Melanjutkan Kuliah,Masih Mencari Kerja'],
            'nama_perusahaan' => ['nullable', 'string', 'max:150'],
            'jabatan' => ['nullable', 'string', 'max:150'],
            'cerita_pengalaman' => ['nullable', 'string', 'max:1000'],
            'bersedia_mentor' => ['nullable', 'boolean'],
        ], [
            'nisn.exists' => 'NISN tidak ditemukan dalam data siswa.',
        ], [
            'nisn' => 'NISN',
        ]);

        $status = [
            'Bekerja' => 'bekerja',
            'Wirausaha' => 'wirausaha',
            'Melanjutkan Kuliah' => 'kuliah',
            'Masih Mencari Kerja' => 'mencari_kerja',
        ][$data['status']];

        try {
            $hasil = DB::transaction(function () use ($data, $status) {
                // Kunci siswa selama pemeriksaan dan pembuatan agar submit bersamaan tidak lolos.
                $siswa = Siswa::where('nisn', $data['nisn'])->lockForUpdate()->first();

                if ($siswa && AlumniTrack::where('id_siswa', $siswa->id_siswa)->exists()) {
                    throw ValidationException::withMessages([
                        'nisn' => 'NISN ini sudah terdaftar sebagai alumni.',
                    ]);
                }
                $jurusan = Jurusan::findOrFail($data['id_jurusan']);

                $alumni = AlumniTrack::create([
                    'id_siswa' => $siswa?->id_siswa,
                    'id_jurusan' => $jurusan->id_jurusan,
                    'tahun_lulus' => $data['tahun_lulus'],
                    'no_telp' => $data['no_whatsapp'],
                    'email' => $data['email'],
                    'status' => $status,
                    'keterangan' => $this->keterangan($data),
                    'mentor' => ! empty($data['bersedia_mentor']),
                ]);

                $bookJasah = BookJasah::create([
                    'id_bookjasah' => $this->bookJasahId(),
                    'id_alumni' => $alumni->id_alumni,
                    'status_book' => 'pending',
                ]);

                return compact('alumni', 'bookJasah', 'jurusan');
            });
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'Data yang diberikan tidak valid.',
                'errors' => $exception->errors(),
            ], 422);
        } catch (Throwable $exception) {
            Log::error('Gagal menyimpan pendataan alumni.', [
                'nisn' => $data['nisn'],
                'exception' => $exception,
            ]);

            return response()->json([
                'message' => 'Data alumni belum dapat disimpan. Silakan coba kembali beberapa saat lagi.',
            ], 500);
        }

        return response()->json([
            'message' => 'Data alumni berhasil disimpan.',
            'verification_code' => (string) $hasil['bookJasah']->id_bookjasah,
            'summary' => [
                'nama_lengkap' => $data['nama_lengkap'],
                'jurusan' => $hasil['jurusan']->nama_jurusan,
                'status' => $data['status'],
                'tahun_lulus' => (string) $data['tahun_lulus'],
            ],
        ]);
    }

    /**
     * Merangkum informasi kerja dan pengalaman opsional dalam satu kolom.
     */
    private function keterangan(array $data): ?string
    {
        $bagian = [];

        if (! empty($data['nama_perusahaan'])) {
            $bagian[] = 'Perusahaan: ' . $data['nama_perusahaan'];
        }

        if (! empty($data['jabatan'])) {
            $bagian[] = 'Jabatan: ' . $data['jabatan'];
        }

        if (! empty($data['cerita_pengalaman'])) {
            $bagian[] = 'Pengalaman: ' . $data['cerita_pengalaman'];
        }

        return $bagian === [] ? null : implode("\n", $bagian);
    }

    /**
     * Menghasilkan ID buku ijazah 12 digit yang belum digunakan.
     */
    private function bookJasahId(): int
    {
        do {
            $id = random_int(100_000_000_000, 999_999_999_999);
        } while (BookJasah::whereKey($id)->exists());

        return $id;
    }
}
