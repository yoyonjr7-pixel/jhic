<?php

namespace App\Http\Controllers;

use App\Models\SpmbPendaftar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SpmbPendaftarController extends Controller
{
    public function show(): View
    {
        return view('spmb.informasi');
    }

    public function adminIndex(): View
    {
        $pendaftar = SpmbPendaftar::latest('id_spmb')->get();

        return view('admin.spmb-pendaftar', compact('pendaftar'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:Baru,Diproses,Diterima,Ditolak'],
        ]);

        SpmbPendaftar::findOrFail($id)->update($data);

        return redirect()->route('spmb-pendaftar.index')
            ->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    public function showForm(): View
    {
        $jurusan = collect(config('tefa.jurusan'))
            ->mapWithKeys(fn (array $item) => [$item['nama'] => $item['nama']])
            ->all();

        return view('spmb.daftar', [
            'jurusan' => $jurusan,
            'sumberInformasi' => [
                'Teman',
                'Guru',
                'Media Sosial',
                'Website',
                'Brosur',
                'Keluarga',
                'Lainnya',
            ],
            'registration' => session('spmb.registration', []),
        ]);
    }

    public function confirm(Request $request): RedirectResponse
    {
        $jurusan = collect(config('tefa.jurusan'))
            ->pluck('nama')
            ->all();

        $data = $request->validate($this->registrationRules($jurusan));
        $request->session()->put('spmb.registration', $data);

        return redirect()->route('spmb.confirmation');
    }

    public function showConfirmation(): View|RedirectResponse
    {
        $registration = session('spmb.registration');

        if (! is_array($registration)) {
            return redirect()->route('spmb.form');
        }

        return view('spmb.konfirmasi', compact('registration'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pernyataan' => ['accepted'],
        ], [
            'pernyataan.accepted' => 'Anda harus menyetujui pernyataan sebelum mengirim pendaftaran.',
        ]);

        $registration = $request->session()->get('spmb.registration');
        if (! is_array($registration)) {
            return redirect()->route('spmb.form')
                ->withErrors(['pendaftaran' => 'Data pendaftaran tidak ditemukan. Silakan isi formulir kembali.']);
        }

        $jurusan = collect(config('tefa.jurusan'))
            ->pluck('nama')
            ->all();
        $data = Validator::make($registration, $this->registrationRules($jurusan))->validate();

        $data['nama'] = $data['nama_lengkap'];
        unset($data['nama_lengkap']);

        SpmbPendaftar::create($data);
        $request->session()->forget('spmb.registration');

        return redirect()->route('spmb.success')
            ->with('spmb.registration_success', true);
    }

    public function success(): View|RedirectResponse
    {
        if (! session('spmb.registration_success')) {
            return redirect()->route('spmb.form');
        }

        return view('spmb.selesai');
    }

    private function registrationRules(array $jurusan): array
    {
        return [
            'email' => ['required', 'email', 'max:150'],
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'whatsapp_siswa' => ['required', 'string', 'max:30'],
            'whatsapp_orang_tua' => ['required', 'string', 'max:30'],
            'alamat' => ['required', 'string'],
            'asal_sekolah' => ['required', 'string', 'max:150'],
            'agama' => ['required', 'in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Kepercayaan Lainnya'],
            'jurusan' => ['required', 'string', 'max:150', 'in:' . implode(',', $jurusan)],
            'sumber_informasi' => ['required', 'in:Teman,Guru,Media Sosial,Website,Brosur,Keluarga,Lainnya'],
        ];
    }
}
