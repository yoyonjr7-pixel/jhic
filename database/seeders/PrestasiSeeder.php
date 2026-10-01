<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Prestasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $jurusanTjkt = Jurusan::firstOrCreate([
            'nama_jurusan' => config('tefa.jurusan.tjkt.nama'),
        ]);

        $dataPrestasi = [
            [
                'judul_prestasi' => 'Lomba Poster SEFEST',
                'nama_pemenang' => 'Siswa SMK Darma Siswa 1',
                'kelas' => 'XI TJKT',
                'id_jurusan' => $jurusanTjkt->id_jurusan,
                'tingkat' => null,
                'juara' => 'Juara 2',
                'foto' => 'prestasiimages/lombapostersefest.jpg',
                'deskripsi' => 'Siswa kelas XI TJKT meraih juara 2 lomba poster pada SEFEST.',
            ],
            [
                'judul_prestasi' => 'Lomba Poster Psycoreels',
                'nama_pemenang' => 'Siswa SMK Darma Siswa 1',
                'kelas' => 'XI SMA',
                'id_jurusan' => null,
                'tingkat' => null,
                'juara' => 'Juara 3',
                'foto' => 'prestasiimages/lombaposterpsycoreels.png',
                'deskripsi' => 'Siswa kelas XI SMA menjadi juara 3 lomba poster di Psycoreels.',
            ],
            [
                'judul_prestasi' => 'Lomba Fotografi se-Kabupaten Sidoarjo',
                'nama_pemenang' => 'Siswa SMK Darma Siswa 1',
                'kelas' => 'XII Multimedia',
                'id_jurusan' => null,
                'tingkat' => 'Kabupaten',
                'juara' => 'Juara 1',
                'foto' => 'prestasiimages/lombafotografisidoarjo.png',
                'deskripsi' => 'Siswa kelas XII multimedia menjadi juara 1 lomba street fotografi se-Kabupaten Sidoarjo.',
            ],
            [
                'judul_prestasi' => 'Lomba Vlog se-Surabaya',
                'nama_pemenang' => 'Siswa SMK Darma Siswa 1',
                'kelas' => 'X dan XI SMA',
                'id_jurusan' => null,
                'tingkat' => 'Kota',
                'juara' => 'Juara 2',
                'foto' => 'prestasiimages/lombavlogsurabaya.png',
                'deskripsi' => 'Siswa kelas X dan XI SMA menjadi juara 2 lomba vlog tingkat se-Surabaya.',
            ],
            [
                'judul_prestasi' => 'Lomba Vlog Fotografi Gerbangkertasusila',
                'nama_pemenang' => 'Siswa SMK Darma Siswa 1',
                'kelas' => 'XII Multimedia',
                'id_jurusan' => null,
                'tingkat' => 'Regional',
                'juara' => 'Juara Favorit',
                'foto' => 'prestasiimages/lombavloggerbangkertasusila.png',
                'deskripsi' => 'Siswa kelas XII multimedia menjadi juara favorit lomba fotografi tingkat GERBANGKERTASUSILA.',
            ],
            [
                'judul_prestasi' => 'Lomba Pencak Silat',
                'nama_pemenang' => 'Siswa SMK Darma Siswa 1',
                'kelas' => 'XII TKJ',
                'id_jurusan' => $jurusanTjkt->id_jurusan,
                'tingkat' => null,
                'juara' => 'Juara 3',
                'foto' => 'prestasiimages/lombapencaksilatalfin.jpg',
                'deskripsi' => 'Siswa kelas XII TKJ menjadi juara 3 lomba pencak silat.',
            ],
        ];

        DB::transaction(function () use ($dataPrestasi): void {
            foreach ($dataPrestasi as $data) {
                Prestasi::updateOrCreate(
                    ['judul_prestasi' => $data['judul_prestasi']],
                    $data
                );
            }
        });
    }
}
