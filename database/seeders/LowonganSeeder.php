<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Lowongan;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        $lowonganPerJurusan = [
            'tjkt' => [
                [
                    'nama_lowongan' => 'IT Support',
                    'deskripsi' => 'Maintenance komputer dan perangkat kantor',
                    'gaji_min' => 4000000,
                    'gaji_max' => 5500000,
                    'skills' => ['Perakitan komputer', 'Troubleshooting'],
                ],
                [
                    'nama_lowongan' => 'Teknisi Jaringan',
                    'deskripsi' => 'Instalasi dan konfigurasi jaringan kantor',
                    'gaji_min' => 4500000,
                    'gaji_max' => 6500000,
                    'skills' => ['Instalasi LAN', 'Mikrotik', 'Fiber optik'],
                ],
            ],
            'tkr' => [
                [
                    'nama_lowongan' => 'Teknisi Mobil',
                    'deskripsi' => 'Perawatan mesin dan kelistrikan mobil',
                    'gaji_min' => 4000000,
                    'gaji_max' => 6000000,
                    'skills' => ['Servis mesin', 'Kelistrikan mobil', 'AC mobil'],
                ],
            ],
            'tsm' => [
                [
                    'nama_lowongan' => 'Kepala Teknisi Bengkel',
                    'deskripsi' => 'Memimpin teknisi bengkel dan kendalikan kualitas',
                    'gaji_min' => 5000000,
                    'gaji_max' => 7000000,
                    'skills' => ['Kepemimpinan', 'Diagnosis mesin'],
                ],
                [
                    'nama_lowongan' => 'Mekanik Motor',
                    'deskripsi' => 'Servis dan perawatan motor, ganti oli, servis rem',
                    'gaji_min' => 3500000,
                    'gaji_max' => 5000000,
                    'skills' => ['Servis mesin', 'Kelistrikan', 'Sistem rem'],
                ],
            ],
            'tp' => [
                [
                    'nama_lowongan' => 'Operator Mesin Bubut',
                    'deskripsi' => 'Operasikan mesin bubut CNC sesuai gambar kerja',
                    'gaji_min' => 4200000,
                    'gaji_max' => 6200000,
                    'skills' => ['Membubut', 'Membaca gambar teknik'],
                ],
            ],
        ];

        foreach ($lowonganPerJurusan as $kodeJurusan => $daftarLowongan) {
            $namaJurusan = config("tefa.jurusan.{$kodeJurusan}.nama");
            $jurusan = Jurusan::firstOrCreate(['nama_jurusan' => $namaJurusan]);

            foreach ($daftarLowongan as $data) {
                Lowongan::updateOrCreate(
                    [
                        'id_jurusan' => $jurusan->id_jurusan,
                        'nama_lowongan' => $data['nama_lowongan'],
                    ],
                    array_merge($data, [
                        'jumlah' => 1,
                        'status' => 'dibuka',
                    ]),
                );
            }

            if ($kodeJurusan === 'tp') {
                Lowongan::where('id_jurusan', $jurusan->id_jurusan)
                    ->whereIn('nama_lowongan', ['Operator CNC', 'Teknisi Pemesinan'])
                    ->where('status', 'dibuka')
                    ->update(['status' => 'ditutup']);
            }
        }
    }
}
