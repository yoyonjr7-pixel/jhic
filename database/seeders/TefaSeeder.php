<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TefaSeeder extends Seeder
{
    /**
     * Mengisi data awal untuk tabel sesuai ERD JHIC.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        foreach ([
            'book_jasah',
            'booking_tefa',
            'alumni_track',
            'transaksi_tefa',
            'siswa',
            'layanan',
            'jurusan',
            'spmb',
        ] as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        $now = now();

        // =====================================================
        // JURUSAN
        // =====================================================
        $jurusanId = [];

        foreach ([
            'Teknik Sepeda Motor',
            'Teknik Kendaraan Ringan',
            'Teknik Jaringan Komputer dan Telekomunikasi',
            'Teknik Pemesinan',
        ] as $nama) {
            $jurusanId[$nama] = DB::table('jurusan')->insertGetId([
                'nama_jurusan' => $nama,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }

        // =====================================================
        // LAYANAN
        // =====================================================
        $layananData = [
            ['Servis Ringan Motor', 'Teknik Sepeda Motor', 25000, 'Ganti oli, cek rem, cek rantai & kelistrikan dasar'],
            ['Tune Up Mesin Motor', 'Teknik Sepeda Motor', 50000, 'Servis menyeluruh: karburator/ busi, filter udara'],
            ['Ganti Kampas Rem', 'Teknik Sepeda Motor', 20000, 'Ganti kampas rem depan/ belakang (belum termasuk part)'],
            ['Servis Ringan Mobil', 'Teknik Kendaraan Ringan', 40000, 'Ganti oli, cek rem, cek filter & kelistrikan dasar'],
            ['Tune Up Mesin Mobil', 'Teknik Kendaraan Ringan', 75000, 'Servis menyeluruh: injektor/ karburator, busi, filter udara'],
            ['Servis Rem & Kaki-kaki', 'Teknik Kendaraan Ringan', 35000, 'Ganti kampas rem, cek sistem pengereman & kaki-kaki (belum termasuk part)'],
            ['Instalasi Jaringan LAN', 'Teknik Jaringan Komputer dan Telekomunikasi', 50000, 'Pemasangan kabel, konfigurasi switch & akses poin'],
            ['Servis & Perawatan Komputer', 'Teknik Jaringan Komputer dan Telekomunikasi', 45000, 'Pembersihan, install ulang, perbaikan perangkat'],
            ['Konfigurasi Router & WiFi', 'Teknik Jaringan Komputer dan Telekomunikasi', 60000, 'Setting router, penguatan sinyal & keamanan jaringan'],
            ['Pengelasan Las Listrik', 'Teknik Pemesinan', 50000, 'Pengelasan rangka, pagar & konstruksi besi ringan'],
            ['Bubut & Pemesinan', 'Teknik Pemesinan', 65000, 'Pembuatan komponen dengan mesin bubut sesuai ukuran'],
            ['Fabrikasi Rangka Besi', 'Teknik Pemesinan', 55000, 'Pembuatan rangka meja, kursi, kanopi & sejenisnya (belum termasuk material)'],
        ];

        $layananId = [];

        foreach ($layananData as [$nama, $jurusan, $harga, $deskripsi]) {
            $layananId[$nama] = DB::table('layanan')->insertGetId([
                'nama_layanan' => $nama,
                'id_jurusan'   => $jurusanId[$jurusan],
                'harga'        => $harga,
                'deskripsi'    => $deskripsi,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }

        // =====================================================
        // SISWA
        // =====================================================
        $siswaData = [
            ['0071234567', 'Ahmad Fauzi', 'XII TSM 1', 'Teknik Sepeda Motor', 'aktif'],
            ['0071234568', 'Budi Santoso', 'XII TSM 1', 'Teknik Sepeda Motor', 'aktif'],
            ['0071234569', 'Citra Ayu Lestari', 'XII TKR 1', 'Teknik Kendaraan Ringan', 'aktif'],
            ['0071234570', 'Dedi Kurniawan', 'XII TKR 2', 'Teknik Kendaraan Ringan', 'aktif'],
            ['0071234571', 'Eka Prasetya', 'XII TJKT 1', 'Teknik Jaringan Komputer dan Telekomunikasi', 'aktif'],
            ['0071234572', 'Fitri Nurhaliza', 'XII TJKT 2', 'Teknik Jaringan Komputer dan Telekomunikasi', 'aktif'],
            ['0071234573', 'Galih Ramadhan', 'XII TP 1', 'Teknik Pemesinan', 'aktif'],
            ['0061234501', 'Hana Salsabila', 'XII TSM 1', 'Teknik Sepeda Motor', 'lulus'],
            ['0061234502', 'Ivan Maulana', 'XII TKR 1', 'Teknik Kendaraan Ringan', 'lulus'],
            ['0061234503', 'Jihan Aulia', 'XII TJKT 1', 'Teknik Jaringan Komputer dan Telekomunikasi', 'lulus'],
            ['0061234504', 'Kevin Pratama', 'XII TP 1', 'Teknik Pemesinan', 'lulus'],
        ];

        $siswaId = [];

        foreach ($siswaData as [$nisn, $nama, $kelas, $jurusan, $status]) {
            $siswaId[$nama] = DB::table('siswa')->insertGetId([
                'nisn'       => $nisn,
                'nama_siswa' => $nama,
                'kelas'      => $kelas,
                'id_jurusan' => $jurusanId[$jurusan],
                'status'     => $status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // =====================================================
        // TRANSAKSI TEFA
        // =====================================================
        $transaksiData = [
            ['Rina Wulandari', '2026-09-01', '081234500001', 'Servis rutin motor, oli dan rem', 'Servis Ringan Motor', 'Ahmad Fauzi'],
            ['Agus Setiawan', '2026-09-03', '081234500002', 'Tune up motor, tarikan berat', 'Tune Up Mesin Motor', 'Budi Santoso'],
            ['Dewi Kartika', '2026-09-05', '081234500003', 'Servis rem mobil dan kaki-kaki', 'Servis Rem & Kaki-kaki', 'Citra Ayu Lestari'],
            ['Rudi Hartono', '2026-09-08', '081234500004', 'Instalasi jaringan LAN kantor', 'Instalasi Jaringan LAN', 'Eka Prasetya'],
            ['Siti Aminah', '2026-09-10', '081234500005', 'Laptop lambat, minta install ulang', 'Servis & Perawatan Komputer', 'Fitri Nurhaliza'],
            ['Bayu Nugroho', '2026-09-12', '081234500006', 'Pembuatan pagar besi minimalis', 'Pengelasan Las Listrik', 'Galih Ramadhan'],
        ];

        $transaksiId = [];

        foreach ($transaksiData as [$pelanggan, $tanggal, $telp, $deskripsi, $layanan, $siswa]) {
            $transaksiId[$pelanggan] = DB::table('transaksi_tefa')->insertGetId([
                'nama_pelanggan'   => $pelanggan,
                'tanggal'          => $tanggal,
                'no_telp'          => $telp,
                'deskripsi'        => $deskripsi,
                'id_layanan'       => $layananId[$layanan],
                'penanggung_jawab' => $siswaId[$siswa],
                'created_at'       => $now,
                'updated_at'       => $now,
            ]);
        }

        // =====================================================
        // BOOKING TEFA
        // =====================================================
        $bookingData = [
            ['Rina Wulandari', 'selesai', 'Servis selesai, pembayaran lunas'],
            ['Agus Setiawan', 'diproses', 'Menunggu konfirmasi sparepart'],
            ['Dewi Kartika', 'selesai', 'Servis selesai, pembayaran lunas'],
            ['Rudi Hartono', 'diproses', 'Instalasi tahap penarikan kabel'],
            ['Siti Aminah', 'pending', 'Menunggu antrian workshop'],
            ['Bayu Nugroho', 'pending', 'Menunggu jadwal pengelasan'],
        ];

        foreach ($bookingData as [$pelanggan, $status, $keterangan]) {
            DB::table('booking_tefa')->insert([
                'id_transaksi' => $transaksiId[$pelanggan],
                'status_book'  => $status,
                'keterangan'   => $keterangan,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }

        // =====================================================
        // ALUMNI TRACK
        // =====================================================
        $alumniData = [
            ['Hana Salsabila', 2024, '081298760001', 'hana.salsabila@example.com', 'bekerja', 'Bekerja di Astra Honda Motor', 'Argo Ciptono, S.Kom, ST, MM.'],
            ['Ivan Maulana', 2024, '081298760002', 'ivan.maulana@example.com', 'kuliah', 'Kuliah D4 Teknik Mesin di PENS', 'Bambang Wijaya, S.T.'],
            ['Jihan Aulia', 2023, '081298760003', 'jihan.aulia@example.com', 'wirausaha', 'Membuka jasa konfigurasi jaringan', 'Dian Puspita, S.Kom.'],
            ['Kevin Pratama', 2023, '081298760004', 'kevin.pratama@example.com', 'bekerja', 'Bekerja di PT Siantar Top bagian maintenance', 'Sugeng Riyadi, S.T.'],
        ];

        $alumniId = [];

        foreach ($alumniData as [$siswa, $tahun, $telp, $email, $status, $keterangan, $mentor]) {
            $alumniId[$siswa] = DB::table('alumni_track')->insertGetId([
                'id_siswa'    => $siswaId[$siswa],
                'tahun_lulus' => $tahun,
                'no_telp'     => $telp,
                'email'       => $email,
                'status'      => $status,
                'keterangan'  => $keterangan,
                'mentor'      => $mentor,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }

        // =====================================================
        // BOOK JASAH (IJAZAH)
        // =====================================================
        $bookJasahData = [
            ['Hana Salsabila', 'selesai'],
            ['Ivan Maulana', 'selesai'],
            ['Jihan Aulia', 'diproses'],
            ['Kevin Pratama', 'pending'],
        ];

        foreach ($bookJasahData as [$alumni, $status]) {
            DB::table('book_jasah')->insert([
                'id_alumni'   => $alumniId[$alumni],
                'status_book' => $status,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }

        // =====================================================
        // SPMB
        // =====================================================
        foreach ([
            'Muhammad Rizky',
            'Nadia Safira',
            'Oktavian Dwi',
            'Putri Amelia',
            'Raka Aditya',
        ] as $nama) {
            DB::table('spmb')->insert([
                'nama'       => $nama,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
