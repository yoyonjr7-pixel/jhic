<?php

namespace App\Http\Controllers;

use App\Models\BookingTefa;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Layanan;
use App\Models\TransaksiTefa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TefaBookingController extends Controller
{
    /**
     * Menyimpan data booking dari form TEFA Online.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            "layanan"  => ["required", "string"],
            "nama"     => ["required", "string", "min:3", "max:150", "regex:/^(?=.*[A-Za-z])[A-Za-z\s]+$/"],
            "whatsapp" => ["required", "regex:/^[0-9]+$/", "max:20"],
            "tanggal"  => [
                "required",
                "date",
                "after_or_equal:today",
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isSunday()) {
                        $fail("Tanggal tidak boleh hari Minggu.");
                    }
                },
            ],
            "jam"      => [
                "required",
                "regex:/^(?:[01]\d|2[0-3]):[0-5]\d(?::[0-5]\d)?$/",
                function ($attribute, $value, $fail) {
                    $menit = $this->menitDariJam($value);

                    if ($menit < $this->jamBukaMenit() || $menit > $this->jamTutupMenit()) {
                        $fail("Jam harus di antara " . $this->jamBuka() . " - " . $this->jamTutup() . ".");
                    }
                },
            ],
            "catatan"  => ["required", "string", "max:1000"],
        ], [
            "nama.min"   => "Nama minimal 3 karakter.",
            "nama.regex" => "Nama hanya boleh berisi huruf dan spasi.",
        ]);

        // Pastikan tanggal + jam tidak di masa lalu
        $jamNormal = strlen($data["jam"]) === 5 ? $data["jam"] . ":00" : $data["jam"];
        $selectedDateTime = $data["tanggal"] . " " . $jamNormal;

        if (strtotime($selectedDateTime) < strtotime(now())) {
            $errors = ["jam" => "Tanggal dan waktu yang dipilih tidak boleh di masa lalu."];

            if ($request->expectsJson()) {
                return response()->json([
                    "message" => reset($errors),
                    "errors"  => $errors,
                ], 422);
            }

            return back()->withErrors($errors)->withInput();
        }

        $kode = $data["layanan"];
        $service = collect(config("tefa.layanan"))->firstWhere("slug", $kode);

        if (! $service) {
            $errors = ["layanan" => "Layanan yang dipilih tidak ditemukan."];

            if ($request->expectsJson()) {
                return response()->json([
                    "message" => reset($errors),
                    "errors"  => $errors,
                ], 422);
            }

            return back()->withErrors($errors)->withInput();
        }

        $hasil = DB::transaction(function () use ($data, $service) {
            $namaJurusan = config("tefa.jurusan.{$service["kategori"]}.nama", $service["kategori"]);

            $jurusan = Jurusan::firstOrCreate([
                "nama_jurusan" => $namaJurusan,
            ]);

            $layanan = Layanan::firstOrCreate(
                ["nama_layanan" => $service["nama"]],
                [
                    "id_jurusan" => $jurusan->id_jurusan,
                    "harga"      => $this->angkaHarga($service["harga"]),
                    "deskripsi"  => $service["deskripsi"],
                ]
            );

            $guru = Guru::where("id_jurusan", $jurusan->id_jurusan)->first();

            $jam = strlen($data["jam"]) === 5 ? $data["jam"] . ":00" : $data["jam"];

            $transaksi = TransaksiTefa::create([
                "nama_pelanggan"   => $data["nama"],
                "tanggal"          => $data["tanggal"] . " " . $jam,
                "no_telp"          => $data["whatsapp"],
                "deskripsi"        => $data["catatan"] ?? "",
                "id_layanan"       => $layanan->id_layanan,
                "id_guru"          => $guru?->id_guru,
            ]);

            $booking = BookingTefa::create([
                "id_transaksi" => $transaksi->id_transaksi,
                "status_book"  => "pending",
                "keterangan"   => "Booking online melalui TEFA Online",
            ]);

            return compact("transaksi", "booking", "jurusan", "guru");
        });

        $labelJurusan = config("tefa.jurusan.{$service["kategori"]}.label", strtoupper($service["kategori"]));

        $booking = [
            "id_book"   => $hasil["booking"]->id_book,
            "kode"      => strtoupper($service["kategori"]) . "-" . str_pad((string) $hasil["booking"]->id_book, 6, "0", STR_PAD_LEFT),
            "jurusan"   => $labelJurusan,
            "kategori"  => $service["nama"],
            "deskripsi" => $service["deskripsi"],
            "harga"     => $service["harga"],
            "ikon"      => $service["ikon"],
            "tugas"     => "Langsung ke Bengkel " . $labelJurusan,
            "status"    => $this->labelStatus($hasil["booking"]->status_book),
            "jadwal"    => Carbon::parse($data["tanggal"] . " " . $jamNormal)->format("d/m/Y H:i"),
        ];

        if ($request->expectsJson()) {
            return response()->json([
                "booking" => $booking,
                "icon"    => view("tefa.partials.icon", ["type" => $booking["ikon"]])->render(),
            ]);
        }

        return redirect()
            ->route("tefa.booking", ["layanan" => $kode])
            ->with("booking", $booking);
    }

    /**
     * Batas jam operasional booking, diambil dari config/tefa.php.
     */
    /**
     * Label status booking untuk ditampilkan pada popup.
     */
    private function labelStatus(string $status): string
    {
        return match ($status) {
            "pending"  => "Menunggu Konfirmasi",
            "diproses" => "Sedang Diproses",
            "selesai"  => "Selesai",
            "batal"    => "Dibatalkan",
            default    => ucfirst($status),
        };
    }

    private function jamBuka(): string
    {
        return (string) config("tefa.jam.buka", "07:00");
    }

    private function jamTutup(): string
    {
        return (string) config("tefa.jam.tutup", "13:15");
    }

    private function jamBukaMenit(): int
    {
        return $this->menitDariJam($this->jamBuka());
    }

    private function jamTutupMenit(): int
    {
        return $this->menitDariJam($this->jamTutup());
    }

    /**
     * Mengubah teks jam (HH:MM atau HH:MM:SS) menjadi total menit.
     */
    private function menitDariJam(string $jam): int
    {
        [$jamPart, $menitPart] = array_pad(explode(":", $jam), 2, "0");

        return ((int) $jamPart * 60) + (int) $menitPart;
    }

    /**
     * Mengubah teks harga (contoh: "Rp. 25.000 + Part") menjadi angka.
     */
    private function angkaHarga(string $harga): float
    {
        return (float) preg_replace("/[^0-9]/", "", $harga);
    }
}
