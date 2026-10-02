<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Isi awal tabel berita sesuai tampilan halaman utama.
     * Foto lama berada di public/beritaimages/.
     */
    public function run(): void
    {
        $items = [
            [
                'judul_berita' => 'Masuk Sekolah Tahun Pelajaran 2025 - 2026',
                'foto' => 'beritaimages/masuksekolahtahunpelajaran.jpg',
                'kategori' => 'kegiatan',
                'Tanggal' => '2025-07-02',
                'jam' => '08:00:00',
            ],
            [
                'judul_berita' => 'Pelepasan Siswa Smk Darma Siswa Sidoarjo 2024 - 2025',
                'foto' => 'beritaimages/pelepasansiswa2024-2025.jpg',
                'kategori' => 'kegiatan',
                'Tanggal' => '2025-05-26',
                'jam' => '09:00:00',
            ],
            [
                'judul_berita' => 'Cara Menghitung Pajak Dalam Transaksi bisnis',
                'foto' => 'beritaimages/caramenghitungpajak.jpg',
                'kategori' => 'artikel',
                'Tanggal' => '2024-11-30',
                'jam' => null,
            ],
            [
                'judul_berita' => 'Selamat Hari Raya Idul Fitri 1446 H - SMK Darma Siswa 1 & 2 Sidoarjo',
                'foto' => 'beritaimages/harirayaidulfitri1446H.jpg',
                'kategori' => 'pengumuman',
                'Tanggal' => '2025-03-28',
                'jam' => '09:58:00',
            ],
            [
                'judul_berita' => 'Menyambut Tahun Baru Islam 1447 H Dengan Semangat Hijriah',
                'foto' => 'beritaimages/tahunbaruislam1447H.jpg',
                'kategori' => 'pengumuman',
                'Tanggal' => '2025-06-27',
                'jam' => '07:49:00',
            ],
            [
                'judul_berita' => 'Tips meningkatkan kecepatan motor tanpa merusak mesin',
                'foto' => 'beritaimages/meningkatkankecepatanmotor.jpg',
                'kategori' => 'karya',
                'Tanggal' => '2025-03-08',
                'jam' => '08:30:00',
            ],
        ];

        foreach ($items as $item) {
            Berita::firstOrCreate(
                ['judul_berita' => $item['judul_berita']],
                $item
            );
        }
    }
}
