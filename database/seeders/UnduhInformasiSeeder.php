<?php

namespace Database\Seeders;

use App\Models\UnduhInformasi;
use Illuminate\Database\Seeder;

class UnduhInformasiSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'slug' => 'browser-spmb-smk-darma-siswa-1-sidoarjo',
                'judul' => 'Browser SPMB Smk Darma Siswa 1 Sidoarjo',
                'kategori' => 'UNDUH FILE :',
                'tanggal_publish' => '2026-04-12',
                'deskripsi' => null,
            ],
            [
                'slug' => 'sertifikat-akreditasi',
                'judul' => 'Sertifikat Akreditasi',
                'kategori' => 'Sertifikat Akreditasi " A " Smk Darma Siswa 1 Sidoarjo :',
                'tanggal_publish' => '2025-05-02',
                'deskripsi' => null,
            ],
            [
                'slug' => 'juara-1-lomba-futsal',
                'judul' => 'Juara 1 Lomba Futsal',
                'kategori' => 'Prestasi Terbaru :',
                'tanggal_publish' => '2025-01-13',
                'deskripsi' => null,
            ],
            [
                'slug' => 'juara-1-lomba-fotografi',
                'judul' => 'Juara 1 Lomba Fotografi',
                'kategori' => 'Prestasi Terbaru :',
                'tanggal_publish' => '2026-08-01',
                'deskripsi' => null,
            ],
            [
                'slug' => 'juara-2-lomba-dance',
                'judul' => 'Juara 2 Lomba Dance',
                'kategori' => 'Prestasi Terbaru :',
                'tanggal_publish' => null,
                'deskripsi' => 'Tanggal pada referensi tertulis 30 February 2026, yang bukan tanggal kalender valid.',
            ],
        ];

        foreach ($items as $item) {
            $informasi = UnduhInformasi::firstOrNew([
                'slug' => $item['slug'],
            ]);

            $informasi->fill([
                'judul' => $item['judul'],
                'kategori' => $item['kategori'],
                'deskripsi' => $item['deskripsi'],
                'status' => 'Terbit',
                'tanggal_publish' => $item['tanggal_publish'],
            ]);

            $informasi->save();
        }
    }
}
