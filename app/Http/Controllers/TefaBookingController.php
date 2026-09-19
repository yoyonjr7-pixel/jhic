<?php

namespace App\Http\Controllers;

use App\Models\BookingTefa;
use App\Models\Jurusan;
use App\Models\Layanan;
use App\Models\TransaksiTefa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TefaBookingController extends Controller
{
    /**
     * Menyimpan data booking dari form TEFA Online.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'layanan'  => ['required', 'string'],
            'nama'     => ['required', 'string', 'max:150'],
            'whatsapp' => ['required', 'string', 'max:20'],
            'tanggal'  => ['required', 'date'],
            'jam'      => ['required', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'catatan'  => ['nullable', 'string', 'max:1000'],
        ]);

        $kode = $data['layanan'];
        $service = collect(config('tefa.layanan'))->firstWhere('slug', $kode);

        if (! $service) {
            return back()
                ->withErrors(['layanan' => 'Layanan yang dipilih tidak ditemukan.'])
                ->withInput();
        }

        $transaksi = DB::transaction(function () use ($data, $service) {
            $namaJurusan = config("tefa.jurusan.{$service['kategori']}.nama", $service['kategori']);

            $jurusan = Jurusan::firstOrCreate([
                'nama_jurusan' => $namaJurusan,
            ]);

            $layanan = Layanan::firstOrCreate(
                ['nama_layanan' => $service['nama']],
                [
                    'id_jurusan' => $jurusan->id_jurusan,
                    'harga'      => $this->angkaHarga($service['harga']),
                    'deskripsi'  => $service['deskripsi'],
                ]
            );

            $jam = strlen($data['jam']) === 5 ? $data['jam'] . ':00' : $data['jam'];

            $transaksi = TransaksiTefa::create([
                'nama_pelanggan'   => $data['nama'],
                'tanggal'          => $data['tanggal'] . ' ' . $jam,
                'no_telp'          => $data['whatsapp'],
                'deskripsi'        => $data['catatan'] ?? '',
                'id_layanan'       => $layanan->id_layanan,
                'penanggung_jawab' => null,
            ]);

            BookingTefa::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'status_book'  => 'pending',
                'keterangan'   => 'Booking online melalui TEFA Online',
            ]);

            return $transaksi;
        });

        return redirect()
            ->route('tefa.booking', ['layanan' => $kode])
            ->with('success', 'Booking berhasil dikirim. Nomor transaksi #' . $transaksi->id_transaksi . '.');
    }

    /**
     * Mengubah teks harga (contoh: "Rp. 25.000 + Part") menjadi angka.
     */
    private function angkaHarga(string $harga): float
    {
        return (float) preg_replace('/[^0-9]/', '', $harga);
    }
}
