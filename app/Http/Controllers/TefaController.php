<?php

namespace App\Http\Controllers;

use App\Models\BookingTefa;
use App\Models\TransaksiTefa;
use App\Models\Layanan;
use App\Models\Guru;
use App\Models\TambahanTefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TefaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN TEFA ONLINE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $booking = BookingTefa::with([
            'transaksi.layanan.jurusan',
            'transaksi.guru',
            'tambahan',
        ])
        ->orderBy('id_book', 'desc')
        ->get();

        $layanan = Layanan::with('jurusan')
            ->orderBy('nama_layanan')
            ->get();

        $guru = Guru::with('jurusan')
            ->orderBy('nama_guru')
            ->get();

        return view('tefa-online', compact(
            'booking',
            'layanan',
            'guru'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH BOOKING
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:150',
            'no_telp' => 'nullable|string|max:20',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'id_layanan' => 'required|exists:layanan,id_layanan',
            'id_guru' => 'nullable|exists:guru,id_guru',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {

            $transaksi = TransaksiTefa::create([
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'tanggal' => $validated['tanggal'],
                'no_telp' => $validated['no_telp'] ?? null,
                'deskripsi' => $validated['deskripsi'],
                'id_layanan' => $validated['id_layanan'],
                'id_guru' => $validated['id_guru'] ?? null,
            ]);

            BookingTefa::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'status_book' => 'pending',
                'keterangan' => $validated['keterangan']
                    ?? 'Booking dibuat oleh admin.',
            ]);
        });

        return redirect('/tefa-online')
            ->with('success', 'Booking TEFA berhasil ditambahkan.');
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL BOOKING
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $booking = BookingTefa::with([
            'transaksi.layanan.jurusan',
            'transaksi.guru',
            'tambahan',
        ])->findOrFail($id);

        return view('tefa-detail', compact('booking'));
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT BOOKING + PEKERJAAN TAMBAHAN
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:150',
            'no_telp' => 'nullable|string|max:20',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'id_layanan' => 'required|exists:layanan,id_layanan',
            'id_guru' => 'nullable|exists:guru,id_guru',
            'status_book' => 'required|in:pending,diproses,selesai,batal',
            'keterangan' => 'nullable|string',

            /*
            |--------------------------------------------------------------
            | PEKERJAAN TAMBAHAN
            |--------------------------------------------------------------
            */

            'tambahan' => 'nullable|array',

            'tambahan.*.nama_tambahan'
                => 'nullable|string|max:150',

            'tambahan.*.keterangan'
                => 'nullable|string',

            'tambahan.*.harga'
                => 'nullable|numeric|min:0',
        ]);


        DB::transaction(function () use ($validated, $id) {

            /*
            |--------------------------------------------------------------------------
            | AMBIL BOOKING
            |--------------------------------------------------------------------------
            */

            $booking = BookingTefa::findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | UPDATE TRANSAKSI UTAMA
            |--------------------------------------------------------------------------
            */

            $transaksi = $booking->transaksi;

            $transaksi->update([
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'tanggal' => $validated['tanggal'],
                'no_telp' => $validated['no_telp'] ?? null,
                'deskripsi' => $validated['deskripsi'],
                'id_layanan' => $validated['id_layanan'],
                'id_guru' => $validated['id_guru'] ?? null,
            ]);


            /*
            |--------------------------------------------------------------------------
            | UPDATE DATA BOOKING
            |--------------------------------------------------------------------------
            */

            $booking->update([
                'status_book' => $validated['status_book'],
                'keterangan' => $validated['keterangan'] ?? null,
            ]);


            /*
            |--------------------------------------------------------------------------
            | HAPUS PEKERJAAN TAMBAHAN LAMA
            |--------------------------------------------------------------------------
            |
            | Supaya ketika admin mengedit ulang booking,
            | data pekerjaan tambahan tidak menumpuk.
            |
            */

            $booking->tambahan()->delete();


            /*
            |--------------------------------------------------------------------------
            | SIMPAN PEKERJAAN TAMBAHAN BARU
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['tambahan'])) {

                foreach ($validated['tambahan'] as $tambahan) {

                    /*
                    | Jangan simpan baris kosong.
                    */

                    if (
                        empty($tambahan['nama_tambahan']) &&
                        empty($tambahan['keterangan']) &&
                        empty($tambahan['harga'])
                    ) {
                        continue;
                    }


                    /*
                    | Simpan pekerjaan tambahan
                    */

                    $booking->tambahan()->create([
                        'nama_tambahan' =>
                            $tambahan['nama_tambahan'] ?? '',

                        'keterangan' =>
                            $tambahan['keterangan'] ?? null,

                        'harga' =>
                            $tambahan['harga'] ?? 0,
                    ]);
                }
            }
        });


        return redirect('/tefa-online')
            ->with(
                'success',
                'Booking TEFA dan pekerjaan tambahan berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT STATUS SAJA
    |--------------------------------------------------------------------------
    */

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status_book'
                => 'required|in:pending,diproses,selesai,batal',
        ]);

        $booking = BookingTefa::findOrFail($id);

        $booking->update([
            'status_book' => $validated['status_book'],
        ]);

        return redirect('/tefa-online')
            ->with('success', 'Status booking berhasil diperbarui.');
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS BOOKING
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $booking = BookingTefa::findOrFail($id);

        /*
        | Karena tabel tambahan_tefa menggunakan
        | foreign key ON DELETE CASCADE,
        | pekerjaan tambahan akan ikut terhapus.
        */

        $booking->delete();

        return redirect('/tefa-online')
            ->with('success', 'Booking TEFA berhasil dihapus.');
    }
}